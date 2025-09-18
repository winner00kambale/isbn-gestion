<?php

namespace App\Http\Controllers\Annee;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnneeController extends Controller
{
    public function indexAnnee(Request $request)
    {
        $query = Annee::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('designation', 'LIKE', "%{$search}%");
        }

        $query->orderByDesc('id');

        $annee = $query->paginate(10);

        return view('pages.annee.annee', [
            'annees' => $annee,
            'search' => $request->input('search')
        ]);
    }
    public function getFormAnnee()
    {
        return view('pages.annee.annee-storey');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'designation' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors([
                'error' => 'erreur',
            ]);
        }

        $data = $validator->validated();

        Annee::create($data);
        return redirect()->route('annee.index')->with('success', 'Année enregistrée avec succès !');
    }
    public function edit(Annee $annee)
    {
        return view('pages.annee.annee-update', compact('annee'));
    }
    public function update(Request $request, $id)
    {
        $annee = Annee::find($id);
        if (!$annee) {
            return redirect()->route('annee.index')->with('error', 'annee non trouvée!');
        }

        $validator = Validator::make($request->all(), [
            'designation' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors([
                'error' => 'erreur',
            ]);
        }

        $data = $validator->validated();

        $annee->update($data);

        return redirect()->route('annee.index')->with('success', 'Mis à jour réussie !');
    }
}
