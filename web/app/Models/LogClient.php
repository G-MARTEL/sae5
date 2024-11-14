<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogClient extends Model
{
    use HasFactory;

    protected $table = 'log_clients';

    protected $fillable = ['log_client_id','FK_client_id','FK_account_id',
    'FK_employee_id','edited_date','FK_action_type_id'];
    
    public $timestamps = false;
}
