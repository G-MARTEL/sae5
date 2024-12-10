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

    public function getMessages(Request $request)
    {
        $clientId = session('id');

        // Récupération des messages avec les relations nécessaires
        $messages = Message::where('FK_sender_id', $clientId)
            ->orWhere('FK_recipient_id', $clientId)
            ->with(['Sender', 'Recipient', 'MessageContent']) // Charger les relations
            ->get();

        // Retourne les messages au format JSON
        return response()->json($messages);
    }


    public function showMessagerie(Request $request)
    {
        if (session('role') != 'client')
        {
            return redirect('/');
        }

        $client = session('id');
        $clientdate=Client::where('FK_account_id', $client)->first();
        if ($clientdate->FK_employee_id==null)
        {
            return redirect()->back(); //
        }
        $messages = Message::where('FK_sender_id', $client)
            ->orWhere('FK_recipient_id', $client)
            ->get();
        
        return view('messagerieClient', ['messages' => $messages]);
    }

    public function sendMessageClient(Request $request)
    {
        $client=session('id');
        $clientdate=Client::where('FK_account_id', $client)->first();
        $conversation= DB::table('conversations')->where('FK_client_id', $clientdate->client_id)->first();
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


    public function showConversationEmployee(Request $request)
    {
        if (session('role') != 'employee') 
        {
            return redirect('/');
        }
        $employee = session('id');
        $employee = Employee::where('FK_account_id', $employee)->first();
        $conversation = Conversation::where('FK_employee_id', $employee->employee_id)->get();
        return view('listeConv', ['conversations' => $conversation]);
    }

    public function showConversation(Request $request)
    {
        if (session('role') != 'employee')
        {
            return redirect('/');
        }
        $id = $request->id;
    
        // Récupérer la conversation avec l'ID donné
        $conversation = Conversation::where('conversation_id', $id)->first();
    
        $messages= Message::where('FK_conversation_id', $id)->get();

    
        return view('conversationEmployes', ['messages' => $messages]);
    }
    

    public function sendMessageEmployee(Request $request)
    {
        $id=$request->get('id');
        $employee = session('id');
        $ContentMessage =$request->message;
        $Message = new MessageContents();
        $Message->content =$ContentMessage;
        $Message->save();
        $accoutEmployees = Employee::where('employee_id',$employee)->first();
        $conversation= Conversation::where('conversation_id',$id)->first();

        $client= Client::where('client_id',$conversation->FK_client_id)->first();

        $Mess = new Message();

        $Mess->FK_sender_id=$employee;
        $Mess->FK_recipient_id=$client->FK_account_id;
        $Mess->FK_conversation_id=$conversation->conversation_id;
        $Mess->FK_message_content_id=$Message->message_content_id;
        $Mess->creation_date=date('Y-m-d');
        $Mess->save();

        return redirect('/employees/conversation/' . $id);
    }

}
