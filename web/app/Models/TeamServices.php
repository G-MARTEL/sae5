<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamServices extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['team_service_id','FK_service_id','FK_employee_id'];

    public function services()
    {
        return $this->belongsTo(Services::class, 'FK_service_id');
    }

    public function employees()
    {
        return $this->belongsTo(Employees::class, 'FK_employee_id');
    }

    public $timestamps = false;
}
