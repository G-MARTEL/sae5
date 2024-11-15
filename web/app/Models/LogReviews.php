<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogReviews extends Model
{
    use HasFactory;

    protected $table = 'log_reviews';
    protected $primaryKey = 'log_review_id';

    protected $fillable = ['log_review_id','FK_review_id','FK_account_id',
                            'review','status','edited_date','FK_action_type_id'];

    public $timestamps = false;
}
