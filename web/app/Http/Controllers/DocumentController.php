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
        // Récupérer le contenu du document à partir de son ID
        $content = ContentDocuments::findOrFail($id);
        $createDocument = $content->createDocuments; // Relation avec CreateDocuments

        // Passer les données au template PDF
        $pdf = Pdf::loadView('pdf/documentPdf', [
            'title' => $content->title,
            'content' => $content->contenu,
            'type' => $createDocument->facture ? 'Facture' : 'Autre',
            'date' => $content->date,
        ]);

        // Télécharger le fichier PDF
        return $pdf->download($content->title . '.pdf');
    }

}