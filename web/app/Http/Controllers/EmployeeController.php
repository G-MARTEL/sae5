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
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function listeClientAttitres()
    {
        $employeeId = session('id');
        $employeeId = Employee::where('FK_account_id', $employeeId)->first();
        // Récupérer les cl
        $clients = Client::where('FK_employee_id', $employeeId->employee_id)
            ->get();
        // Passer les données à la vue
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

    
    public function download($id)
    {
        // Récupérer le document depuis la base de données
        $document = Documents::findOrFail($id);

        // Générer une réponse de téléchargement
        return response($document->document)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="document_' . $document->document_id . '.pdf"');
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
} 
