<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SupervisionController extends Controller
{
    public function showSupervision()
    {
        return view('supervision');
    }

    public function showGraphique($machineId)
    {
        // Récupérer la liste des machines
        $machines = DB::table('machines')->get();
    
        // Vérifier que la machine existe
        $machine = DB::table('machines')->where('machine_id', $machineId)->first();
        if (!$machine) {
            return redirect('/graphique'); // Redirige vers une page d'erreur ou la page principale
        }
    
        // Récupérer les données de la machine sélectionnée
        $ressources = DB::table('ressources_hist')
            ->where('FK_machine_id', $machineId)
            ->orderBy('save_date', 'asc')
            ->get();
    
        // Préparer les données pour les graphiques
        $labels = $ressources->pluck('save_date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d H:i');
        });
        $cpuData = $ressources->pluck('cpu');
        $ramData = $ressources->pluck('ram');
        $storageData = $ressources->pluck('storage');
        $pingData = $ressources->pluck('ping');
    
        // Transmettre les données à la vue
        return view('graphique', compact(
            'machines',
            'machineId', // Transmettre l'ID de la machine à la vue
            'labels',
            'cpuData',
            'ramData',
            'storageData',
            'pingData'
        ));
    }
    

    public function getMachineData(Request $request)
    {
        $machineId = $request->query('machine_id', 1); // Par défaut, machine_id = 1
    
        $ressources = DB::table('ressources_hist')
            ->where('FK_machine_id', $machineId)
            ->orderBy('save_date', 'asc')
            ->get();
    
        $labels = $ressources->pluck('save_date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d H:i');
        });
    
        return response()->json([
            'labels' => $labels,
            'cpuData' => $ressources->pluck('cpu'),
            'ramData' => $ressources->pluck('ram'),
            'storageData' => $ressources->pluck('storage'),
            'pingData' => $ressources->pluck('ping'),
        ]);
    }
    

    public function getDevices()
    {
        $ressources = DB::table('ressources')
            ->join('machines', 'ressources.FK_machine_id', '=', 'machines.machine_id')
            ->select('ressources.*', 'machines.name as machine_name', 'machines.max_storage')
            ->get();

        $maxRows = 900000;

        foreach ($ressources as $ressource) {
            $totalRows = DB::table('ressources_hist')->count();
            if ($totalRows >= $maxRows) {
                $rowsToDelete = $totalRows - $maxRows + 1;
                DB::table('ressources_hist')
                    ->orderBy('save_date', 'asc')
                    ->limit($rowsToDelete)
                    ->delete();
            }

            DB::table('ressources_hist')->insert([
                'FK_resource_id' => $ressource->ressource_id,
                'FK_machine_id' => $ressource->FK_machine_id,
                'ping' => $ressource->ping,
                'storage' => $ressource->storage,
                'ram' => $ressource->ram,
                'cpu' => $ressource->cpu,
                'save_date' => now()
            ]);

            $this->checkAndCreateNotification($ressource);
        }

        return response()->json($ressources);
    }

    private function checkAndCreateNotification($ressource)
    {
        $storagePercentage = ($ressource->storage / $ressource->max_storage) * 100;
        $notificationData = [];

        if (!$ressource->ping) {
            $notificationData['ping'] = $ressource->ping;
        }

        if ($storagePercentage >= 85) {
            $notificationData['storage'] = $ressource->storage;
        }

        if ($ressource->ram >= 80) {
            $notificationData['ram'] = $ressource->ram;
        }

        if ($ressource->cpu >= 80) {
            $notificationData['cpu'] = $ressource->cpu;
        }

        if (!empty($notificationData)) {
            $notificationType = ($storagePercentage >= 90 || $ressource->ram >= 90 || $ressource->cpu >= 90) ? 2 : 1;

            $notificationData['FK_machine_id'] = $ressource->FK_machine_id;
            $notificationData['FK_notification_type_id'] = $notificationType;
            $notificationData['date'] = now();

            DB::table('notifications')->insert($notificationData);
        }
    }
}
