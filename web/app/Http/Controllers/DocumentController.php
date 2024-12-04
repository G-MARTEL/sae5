<?php
namespace App\Http\Controllers;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Functions;

class DocumentController extends Controller
{
// public function create(Request $request)
// {
//     $request->validate([
//         'title' => 'required|string|max:255',
//         'client_id' => 'required|exists:clients,client_id',
//         'content' => 'required|string',
//     ]);

//     $client = Client::findOrFail($request->client_id);

//     // Générer le PDF à partir d'une vue Blade
//     $pdf = Pdf::loadView('pdf.document', [
//         'title' => $request->title,
//         'client' => $client,
//         'content' => $request->content,
//     ]);

//     // Enregistrer le fichier PDF
//     $fileName = 'documents/' . uniqid() . '.pdf';
//     Storage::disk('public')->put($fileName, $pdf->output());

//     // Sauvegarder le chemin dans la base de données
//     Document::create([
//         'title' => $request->title,
//         'file_path' => $fileName,
//         'client_id' => $client->id,
//         'employee_id' => auth()->id(),
//     ]);

//     return back()->with('success', 'Document créé et enregistré avec succès !');
// }


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

}