<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionsType extends Model
{
    use HasFactory;
    
    protected $table = 'actions_type';
    protected $primaryKey = 'action_type_id';

    protected $fillable = ['action_type_id','action_name'];

    public $timestamps = false;
}
