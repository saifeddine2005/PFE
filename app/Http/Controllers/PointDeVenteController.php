<?php

namespace App\Http\Controllers;

use App\Models\PointDeVente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PointDeVenteController extends Controller
{
    public function index()
    {
        $pointdeventes = PointDeVente::latest()->get();
        return view('pointdeventes.index', compact('pointdeventes'));
    }

    public function create()
    {
        return view('admin');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        $validated['image'] = $request->file('image')->store('pointdeventes', 'public');

        PointDeVente::create($validated);

        return redirect()->route('pointdeventes.index')
            ->with('success', 'Point de vente créé avec succès');
    }

 

    public function edit(PointDeVente $pointdevente)
    {
        return view('pointdeventes.edit', compact('pointdevente'));
    }

    public function update(Request $request, PointDeVente $pointdevente)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($pointdevente->image);
            $validated['image'] = $request->file('image')->store('pointdeventes', 'public');
        }

        $pointdevente->update($validated);

        return redirect()->route('pointdeventes.index')
            ->with('success', 'Point de vente mis à jour avec succès');
    }

    public function destroy(PointDeVente $pointdevente)
    {
        Storage::disk('public')->delete($pointdevente->image);
        $pointdevente->delete();

        return redirect()->route('pointdeventes.index')
            ->with('success', 'Point de vente supprimé définitivement');
    }
}