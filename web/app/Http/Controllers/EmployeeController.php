<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;  // La bonne déclaration ici
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\DocumentCreationMail;
use App\Mail\ContractCreationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Functions;
use App\Models\Services;
use App\Models\Contract;
use App\Models\Documents;
use App\Models\ContentDocuments;
use App\Models\CreateDocuments;
use App\Models\Notification;
use Illuminate\Http\UploadedFile;
use App\Models\QuotesRequest;
use App\Mail\DevisMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{

    public function listeClientAttitres()
    {
        $employeeId = session('id');
        $employeeId = Employee::where('FK_account_id', $employeeId)->first();
        $clients = Client::where('FK_employee_id', $employeeId->employee_id)
            ->get();
        return view('listeClientAttitres', [
            'clients' => $clients,
        ]);
    }

    public function showClient(Request $request)
    {
    $id = $request->id;

    // Récupérer le client avec ses documents et leur contenu
    $client = Client::where('client_id', $id)
        ->with('createDocuments.contentDocuments') 
        ->first();

    $services = Services::all();

    // Passer les données à la vue
    return view('ClientDetails', [
        'client' => $client,
        'services' => $services,
    ]);
    }


    public function creationContrat(Request $request){
        if (session('role') !== 'employee') {
            Session::flush(); 
            return redirect('/'); // Redirige si le rôle n'est pas 'employee'
        }
    
        $clientId = $request->input('client_id'); 
        $serviceId = $request->input('prestation_id'); 
        $employeeId = session('id'); 
        $employee = Employee::where('FK_account_id', $employeeId)->first();
        $idEmployee = $employee ? $employee->employee_id : null;
        // Génération d'un numéro de contrat
        
        $contractCount = Contract::count() + 1;

        $date = now()->format('dmY');

        $contractNumber = $contractCount . $clientId . $idEmployee . $serviceId . $date;
    
        // Création du contrat
        $newContract = Contract::create([
            'numero_contract' => $contractNumber,
            'FK_service_id' => $serviceId,
            'FK_client_id' => $clientId,
            'FK_employee_id' => $idEmployee,
            'creation_date' => now(),
            'is_active' => true,
        ]);

        $email = $request->input('client_email');
        $client = $request->input('client_firstname') . ' ' . $request->input('client_lastname');
        $titre_prestation = $request->input('service_title');

        Mail::to($email)->send(new ContractCreationMail($client, $titre_prestation, $contractNumber));

        return redirect()->back();
    }

    
    public function download($id)
    {

        // Spécifiez le disque et le répertoire
        $directory = 'decrypted/';

        // Récupérer tous les fichiers dans ce répertoire
        $files = Storage::disk('local')->allFiles($directory);

        // Supprimer tous les fichiers récupérés
        Storage::disk('local')->delete($files);


        // Récupérer le document
        $document = Documents::findOrFail($id);
        
        // Récupérer le chemin du fichier à partir du disque local
        $filePath = storage_path('app/private/' . $document->document);
        
        // Déchiffrer le fichier et obtenir son nouveau chemin
        $filePath = $this->decryptFile($filePath, $document->key);
        return response()->download($filePath);
    }


    public function show($id)
    {

        // Spécifiez le disque et le répertoire
        $directory = 'decrypted/';

        // Récupérer tous les fichiers dans ce répertoire
        $files = Storage::disk('local')->allFiles($directory);

        // Supprimer tous les fichiers récupérés
        Storage::disk('local')->delete($files);


        // Récupérer le document
        $document = Documents::findOrFail($id);
        
        // Récupérer le chemin du fichier à partir du disque local
        $filePath = storage_path('app/private/' . $document->document);
        
        // Déchiffrer le fichier et obtenir son nouveau chemin
        $filePath = $this->decryptFile($filePath, $document->key);
        return response()->file($filePath);
    }
    
    public function decryptFile($fileUrl, $key)
    {
        // Extraire le nom du fichier à partir de l'URL
        $fileName = basename($fileUrl);
    
        // Vérifier si le fichier existe dans le stockage local
        if (!Storage::disk('local')->exists('documents/' . $fileName)) {
            dd("Le fichier spécifié n'existe pas.");
        }
    
        // Récupérer le contenu du fichier depuis le stockage local
        $data = Storage::disk('local')->get('documents/' . $fileName);
    
        // Vérifier si le fichier est valide
        if (!$data) {
            throw new \Exception("Le fichier téléchargé est vide ou invalide.");
        }
    
        // Extraire l'IV (16 premiers octets)
        $iv = substr($data, 0, 16);
        $encryptedData = substr($data, 16);
    
        // Vérifier la validité de l'IV
        if (strlen($iv) !== 16) {
            throw new \Exception("L'IV extrait n'est pas valide.");
        }
    
        // Déchiffrer les données
        $decryptedData = openssl_decrypt($encryptedData, 'AES-256-CBC', $key, 0, $iv);
        if ($decryptedData === false) {
            throw new \Exception("Échec du déchiffrement.");
        }
    
        // Définir le répertoire de stockage temporaire pour le fichier décrypté
        $directory = 'decrypted/';
    
        // Créer le répertoire s'il n'existe pas encore
        if (!Storage::disk('local')->exists($directory)) {
            Storage::disk('local')->makeDirectory($directory);
        }
    
        // Générer un nom unique pour le fichier déchiffré
        $decryptedFileName = 'decrypted_' . time() . '.pdf';
    
        // Créer un chemin pour le fichier décrypté dans le stockage local
        $filePath = storage_path('app/private/' . $directory . $decryptedFileName);
    
        // Sauvegarder le fichier déchiffré
        file_put_contents($filePath, $decryptedData);
    
        // Retourner le chemin du fichier décrypté
        return $filePath;
    }
    



    public function store(Request $request)
    {
       
        // Validation des données
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'employee_id' => 'required|exists:employees,employee_id',
            'client_email' => 'required|',
            'title' => 'required|string|max:255',
            'contenu' => 'required|string',
            'facture' => 'required|boolean',
            'client_firstname' => 'required|',
            'client_lastname' => 'required|',
        ]);

        // Création du document dans la table create_documents
        $createDocument = CreateDocuments::create([
            'FK_employee_id' => $validated['employee_id'],
            'FK_client_id' => $validated['client_id'],
            'facture' => $validated['facture'],
        ]);

        $email = $validated['client_email'];
        $client = $validated['client_firstname'] . ' ' . $validated['client_lastname'];

        // Création du contenu du document dans la table content_documents
        ContentDocuments::create([
            'title' => $validated['title'],
            'contenu' => $validated['contenu'],
            'FK_createdocument_id' => $createDocument->createdocument_id,
            'date' => now(),
        ]);

        Mail::to($email)->send(new DocumentCreationMail($client, $validated['title']));
        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Document créé avec succès !');
    }

    //FONCTIONNE
    public function getNotifications(Request $request)
    {
        if (!session()->has('id')) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }
    
        $account_id = session('id');
        $employee = Employee::where('FK_account_id', $account_id)->first();

        if ($employee) {
            $employee_id = $employee->employee_id;
        }
       
        $notifications = Notification::where('FK_account_id_recipient', $employee_id)
            ->where('seen', false)
            ->orderBy('date', 'desc')
            ->get();
    
        return response()->json($notifications);
    }

    public function markAsSeen($notificationId)
    {
        $notification = Notification::find($notificationId);
    
        if ($notification) {
            $notification->seen = true;
            $notification->save();
    
            return response()->json(['success' => 'Notification marquée comme vue']);
        }
    
        return response()->json(['error' => 'Notification non trouvée'], 404);
    }


    public function listeDemandesDevis()
    {
        $devisList = QuotesRequest::where('checked', false)->get();
        return view('listeDemandesDevis', [
            'devisList' => $devisList
        ]);
    }


    public function showDevis(Request $request)
    {
    $id = $request->id;

    $devis = QuotesRequest::where('quote_request_id' , $id)->first();
    return view('DevisDetails', [
        'devis' => $devis,
    ]);
    }
    

