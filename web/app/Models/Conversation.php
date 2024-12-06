<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $table = 'conversations';
    protected $primaryKey = 'conversation_id';

    protected $fillable = ['conversation_id','FK_employee_id','FK_client_id','is_active'];

    public function Client(){

        return $this->belongsTo(Client::class, 'FK_client_id');
    }

    public function employee(){

        return $this->belongsTo(Employee::class, 'FK_employee_id');
    }


    public $timestamps = false;
}
