<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = ['review_id','FK_account_id','review','status','creation_date'];
    
    public function account()
    {
        return $this->belongsTo(Account::class, 'FK_account_id');
    }
    public $timestamps = false;
}
