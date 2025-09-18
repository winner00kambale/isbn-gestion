<?php

namespace App\Http\Controllers\Payement;

use App\Http\Controllers\Controller;
use App\Mail\PayementRecuMail;
use App\Models\Inscription;
use App\Models\Payement;
use App\Models\Type_frais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PayementController extends Controller
{
    // public function index()
    // {
    //     $payements = Payement::with(['typeFrais', 'inscription'])->paginate(10);
    //     return view('pages.payement.index', compact('payements'));
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $payements = Payement::with([
            'typeFrais',        // Relation vers type_frais
            'inscription.etudiant',  // Relation vers l'étudiant via l'inscription
            'inscription.promotion', // Relation vers la promotion via l'inscription
            'inscription.annee'      // Relation vers l'année via l'inscription
        ])
            ->when($search, function ($query, $search) {
                $query->whereHas('inscription.etudiant', function ($q) use ($search) {
                    $q->where('nom', 'like', "%$search%")
                        ->orWhere('postnom', 'like', "%$search%")
                        ->orWhere('prenom', 'like', "%$search%");
                })
                    ->orWhereHas('inscription.promotion', function ($q) use ($search) {
                        $q->where('designation', 'like', "%$search%");
                    })
                    ->orWhereHas('typeFrais', function ($q) use ($search) {
                        $q->where('designation', 'like', "%$search%");
                    })
                    ->orWhereHas('inscription.annee', function ($q) use ($search) {
                        $q->where('designation', 'like', "%$search%");
                    })
                    ->orWhere('montant_chiffre', 'like', "%$search%")
                    ->orWhere('montant_lettre', 'like', "%$search%");
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('pages.payement.index', compact('payements'));
    }

    // Formulaire création
    public function create()
    {
        $types = Type_frais::all();
        $inscriptions = Inscription::with('etudiant')->get();
        return view('pages.payement.create', compact('types', 'inscriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'montant_lettre' => 'required|string',
            'montant_chiffre' => 'required|numeric',
            'code_type' => 'required|exists:type_frais,id',
            'code_inscription' => 'required|exists:inscriptions,id',
            'date_payement' => 'required|date',
        ]);

        $payement = Payement::create($request->all());
        $etudiant = $payement->inscription->etudiant;
        if ($etudiant && $etudiant->email) {
            Mail::to($etudiant->email)->send(new \App\Mail\PayementRecuMail($payement));
        }
        return redirect()->route('payements.index')->with('success', 'Payement enregistré avec succès');
    }

    public function edit(Payement $payement)
    {
        $types = Type_frais::all();
        $inscriptions = Inscription::with('etudiant')->get();
        return view('pages.payement.edit', compact('payement', 'types', 'inscriptions'));
    }

    // Mise à jour
    public function update(Request $request, Payement $payement)
    {
        $request->validate([
            'montant_lettre' => 'required|string',
            'montant_chiffre' => 'required|numeric',
            'code_type' => 'required|exists:type_frais,id',
            'code_inscription' => 'required|exists:inscriptions,id',
            'date_payement' => 'required|date',
        ]);

        $payement->update($request->all());
        return redirect()->route('payements.index')->with('success', 'Payement mis à jour avec succès');
    }

    public function destroy($id)
    {
        $payement = Payement::findOrFail($id);
        $payement->delete();

        return redirect()->back()->with('success', 'Le payement a été supprimé avec succès.');
    }

    public function recu($id)
    {
        $payement = Payement::with([
            'typeFrais',
            'inscription.etudiant',
            'inscription.promotion.option',
            'inscription.annee'
        ])->findOrFail($id);

        return view('rapports.recu', compact('payement'));
    }
}
