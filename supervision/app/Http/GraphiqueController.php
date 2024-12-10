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