<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEmployee extends Model
{
    use HasFactory;

    protected $table = 'log_employees';

    protected $fillable = ['log_employee_id','employee_id','FK_function_id','FK_account_id','edited_date','FK_action_type_id'];

    public $timestamps = false;
}
