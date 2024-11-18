<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder

class SupervisionController extends Controller
{
    public function showSupervision()
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

        // Passage des données à la vue
        return view('supervision', ['devices' => $ressources]);
    }
}
