<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LocataireController extends Controller
{
    // Affiche la liste des locataires pour l'utilisateur connecté
    public function index()
    {
        $locataires = Locataire::where('user_id', auth()->id())->get();

        return view('locs.index', compact('locataires'));
    }

    // Affiche le formulaire pour créer un nouveau locataire
    public function create()
    {
        return view('locs.create');
    }

    // Enregistre un nouveau locataire dans la base de données
    public function store(Request $request)
    {
        // Validation des données envoyées
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'tel' => 'required|string|max:15',
            'email' => 'required|email|unique:locataires,email',
            'adresse' => 'required|string',
            'compte_bancaire' => 'nullable|string|max:255',
        ]);

        // Ajout de l'utilisateur connecté comme propriétaire du locataire
        $validatedData['user_id'] = auth()->id();

        // Création du locataire
        Locataire::create($validatedData);

        // Redirection avec message de succès
        return redirect()->route('locs.index')->with('success', 'Locataire créé avec succès.');
    }

    // Affiche le formulaire d'édition d'un locataire
    public function edit($id)
    {
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);

        return view('locs.edit', compact('locataire'));
    }

    // Met à jour un locataire existant
    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'tel' => 'required|string|max:15',
            'email' => 'required|email|unique:locataires,email,' . $id,
            'adresse' => 'required|string',
            'compte_bancaire' => 'nullable|string|max:255',
        ]);

        // Récupération du locataire appartenant à l'utilisateur connecté
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);

        // Mise à jour des informations
        $locataire->update($validatedData);

        // Redirection avec message de succès
        return redirect()->route('locs.index')->with('success', 'Locataire mis à jour avec succès.');
    }

    public function export()
    {
        $fileName = 'locataires_' . now()->format('Y-m-d') . '.csv';

        $response = new StreamedResponse(function () {
            $handle = fopen('php://output', 'w');

            // En-tête du fichier CSV
            fputcsv($handle, ['ID', 'Nom', 'Email', 'Téléphone', 'Adresse', 'Compte Bancaire']);

            // Récupération des locataires et écriture dans le CSV
            Locataire::chunk(100, function ($locataires) use ($handle) {
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

    // Supprime un locataire
    public function destroy($id)
    {
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);

        $locataire->delete();

        return redirect()->route('locs.index')->with('success', 'Locataire supprimé avec succès.');
    }
}
