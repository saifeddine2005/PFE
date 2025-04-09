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
}