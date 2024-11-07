<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PrestationsController extends Controller
{
    //
    public function showPrestations(){
        $prestations = DB::table('services')->get();
        return view('prestations', ['prestations' => $prestations]);

    }

    public function show($id){
        $prestation = DB::table('services')->where('service_id', $id)->first();

        $employes = DB::table('team_services')
        ->join('employees', 'team_services.FK_employee_id', '=', 'employees.employee_id')
        ->join('accounts', 'employees.FK_account_id', '=', 'accounts.account_id')
        ->where('team_services.FK_service_id', $id)
        ->select('accounts.first_name', 'accounts.last_name', 'accounts.picture')
        ->get();
    

        if (!$prestation) {
            abort(404); 
        }

        return view('prestation', ['prestation' => $prestation,
                                    'employes' => $employes]);
    }

}