// public function genererDevisPDF(Request $request, $id)
// {
//     $devis = QuotesRequest::findOrFail($id);

//     $lignes = $request->input('description', []);
//     $quantites = $request->input('quantite', []);
//     $prix = $request->input('prix', []);
//     $commentaires = $request->input('commentaires', '');

//     $totalHT = 0;
//     $detailsDevis = [];

//     foreach ($lignes as $index => $desc) {
//         $qte = $quantites[$index];
//         $prixUnitaire = $prix[$index];
//         $total = $qte * $prixUnitaire;
//         $totalHT += $total;

//         $detailsDevis[] = [
//             'description' => $desc,
//             'quantite' => $qte,
//             'prix' => $prixUnitaire,
//             'total' => $total
//         ];
//     }

//     $tva = $totalHT * 0.2;
//     $totalTTC = $totalHT + $tva;

//     $pdf = Pdf::loadView('pdf.devis', compact('devis', 'detailsDevis', 'totalHT', 'tva', 'totalTTC', 'commentaires'));

//     return $pdf->download("devis_{$devis->quote_request_id}.pdf");
// }

public function genererDevisPDF(Request $request, $id)
{
    $devis = QuotesRequest::findOrFail($id);

    $lignes = $request->input('description', []);
    $quantites = $request->input('quantite', []);
    $prix = $request->input('prix', []);
    $commentaires = $request->input('commentaires', '');

    $totalHT = 0;
    $detailsDevis = [];

    foreach ($lignes as $index => $desc) {
        $qte = $quantites[$index];
        $prixUnitaire = $prix[$index];
        $total = $qte * $prixUnitaire;
        $totalHT += $total;

        $detailsDevis[] = [
            'description' => $desc,
            'quantite' => $qte,
            'prix' => $prixUnitaire,
            'total' => $total
        ];
    }

    $tva = $totalHT * 0.2;
    $totalTTC = $totalHT + $tva;

    $pdf = Pdf::loadView('pdf.devis', compact('devis', 'detailsDevis', 'totalHT', 'tva', 'totalTTC', 'commentaires'));

    Mail::to($devis->email)->send(new DevisMail($devis, $pdf));


    $devis->checked = true;
    $devis->save();

    $devisList = QuotesRequest::where('checked', false)->get();
        return view('listeDemandesDevis', [
            'devisList' => $devisList
        ]);
}

} 
