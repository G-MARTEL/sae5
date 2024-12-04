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

        // Définir la limite maximale pour ressources_hist
        $maxRows = 900000;

        foreach ($ressources as $ressource) {
            // Vérifiez le nombre total de lignes dans ressources_hist
            $totalRows = DB::table('ressources_hist')->count();

            // Si le total dépasse la limite, supprimez les enregistrements les plus anciens
            if ($totalRows >= $maxRows) {
                $rowsToDelete = $totalRows - $maxRows + 1; // Ajuster pour faire de la place
                DB::table('ressources_hist')
                    ->orderBy('save_date', 'asc') // Supprime les plus anciennes
                    ->limit($rowsToDelete)
                    ->delete();
            }

            // Insérer les nouvelles données
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
