<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SupervisionController extends Controller
{
    // Afficher la page de supervision
    public function showSupervision()
    {
        // Récupérer la liste des machines
        $machines = DB::table('machines')->get();
        
        // Récupérer le nombre de machines
        $numberOfMachines = $machines->count();
        
        // Récupérer les x dernières entrées depuis ressources_hist
        $ressources = DB::table('ressources_hist')
            ->orderBy('save_date', 'desc')
            ->take($numberOfMachines)
            ->get();

        // Ajouter les noms des machines dans les données récupérées
        $ressourcesWithMachineNames = $ressources->map(function ($ressource) use ($machines) {
            $machine = $machines->firstWhere('machine_id', $ressource->FK_machine_id);
            $ressource->machine_name = $machine ? $machine->name : 'Machine inconnue';
            return $ressource;
        });

        // Retourner les données à la vue supervision
        return view('supervision', [
            'machines' => $machines,
            'ressources' => $ressourcesWithMachineNames,
        ]);
    }

    // Afficher le graphique pour une machine spécifique
    public function showGraphique($machineId = null)
    {
        // Récupérer la liste des machines
        $machines = DB::table('machines')->get();
        
        // Déterminer la machine sélectionnée
        $currentMachineId = $machineId ?? ($machines->first() ? $machines->first()->machine_id : null);
        
        // Si aucune machine n'existe, retourner la vue avec les machines disponibles
        if (!$currentMachineId) {
            return view('graphique', ['machines' => $machines]); 
        }

        // Récupérer toutes les données de la machine sélectionnée
        $ressources = DB::table('ressources_hist')
            ->where('FK_machine_id', $currentMachineId)
            ->orderBy('save_date', 'asc')
            ->get();
        
        // Calculer la valeur maximale du stockage pour cette machine
        $maxStorage = DB::table('machines')
            ->where('machine_id', $currentMachineId)
            ->value('max_storage');
        
        // Préparer les données pour les graphiques
        $labels = $ressources->pluck('save_date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d H:i');
        });
        $cpuData = $ressources->pluck('cpu');
        $ramData = $ressources->pluck('ram');
        $storageData = $ressources->pluck('storage');
        $pingData = $ressources->pluck('ping');
        
        // Récupérer le nom de la machine actuelle
        $machine = DB::table('machines')->where('machine_id', $currentMachineId)->first();
        $machineName = $machine ? $machine->name : 'Machine inconnue';  // Nom de la machine (si trouvé)

        // Transmettre les données à la vue
        return view('graphique', compact(
            'machines',
            'currentMachineId',  // Transmettre la machine actuelle à la vue
            'labels',
            'cpuData',
            'ramData',
            'storageData',
            'pingData',
            'maxStorage',
            'machineName' // Passez le nom de la machine
        ));
    }

    // API pour récupérer les données de la machine
    public function getMachineData(Request $request)
    {
        $machineId = $request->query('machine_id', 1); // Par défaut, machine_id = 1
    
        // Récupérer les ressources de la machine
        $ressources = DB::table('ressources_hist')
            ->where('FK_machine_id', $machineId)
            ->orderBy('save_date', 'asc')
            ->get();
    
        $labels = $ressources->pluck('save_date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d H:i');
        });
    
        return response()->json([
            'labels' => $labels,
            'cpuData' => $ressources->pluck('cpu'),
            'ramData' => $ressources->pluck('ram'),
            'storageData' => $ressources->pluck('storage'),
            'pingData' => $ressources->pluck('ping'),
        ]);
    }

    // Récupérer les dispositifs et gérer les notifications
    public function getDevices()
    {

        $machines = DB::table('machines')->get();
        $numberOfMachines = $machines->count();

        $ressources = DB::table('ressources_hist')
            ->join('machines', 'ressources_hist.FK_machine_id', '=', 'machines.machine_id')
            ->select('ressources_hist.*', 'machines.name as machine_name', 'machines.max_storage')
            ->orderBy('save_date', 'asc')
            ->take($numberOfMachines)
            ->get();

        return response()->json($ressources);
    }

    // Vérifier et créer une notification en cas de problème
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
