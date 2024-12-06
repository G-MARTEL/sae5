<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageContents extends Model
{
    use HasFactory;
    protected $table = 'message_contents';
    protected $primaryKey = 'message_content_id';

    protected $fillable = ['message_content_id','content'];


    public $timestamps = false;
}
