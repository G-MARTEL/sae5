<?php
namespace App\Http\Controllers;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Functions;
use App\Models\CreateDocuments;
use App\Models\ContentDocuments;
use App\Models\Employee;
use App\Models\Client;


class DocumentController extends Controller
{

    public function showForm()
    {
        return view('pdf.form');
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Générer le PDF avec les données du formulaire
        $pdf = Pdf::loadView('pdf.document', [
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Télécharger directement le PDF
        return $pdf->download('document.pdf');
    }



    public function downloadDocument($id)
{
    $employeeId = session('id'); // ID de l'employé connecté
    $employee = Employee::where('FK_account_id', $employeeId)
        ->with('account', 'functions')
        ->firstOrFail();

    // Récupérer le contenu du document à partir de son ID
    $content = ContentDocuments::with('createDocuments.client.account')->findOrFail($id);
    $createDocument = $content->createDocuments;

    // Récupérer le client associé
    $client = $createDocument->client;

    // Passer les données au template PDF
    $pdf = Pdf::loadView('pdf/documentPdf', [
        'title' => $content->title,
        'content' => $content->contenu,
        'type' => $createDocument->facture ? 'Facture' : 'Autre',
        'date' => $content->date,
        'client_name' => $client->account->first_name . ' ' . $client->account->last_name,
        'client_email' => $client->account->email,
        'client_phone' => $client->account->phone,
        'employee_name' => $employee->account->first_name . ' ' . $employee->account->last_name,
        'employee_email' => $employee->account->email,
        'employee_phone' => $employee->account->phone,
        'employee_function' => $employee->functions->function_name ?? 'Non spécifiée',
    ]);

    return $pdf->download($content->title . '.pdf');
}


public function downloadDocumentClient($id)
{
    $document = CreateDocuments::with('contentDocuments')->find($id);

    if (!$document) {
        return redirect()->back()->with('error', 'Document non trouvé.');
    }

    // Récupérer les informations du client et de l'employé associés
    $client = Client::with('account')->find($document->FK_client_id);
    $employee = Employee::with(['account', 'functions'])->find($document->FK_employee_id);

    if (!$client || !$employee) {
        return redirect()->back()->with('error', 'Données manquantes pour générer le PDF.');
    }

    // Préparer les données pour le PDF
    $data = [
        'title' => $document->facture ?? 'Document',
        'client_name' => $client->account->first_name . ' ' . $client->account->last_name,
        'client_email' => $client->account->email,
        'client_phone' => $client->account->phone,
        'employee_name' => $employee->account->first_name . ' ' . $employee->account->last_name,
        'employee_function' => $employee->functions->function_name ?? 'N/A',
        'employee_email' => $employee->account->email,
        'employee_phone' => $employee->account->phone,
        'type' => $document->facture ? 'Facture' : 'Autre',
        'date' => $document->contentDocuments->first()?->date ? \Carbon\Carbon::parse($document->contentDocuments->first()->date)->format('d/m/Y') : 'N/A',
        'content' => $document->contentDocuments->pluck('contenu')->implode("\n"),
    ];

    $pdf = PDF::loadView('pdf/documentPdf', $data);

    return $pdf->download('document_client_' . $document->createdocument_id . '.pdf');
}


}