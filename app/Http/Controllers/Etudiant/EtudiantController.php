<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EtudiantController extends Controller
{
    public function getEtudiant(Request $request)
    {
        $query = Etudiant::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nom', 'LIKE', "%{$search}%")
                ->orWhere('postnom', 'LIKE', "%{$search}%")
                ->orWhere('genre', 'LIKE', "%{$search}%")
                ->orWhere('prenom', 'LIKE', "%{$search}%");
        }

        $query->orderByDesc('id');

        $etudiant = $query->paginate(10);

        return view('pages.etudiant.etudiant', [
            'etudiants' => $etudiant,
            'search' => $request->input('search')
        ]);
    }
    public function getStoreForm()
    {
        return view('pages.etudiant.store-etudiant');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'postnom' => 'required',
            'prenom' => 'nullable',
            'genre' => 'required',
            'phone' => 'nullable',
            'adresse' => 'nullable',
            'email' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors([
                'error' => 'erreur',
            ]);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('etudiant', 'public');
        }
        Etudiant::create($data);
        return redirect()->route('etudiant.index')->with('success', 'Etudiant enregistré avec succès !');
    }

    public function update(Request $request, $id)
    {
        $etudiant = Etudiant::find($id);
        if (!$etudiant) {
            return redirect()->route('etudiant.index')->with('error', 'Etuadiant non trouvé!');
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'postnom' => 'required',
            'prenom' => 'nullable',
            'genre' => 'required',
            'phone' => 'nullable',
            'adresse' => 'nullable',
            'email' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors([
                'error' => 'erreur',
            ]);
        }

        $data = $validator->validated();

        // ✅ Gestion de l'image
        if ($request->hasFile('image')) {
            if ($etudiant->image && Storage::disk('public')->exists($etudiant->image)) {
                Storage::disk('public')->delete($etudiant->image);
            }
            $data['image'] = $request->file('image')->store('etudiant', 'public');
        } else {
            unset($data['image']); // conserver l’ancienne image
        }

        $etudiant->update($data);

        return redirect()->route('etudiant.index')->with('success', 'Mis à jour réussi !');
    }

    public function edit(Etudiant $etudiant)
    {
        return view('pages.etudiant.update-etudiant', compact('etudiant'));
    }
}
