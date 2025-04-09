<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LivreurController extends Controller 
{
    public function index()
    {
        $livreurs = Livreur::all();
        return view('livreurs.index', compact('livreurs')); 
    }

    public function create()
    {
        return view('admin'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:livreurs',
            'password' => 'required|string|min:8|confirmed',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
        ]);

        Livreur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'adresse' => $request->adresse,
            'telephone' => $request->telephone
        ]);

        return redirect()->route('livreurs.index')->with('success', 'Livreur ajouté avec succès.');
    }

   

    public function edit($id)
    {
        $livreur = Livreur::findOrFail($id);
        return view('livreurs.edit', compact('livreur')); 
    }

    public function update(Request $request, $id)
    {
        $livreur = Livreur::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:livreurs,email,'.$livreur->id,
            'password' => 'nullable|string|min:8|confirmed',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
        ]);

        $data = $request->only(['nom', 'prenom', 'email', 'adresse', 'telephone']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $livreur->update($data);

        return redirect()->route('livreurs.index')->with('success', 'Livreur modifié avec succès.');
    }

    public function destroy($id)
    {
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();

        return redirect()->route('livreurs.index')->with('success', 'Livreur supprimé avec succès.');
    }
}