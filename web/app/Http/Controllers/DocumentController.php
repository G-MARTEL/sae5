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