<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageContents;

class MessageriControlleur extends Controller
{
    public function showMessagerie(Request $request)
    {
        $client = session('id');

        $messages = Message::where('FK_sender_id', $client)
            ->orWhere('FK_recipient_id', $client)
            ->get();
        return view('messagerieClient', ['messages' => $messages]);
    }

    public function sendMessageClient(Request $request)
    {
        $client=session('id');
        $clientdate=Client::where('FK_account_id', $client)->first();
        $conversation= DB::table('conversations')->where('FK_client_id', $client)->first();
        if ($conversation==null)
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
        $accoutEmployees = Employee::where('employee_id',$clientdate->FK_employee_id)->first();

        $Mess = new Message();

        $Mess->FK_sender_id=$client;
        $Mess->FK_recipient_id=$accoutEmployees->FK_account_id;
        $Mess->FK_conversation_id=$conversation->conversation_id;
        $Mess->FK_message_content_id=$Message->message_content_id;
        $Mess->creation_date=date('Y-m-d');
        $Mess->save();
        
        return redirect()->back();
    }
}
