<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    return view('clientDetails', [
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
    
        return redirect()->back();
    }

    
    // public function download($id)
    // {
    //     // Récupérer le document depuis la base de données
    //     $document = Documents::findOrFail($id);
    
    //     // Récupérer le chemin du fichier
    //     $filePath = $document->document; // Ex: "storage/documents/1738749910_download (1).pdf"
    
    //     // Vérifier si le fichier existe dans "storage/app/public/documents"
    //     if (!Documents::exists(str_replace('storage/', 'private/', $filePath))) {
    //         abort(404, 'Fichier introuvable.');
    //     }
    
    //     // Retourner le fichier pour téléchargement
    //     return response()->download(public_path($filePath));
    // }


    public function download($id)
{
    // Récupérer le document depuis la base de données
    $document = Documents::findOrFail($id);

    // Récupérer le chemin correct du fichier
    $filePath = storage_path('app/private/' . $document->document); // Ex: "storage/app/private/documents/1738749910_download (1).pdf"

    // Vérifier si le fichier existe
    if (!file_exists($filePath)) {
        abort(404, 'Fichier introuvable.');
    }

    // Télécharger le fichier
    return response()->download($filePath);
}
    public function store(Request $request)
    {
       

        // Validation des données
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'employee_id' => 'required|exists:employees,employee_id',
            'title' => 'required|string|max:255',
            'contenu' => 'required|string',
            'facture' => 'required|boolean',
        ]);

        // Création du document dans la table create_documents
        $createDocument = CreateDocuments::create([
            'FK_employee_id' => $validated['employee_id'],
            'FK_client_id' => $validated['client_id'],
            'facture' => $validated['facture'],
        ]);

        // Création du contenu du document dans la table content_documents
        ContentDocuments::create([
            'title' => $validated['title'],
            'contenu' => $validated['contenu'],
            'FK_createdocument_id' => $createDocument->createdocument_id,
            'date' => now(),
        ]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Document créé avec succès !');
    }
    

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
            ->orderBy('date', 'desc')
            ->get();
    
        return response()->json($notifications);
    }


} 
