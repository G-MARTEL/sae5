<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';

    protected $fillable = ['contract_id','numero_contract','FK_service_id','FK_client_id','creation_date'];

    public $timestamps = false;
}
