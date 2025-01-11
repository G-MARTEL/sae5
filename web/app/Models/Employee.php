<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $primaryKey = 'employee_id';

    protected $fillable = ['employee_id','FK_function_id','FK_account_id','isActif'];


    public function account()
    {
        return $this->belongsTo(Account::class, 'FK_account_id');
    }
    
    public function functions()
    {
        return $this->belongsTo(Functions::class, 'FK_function_id');
    }

    public $timestamps = false;
}
