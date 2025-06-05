<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boxs;
use Inertia\Inertia;

class BoxsController extends Controller
{
    public function index()
    {
        $boxs = Boxs::where('user_id', auth()->id())->get();

        return Inertia::render('Boxs/Index', [
            'boxs' => $boxs,
            'flash' => [
                'success' => session('success'),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Boxs/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'lieux' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'occupé' => 'required|boolean',
        ]);

        $validatedData['user_id'] = auth()->id();
        Boxs::create($validatedData);

        return redirect()->route('boxs.index')->with('success', 'Box créée avec succès.');
    }

    public function edit($id)
    {
        $box = Boxs::where('user_id', auth()->id())->findOrFail($id);

        return Inertia::render('Boxs/Edit', [
            'box' => $box,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:1000',
            'lieux' => 'nullable|string|max:255',
            'prix' => 'nullable|numeric|min:0',
            'occupé' => 'required|boolean',
        ]);

        $box = Boxs::where('user_id', auth()->id())->findOrFail($id);
        $box->update($validatedData);

        return redirect()->route('boxs.index')->with('success', 'Box mise à jour avec succès !');
    }

    public function destroy($id)
    {
        $box = Boxs::where('user_id', auth()->id())->findOrFail($id);
        $box->delete();

        return redirect()->route('boxs.index')->with('success', 'Box supprimée avec succès !');
    }

    public function import()
    {
        $userId = auth()->id();

        $boxs = [
            [
                'name' => 'Box centre-ville',
                'desc' => 'Box idéalement située en plein centre, facile d’accès.',
                'lieux' => 'Lyon',
                'prix' => 120,
                'occupé' => false,
            ],
            [
                'name' => 'Box sécurisé en sous-sol',
                'desc' => 'Parfait pour stocker des meubles ou des archives.',
                'lieux' => 'Toulouse',
                'prix' => 95,
                'occupé' => true,
            ],
            [
                'name' => 'Box XXL avec accès camion',
                'desc' => 'Grande capacité, idéal pour un déménagement.',
                'lieux' => 'Bordeaux',
                'prix' => 180,
                'occupé' => false,
            ],
            [
                'name' => 'Box dans entrepôt partagé',
                'desc' => 'Stockage dans entrepôt partagé, très bon rapport qualité/prix.',
                'lieux' => 'Marseille',
                'prix' => 85,
                'occupé' => false,
            ],
            [
                'name' => 'Petite box pas chère',
                'desc' => 'Format compact, parfait pour étudiants ou saisonniers.',
                'lieux' => 'Lille',
                'prix' => 60,
                'occupé' => true,
            ],
            [
                'name' => 'Box ventilé pour stockage sensible',
                'desc' => 'Convient pour stocker du matériel fragile ou humide.',
                'lieux' => 'Nantes',
                'prix' => 130,
                'occupé' => false,
            ],
            [
                'name' => 'Box accès 24/7',
                'desc' => 'Accès permanent avec badge sécurisé.',
                'lieux' => 'Paris',
                'prix' => 160,
                'occupé' => true,
            ],
            [
                'name' => 'Box en périphérie',
                'desc' => 'Moins cher car situé en dehors du centre-ville.',
                'lieux' => 'Montpellier',
                'prix' => 70,
                'occupé' => false,
            ],
            [
                'name' => 'Box très lumineux',
                'desc' => 'Box avec fenêtre, rare pour ce type de service.',
                'lieux' => 'Nice',
                'prix' => 150,
                'occupé' => true,
            ],
            [
                'name' => 'Box isolé dans zone industrielle',
                'desc' => 'Parfait pour les artisans ou les entrepreneurs.',
                'lieux' => 'Strasbourg',
                'prix' => 110,
                'occupé' => false,
            ],
        ];

        // Ajoute l'user_id et les timestamps
        $now = now();
        foreach ($boxs as &$box) {
            $box['user_id'] = $userId;
            $box['created_at'] = $now;
            $box['updated_at'] = $now;
        }

        \App\Models\Boxs::insert($boxs);

        return redirect()->route('boxs.index')->with('success', '10 boxs réalistes ont été importées avec succès.');
    }
}
