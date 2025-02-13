<?php

namespace App\Http\Controllers;

use App\Mail\DocumentCreationMail;
use App\Mail\ContratCreationMail;
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

        $email = $request->input('client_email');
        $client = $request->input('client_firstname') . ' ' . $request->input('client_lastname');
        

        Mail::to($email)->send(new ContratCreationMail($client, $validated['title']));

        return redirect()->back();
    }

    

    public function download($id)
{
    $document = Documents::findOrFail($id);

    $filePath = storage_path('app/private/' . $document->document); 
    if (!file_exists($filePath)) {
        abort(404, 'Fichier introuvable.');
    }

    return response()->download($filePath);
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

} 
