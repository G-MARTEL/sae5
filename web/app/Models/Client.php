<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['client_id', 'FK_employee_id', 'FK_account_id'];

    public $timestamps = false;

    // Relation avec le modèle Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'FK_employee_id');
    }

    // Relation avec le modèle Account (corrigé)
    public function account()
    {
        return $this->belongsTo(Account::class, 'FK_account_id');
    }
}
