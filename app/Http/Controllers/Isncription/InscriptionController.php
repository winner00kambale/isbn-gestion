<?php

namespace App\Http\Controllers\Isncription;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Etudiant;
use App\Models\Inscription;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscriptionController extends Controller
{
    public function carte($id)
    {
        // On récupère l'inscription avec toutes ses relations
        $inscription = Inscription::with(['etudiant', 'promotion.option', 'annee'])
            ->findOrFail($id); // si l'inscription n'existe pas, 404

        return view('pages.inscription.carte', compact('inscription'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $inscriptions = DB::table('inscriptions')
            ->join('etudiants', 'inscriptions.code_etudiant', '=', 'etudiants.id')
            ->join('promotions', 'inscriptions.code_promotion', '=', 'promotions.id')
            ->join('options', 'promotions.code_option', '=', 'options.id')
            ->join('annees', 'inscriptions.code_annee', '=', 'annees.id')
            ->select(
                'inscriptions.id',
                'etudiants.nom',
                'etudiants.postnom',
                'etudiants.prenom',
                'promotions.designation as promotion',
                'options.designation as option',
                'annees.designation as annee',
                'inscriptions.created_at'
            )
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('etudiants.nom', 'like', "%$search%")
                        ->orWhere('etudiants.postnom', 'like', "%$search%")
                        ->orWhere('etudiants.prenom', 'like', "%$search%")
                        ->orWhere('promotions.designation', 'like', "%$search%")
                        ->orWhere('options.designation', 'like', "%$search%")
                        ->orWhere('annees.designation', 'like', "%$search%");
                });
            })
            ->orderByDesc('inscriptions.id')
            ->paginate(10);

        return view('pages.inscription.index', compact('inscriptions'));
    }

    public function create()
    {
        $etudiants = Etudiant::all();
        // $promotions = Promotion::all();
        $promotions = DB::table('promotions')
            ->join('options', 'promotions.code_option', '=', 'options.id')
            ->select('promotions.id', 'promotions.designation as promotion', 'options.designation as option')
            ->get();

        $annees = Annee::all();

        return view('pages.inscription.create', compact('etudiants', 'promotions', 'annees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_etudiant' => 'required|exists:etudiants,id',
            'code_promotion' => 'required|exists:promotions,id',
            'code_annee' => 'required|exists:annees,id',
        ]);

        Inscription::create([
            'code_etudiant' => $request->code_etudiant,
            'code_promotion' => $request->code_promotion,
            'code_annee' => $request->code_annee,
        ]);

        return redirect()->route('inscriptions.create')->with('success', 'Inscription enregistrée avec succès !');
    }

    public function edit($id)
    {
        // Charger l'inscription avec relations utiles
        $inscription = Inscription::with(['etudiant', 'annee', 'promotion.option'])->findOrFail($id);

        $etudiants = Etudiant::orderBy('nom')->get();
        $promotions = Promotion::with('option')->orderBy('designation')->get();
        $annees = Annee::orderByDesc('id')->get();

        // <-- adapte le chemin si ton blade est dans pages/inscriptions
        return view('pages.inscription.edit', compact('inscription', 'etudiants', 'promotions', 'annees'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'code_etudiant' => 'required|exists:etudiants,id',
            'code_promotion' => 'required|exists:promotions,id',
            'code_annee' => 'required|exists:annees,id',
        ]);

        $inscription = Inscription::findOrFail($id);
        $inscription->update([
            'code_etudiant' => $request->code_etudiant,
            'code_promotion' => $request->code_promotion,
            'code_annee' => $request->code_annee,
        ]);

        return redirect()->route('inscription.index')->with('success', 'Inscription mise à jour avec succès.');
    }
}
