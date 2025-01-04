<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PretImmobilierController extends Controller
{
    // Afficher le formulaire
    public function index()
    {
        return view('simulateur.form');
    }

    // // Traiter la simulation
    // public function simulateImmo(Request $request)
    // {
    //     $capital = $request->input('capital');
    //     $taux = $request->input('taux') / 100 / 12;
    //     $duree = $request->input('duree') * 12; 
    //     $apport = $request->input('apport', 0);
    //     $assurance = $request->input('assurance', 0) / 100;

    //     // Capital emprunté après apport
    //     $capital_emprunte = $capital - $apport;

    //     // Mensualité hors assurance
    //     $mensualite = ($capital_emprunte * $taux * pow(1 + $taux, $duree)) /
    //                   (pow(1 + $taux, $duree) - 1);

    //     // Total des intérêts
    //     $total_interets = ($mensualite * $duree) - $capital_emprunte;

    //     // Assurance mensuelle
    //     $assurance_mensuelle = ($capital_emprunte * $assurance) / 12;
    //     $mensualite_totale = $mensualite + $assurance_mensuelle;

    //     // Résultat
    //     $resultat = [
    //         'capital_emprunte' => $capital_emprunte,
    //         'mensualite' => round($mensualite, 2),
    //         'total_interets' => round($total_interets, 2),
    //         'mensualite_totale' => round($mensualite_totale, 2),
    //     ];

    //     return view('simulateur.resultat', compact('resultat'));
    // }
}
