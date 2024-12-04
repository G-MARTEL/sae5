<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SimulateurController extends Controller
{

    public function index()
    {
        return view('simulateurs.index');
    }
    
}