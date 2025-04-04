<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAccount extends Model
{
    use HasFactory;

    protected $table = 'log_accounts';
    protected $primaryKey = 'log_account_id';

    protected $fillable = ['log_account_id','FK_account_id', 'first_name',
    'last_name','phone', 'postal_address',
    'code_address','city','picture','email'
    ,'password','edited_date','FK_action_type_id'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'FK_account_id');
    }

    public function ActionType()
    {
        return $this->belongsTo(Account::class, 'FK_action_type_id');
    }
    public $timestamps = false;
}
