<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        $categories = Categorie::all();
        return view('produit.index', compact('produits','fournisseurs','categories'));
    }
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'Nom_du_produit' => 'required|string|max:255',
            'Prix' => 'required|numeric|min:0',
            'Fournisseur' => 'required|exists:fournisseurs,id',
            'Catégorie' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);
    
        // Sauvegarde de l'image si présente
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        }
    
        // Création du produit
        $produit = new Produit();
        $produit->nom = $validated['Nom_du_produit'];
        $produit->prix = $validated['Prix'];
        $produit->fournisseur_id = $validated['Fournisseur'];
        $produit->categorie_id = $validated['Catégorie'];
        $produit->image = $imagePath ?? '';
        $produit->save();
    
        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }
    public function edit($id)
    {
        $produit = Produit::find($id);
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
        return view('produit.edit', compact('produit','categories','fournisseurs'));
    }
    public function update($id,Request $request)
    {
      $validated = $request->validate([
            'nom_de_produit' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'fournisseur' => 'required|exists:fournisseurs,id',
            'categorie' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);
       
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        } else {
            $imagePath = Produit::find($id)->image;
        }
           

        Produit::where('id', $id)->update([
            'nom' => $validated['nom_de_produit'],
            'prix' => $validated['prix'],
            'fournisseur_id' => $validated['fournisseur'],
            'categorie_id' => $validated['categorie'],
            'image' => $imagePath,
        ]);

        
           return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
     }
     public function delete($id){
       
    $produit= Produit::find($id);
    if($produit){
        // Supprimer l'image du produit
        if ($produit->image) {
            Storage::disk('public')->delete($produit->image);
        }
        // Supprimer le produit de la base de données
        $produit->delete();
    }
    return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
     }

    
=======
        $produits = Produit::with(['fournisseur', 'categorie'])->latest()->get();
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $fournisseurs = Fournisseur::all();
        $categories = Categorie::all();
        return view('admin', compact('fournisseurs', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:produits',
            'prix' => 'required|numeric|min:0',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048'
        ]);

        $validated['image'] = $request->file('image')->store('produits', 'public');

        Produit::create($validated);

        return redirect()->route('produits.index')
            ->with('success', 'Produit créé avec succès');
    }

    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        $fournisseurs = Fournisseur::all();
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'fournisseurs', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:produits,nom,'.$produit->id,
            'prix' => 'required|numeric|min:0',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($produit->image);
            $validated['image'] = $request->file('image')->store('produits', 'public');
        }

        $produit->update($validated);

        return redirect()->route('produits.index')
            ->with('success', 'Produit mis à jour avec succès');
    }

    public function destroy(Produit $produit)
    {
        Storage::disk('public')->delete($produit->image);
        $produit->delete();

        return redirect()->route('produits.index')
            ->with('success', 'Produit supprimé définitivement');
    }
>>>>>>> 7b90c3555c16ee25bae6338025bc2a1b7295a919
}