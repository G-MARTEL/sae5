<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $table = 'ressources'; // Nom de la table dans la base de données
    protected $primaryKey = 'ressource_id'; // Clé primaire de la table
    public $timestamps = false; // Si la table n'a pas de colonnes created_at et updated_at
}
