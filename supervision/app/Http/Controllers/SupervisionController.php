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

        // Insertion dans la table ressources_hist
        foreach ($ressources as $ressource) {
            DB::table('ressources_hist')->insert([
                'FK_resource_id' => $ressource->ressource_id,
                'FK_machine_id' => $ressource->FK_machine_id,
                'ping' => $ressource->ping,
                'storage' => $ressource->storage,
                'ram' => $ressource->ram,
                'cpu' => $ressource->cpu,
                'save_date' => now() // Ajoute la date et l'heure actuelles
            ]);
        }

        // Retour des données en JSON pour l'AJAX
        return response()->json($ressources);
    }
}
