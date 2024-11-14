<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['service_id','title','description','picture','advantage','situations'];

    public $timestamps = false;
}
