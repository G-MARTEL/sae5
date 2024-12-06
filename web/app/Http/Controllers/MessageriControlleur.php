<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageContents;

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
            $conversation= new Conversation();
            $conversation->FK_employee_id=$clientdate->FK_employee_id;
            $conversation->FK_client_id=$clientdate->client_id;
            $conversation->is_active=1;
            $conversation->save();
        }
        $ContentMessage =$request->message;
        $Message = new MessageContents();
        $Message->content =$ContentMessage;
        $Message->save();
        
        dd($Message->message_content_id);
    }
}
