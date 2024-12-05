<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';
    protected $primaryKey = 'contract_id';

    protected $fillable = ['contract_id','numero_contract','FK_service_id','FK_client_id','FK_employee_id','creation_date','is_active'];

    public function Client()
    {
        return $this->belongsTo(Client::class, 'FK_client_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'FK_employee_id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'FK_service_id');
    }

    public $timestamps = false;
}
