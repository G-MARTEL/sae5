<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Autentification extends Controller
{
    public function showLoginForm()
    {
        return view('FormConnexion'); // Assure-toi que la vue existe
    }

    public function login(Request $request)
    {
        return redirect()->route('home');
    }
}
