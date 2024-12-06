<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message_contents extends Model
{
    use HasFactory;
    protected $table = 'message_contents';
    protected $primaryKey = 'message_content_id';

    protected $fillable = ['message_content_id','FK_employee_id','FK_client_id','is_active'];


    public $timestamps = false;
}
