<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LocataireController extends Controller
{
    // Affiche la liste des locataires
    public function index(): Response
    {
        $locataires = Locataire::where('user_id', auth()->id())->get();

        return Inertia::render('Locs/Index', [
            'locataires' => $locataires,
            'flash' => [
                'success' => session('success'),
            ],
        ]);
    }

    // Affiche le formulaire de création
    public function create(): Response
    {
        return Inertia::render('Locs/Create');
    }

    // Stocke un nouveau locataire
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'tel' => 'required|string|max:15',
            'email' => 'required|email|unique:locataires,email',
            'adresse' => 'required|string',
            'compte_bancaire' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        Locataire::create($validated);

        return redirect()->route('locs.index')->with('success', 'Locataire créé avec succès.');
    }

    // Affiche le formulaire d'édition
    public function edit($id): Response
    {
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);

        return Inertia::render('Locs/Edit', [
            'locataire' => $locataire,
        ]);
    }

    // Met à jour un locataire
    public function update(Request $request, $id)
    {
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'tel' => 'required|string|max:15',
            'email' => 'required|email|unique:locataires,email,' . $locataire->id,
            'adresse' => 'required|string',
            'compte_bancaire' => 'nullable|string|max:255',
        ]);

        $locataire->update($validated);

        return redirect()->route('locs.index')->with('success', 'Locataire mis à jour avec succès.');
    }

    // Supprime un locataire
    public function destroy($id)
    {
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);
        $locataire->delete();

        return redirect()->route('locs.index')->with('success', 'Locataire supprimé avec succès.');
    }

    // Exporte les locataires au format CSV
    public function export(): StreamedResponse
    {
        $fileName = 'locataires_' . now()->format('Y-m-d') . '.csv';

        $response = new StreamedResponse(function () {
            $handle = fopen('php://output', 'w');

            // En-tête CSV
            fputcsv($handle, ['ID', 'Nom', 'Email', 'Téléphone', 'Adresse', 'Compte Bancaire']);

            // Locataires de l'utilisateur
            Locataire::where('user_id', auth()->id())
                ->chunk(100, function ($locataires) use ($handle) {
                    foreach ($locataires as $locataire) {
                        fputcsv($handle, [
                            $locataire->id,
                            $locataire->nom,
                            $locataire->email,
                            $locataire->tel,
                            $locataire->adresse,
                            $locataire->compte_bancaire,
                        ]);
                    }
                });

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }
}
