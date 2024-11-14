<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotesRequest extends Model
{
    use HasFactory;

    protected $table = 'quoted_request';

    protected $fillable = ['quote_request_id','first_name','last_name','phone','email','type_of_service','message','creation_date'];

    public $timestamps = false;
}
