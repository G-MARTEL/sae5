<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';

    protected $fillable = ['contract_id','numero_contract','FK_service_id','FK_client_id','creation_date'];

    public function Client()
    {
        return $this->belongsTo(Client::class, 'FK_client_id');
    }

    public $timestamps = false;
}
