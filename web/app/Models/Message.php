<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $primaryKey = 'message_id';

    protected $fillable = ['message_id','FK_sender_id','FK_recipient_id','FK_conversation_id','FK_message_content_id','creation_date',];

    public function Sender()
    {
        return $this->belongsTo(Account::class, 'FK_sender_id');
    }
    public function Recipient()
    {
        return $this->belongsTo(Account::class, 'FK_recipient_id');
    }

    public function Conversation()
    {
        return $this->belongsTo(Conversation::class, 'FK_conversation_id');
    }

    public function MessageContent()
    {
        return $this->belongsTo(MessageContents::class, 'FK_message_content_id');
    }

    public $timestamps = false;
}
