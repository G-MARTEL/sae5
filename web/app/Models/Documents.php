<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{

    use HasFactory;

    protected $table = 'documents';

    protected $primaryKey = 'document_id';

    protected $fillable = ['document_id','FK_client_id','title','document','key','date'];
    
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class, 'FK_client_id');
    }

}