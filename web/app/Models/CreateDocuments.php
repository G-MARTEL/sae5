<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateDocuments extends Model
{

    use HasFactory;

    protected $table = 'create_documents';

    protected $primaryKey = 'createdocument_id';

    protected $fillable = ['createdocument_id','FK_employee_id','FK_client_id','facture'];
    
    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'FK_employee_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'FK_client_id');
    }

    public function contentDocuments()
    {
        return $this->hasMany(ContentDocuments::class, 'FK_createdocument_id');
    }


}