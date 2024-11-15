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

    public function Reviews()
    {
        return $this->belongsTo(Reviews::class, 'FK_review_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'FK_account_id');
    }
    public function actionType()
    {
        return $this->belongsTo(ActionsTyoe::class, 'FK_service_id');
    }

    public $timestamps = false;
}
