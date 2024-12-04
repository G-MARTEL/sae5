<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Functions;
use App\Models\QuotesRequest;

class DevisController extends Controller
{
    public function store(Request $request){

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'prestation' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        QuotesRequest::create([
            'first_name' => $validatedData['prenom'],
            'last_name' => $validatedData['nom'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'type_of_service' => $validatedData['prestation'],
            'message' => $validatedData['message'],
            'creation_date' => now(), 
        ]);

        return redirect()->back()->with('success', 'Votre demande a été envoyée avec succès !');
    }
}
