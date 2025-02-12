<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';
    public $timestamps = false;
    
    protected $fillable = ['notification_id', 'content', 'FK_account_id_recipient', 'FK_account_id_sender', 'date'];

    public function recipient()
{
    return $this->belongsTo(Account::class, 'FK_account_id_recipient');
}

public function sender()
{
    return $this->belongsTo(Account::class, 'FK_account_id_sender');
}


}