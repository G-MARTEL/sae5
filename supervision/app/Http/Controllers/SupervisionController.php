<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SupervisionController extends Controller
{
    public function showSupervision()
    {
        return view('supervision');
    }

    public function getDevices()
    {
        // Récupération des données avec jointure
        $ressources = DB::table('ressources')
            ->join('machines', 'ressources.FK_machine_id', '=', 'machines.machine_id')
            ->select(
                'ressources.*',
                'machines.name as machine_name',
                'machines.max_storage'
            )
            ->get();
    
        // Retour des données en JSON pour l'AJAX
        return response()->json($ressources);
    }
}
