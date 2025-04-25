<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
<<<<<<< HEAD

=======
>>>>>>> 7b90c3555c16ee25bae6338025bc2a1b7295a919
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LivreurController extends Controller 
{
    public function index()
    {
        $livreurs = Livreur::all();
<<<<<<< HEAD
        return view('livreur.index', compact('livreurs')); 
=======
        return view('livreurs.index', compact('livreurs')); 
    }

    public function create()
    {
        return view('admin'); 
>>>>>>> 7b90c3555c16ee25bae6338025bc2a1b7295a919
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        // 🔒 Validation des champs
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:comptes,email',
            'mot_de_passe' => 'required|string|min:6',
            'address' => 'required|string|max:255',
            'numero' => 'required|string|max:15',
            'role'=>"livreur",
// Contrôler que le rôle soit valide
        ]);

        // 💾 Création du compte avec le mot de passe crypté
        Livreur::create([
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'role' =>  $validated['role'], 
            'mot_de_passe' => Hash::make($validated['mot_de_passe']), // Hash du mot de passe
            'address' => $validated['address'],
            'numero' => $validated['numero'],
           
            
        ]);

        // 🔁 Redirection avec message
        return redirect()->route('livreurs.index')->with('success', 'Compte créé avec succès.');
    }
    public function edit($id)
    {
        $livreur = Livreur::find($id);
        return view('livreur.edit', compact('livreur'));
    }
    public function update($id,Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:comptes,email,' . $id,
            'mot_de_passe' => 'nullable|string|min:6',
            'address' => 'required|string|max:255',
            'numero' => 'required|string|max:15',
        ]);
        $livreur = Livreur::find($id);
        Livreur::where('id', $id)->update([
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'numero' => $validated['numero'],
        ]);
        return redirect()->route('livreurs.index')->with('success', 'Compte mis à jour avec succès.');

     }
    public function delete($id){
        $livreur = Livreur::find($id);
        if ($livreur) {
            $livreur->delete();
            return redirect()->route('livreurs.index')->with('success', 'Compte supprimé avec succès.');
        } else {
            return redirect()->route('livreurs.index')->with('error', 'Compte non trouvé.');
        }
    }
    
    

=======
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
>>>>>>> 7b90c3555c16ee25bae6338025bc2a1b7295a919
}