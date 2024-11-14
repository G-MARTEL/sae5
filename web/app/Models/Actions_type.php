<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actions_type extends Model
{
    use HasFactory;
    
    protected $table = 'actions_type';

    protected $fillable = ['action_type_id','action_name'];

    public $timestamps = false;
}
