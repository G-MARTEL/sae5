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
        $databaseName = $pdo->getAttribute(PDO::ATTR_DATABASE);

        // Récupérer les tables de la base de données
        $query = 'SELECT name FROM sqlite_master WHERE type="table"';
        $stmt = $pdo->query($query);
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Vérifier si la table spécifiée existe
        $tableExists = in_array($tableToCheck, $tables);

        return [
            'database' => $databaseName,
            'tables' => $tables,
            'tableExists' => $tableExists,
        ];
    } catch (PDOException $e) {
        return [
            'error' => 'Erreur lors de la connexion à la base de données: ' . $e->getMessage(),
        ];
    }
        $mdp =$request -> password;
        $email = $request -> email;
        $account = DB::table('accounts')->where('email', $request->email)->first();
        if ($account)
        {
            $employees = DB::table('employees')->where('FK_account_id',$account.id)->first();
            if ($employees){
                $admin=DB::table('function')->where('FK_function_id',$employees.FK_function_id)->first();
                if ($admin->name == 'Admin'){
                    echo 'Admin';
                }
                else{
                    echo 'employees';
                }
            }
            else{echo 'utilisateur';}
        }
        return view('FormConnexion');
        
    }
}
