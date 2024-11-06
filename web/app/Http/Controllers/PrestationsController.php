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

}
