<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';

    protected $fillable = ['account_id', 'first_name',
                         'last_name','phone', 'postal_address',
                         'code_address','city','picture','email'
                         ,'password','creation_date'];

    public $timestamps = false;

}
