<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder
use Illuminate\Http\Request;
use App\Models\Ressource; // Assurez-vous que vous importez le bon modèle

class SupervisionController extends Controller
{
    public function showSupervision()
    {
        // Récupération des données de la table ressources
        $ressource = DB::table('ressources')->get();  // Récupérer toutes les ressources

        // Passage des données à la vue
        return view('supervision', ['devices' => $ressource]);
    }
}



