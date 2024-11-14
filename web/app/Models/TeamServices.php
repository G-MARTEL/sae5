<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamServices extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['team_service_id','FK_service_id','FK_employee_id'];

    public $timestamps = false;
}
