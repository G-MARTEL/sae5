<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Importer DB pour utiliser le Query Builder


use Illuminate\Http\Request;

class Autentification extends Controller
{
    public function showLoginForm()
    {
        return view('FormConnexion'); // Assure-toi que la vue existe
    }


    public function login(Request $request)
    {
    try {
        // Récupérer le nom de la base de données
        $connection = DB::connection('mysql'); // Préciser le nom de la connexion (par exemple 'mysql')
        $databaseName = $connection->getDatabaseName();
        
        // Vérifier si la connexion est bien établie
        if (!$databaseName) {
            throw new \Exception("Impossible de récupérer le nom de la base de données.");
        }

        // Récupérer les tables de la base de données
        $query = 'SHOW TABLES'; // Utiliser SHOW TABLES pour MySQL
        $tables = DB::select($query); // Utilisation de DB::select pour exécuter la requête

        // Extraire les noms des tables
        $tableNames = array_map(function ($table) {
            return (array_values((array)$table))[0]; // Assurez-vous d'accéder à la propriété correctement
        }, $tables);

        // Afficher le nom de la base de données et les tables
        echo $databaseName . '<br />';
        print_r($tableNames);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erreur lors de la connexion à la base de données: ' . $e->getMessage(),
        ], 500); // Retourner une réponse d'erreur avec un code 500
    }
}

    }
    

