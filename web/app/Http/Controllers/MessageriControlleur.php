<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Client;

class MessageriControlleur extends Controller
{
    public function showMessagerie(Request $request)
    {
        return view('messagerieClient');
    }

    public function sendMessageClient(Request $request)
    {
        $client=session('id');
        $clientdate=Client::where('FK_account_id', $client)->first();
        $conv= DB::table('conversations')->where('FK_client_id', $client)->first();
        if ($conv==null)
        {
            DB::table('conversations')->insert([
                'FK_employee_id' => $clientdate->FK_employee_id,
                'FK_client_id' => $clientdate->client_id,
                'is_active' => 1,
            ]);
        }
        
    }
}
