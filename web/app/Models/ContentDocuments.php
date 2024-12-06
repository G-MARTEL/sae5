<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentDocuments extends Model
{
    use HasFactory;

    protected $table = 'content_documents';

    protected $primaryKey = 'contentdocument_id';

    protected $fillable = ['contentdocument_id','title','contenu','FK_createdocument_id','date'];
    
    public $timestamps = false;

    public function createDocument()
    {
        return $this->belongsTo(CreateDocument::class, 'FK_createdocument_id');
    }

}