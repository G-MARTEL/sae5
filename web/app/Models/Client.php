<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Documents;
use App\Models\createDocuments;


class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $primaryKey = 'client_id';

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

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'FK_client_id');
    }

    public function documents()
    {
        return $this->hasMany(documents::class, 'FK_client_id');
    }

    public function createDocuments()
{
    return $this->hasMany(CreateDocuments::class, 'FK_client_id');
}

public function contentDocuments()
{
    return $this->hasMany(contentDocuments::class, 'FK_client_id');
}


}
