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

        if (!$prestation) {
            abort(404); // Redirige vers une page 404 si la prestation n'existe pas
        }

        return view('prestation', ['prestation' => $prestation]);
    }

}
