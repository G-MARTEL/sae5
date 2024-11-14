<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEmployee extends Model
{
    use HasFactory;

    protected $table = 'log_employees';

    protected $fillable = ['log_employee_id','FK_employee_id','FK_function_id','FK_account_id','edited_date','FK_action_type_id'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'FK_account_id');
    }

    public function functions()
    {
        return $this->belongsTo(Functions::class, 'FK_function_id');
    }
    public function employees()
    {
        return $this->belongsTo(Employees::class, 'FK_employee_id');
    }
    public function ActionType()
    {
        return $this->belongsTo(Account::class, 'FK_action_type_id');
    }
    public $timestamps = false;
}
