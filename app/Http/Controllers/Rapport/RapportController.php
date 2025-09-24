<?php

namespace App\Http\Controllers\Rapport;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Models\Modalite;
use App\Models\Option;
use App\Models\Payement;
use App\Models\Promotion;
use App\Models\Type_frais;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function recu()
    {
        return view('rapports.recu');
    }

    public function getRapport()
    {
        return view('rapports.index');
    }

    public function journal()
    {
        $payement = Payement::with([
            'typeFrais',
            'inscription.etudiant',
            'inscription.promotion.option',
            'inscription.annee'
        ])->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('rapports.journal', compact('payement'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('journal_paye.pdf');
    }

    public function selectionForm()
    {
        $promotions = Promotion::with('option')->get();
        $options = Option::all();
        $types = Type_frais::all();

        return view('rapports.selection', compact('promotions', 'options', 'types'));
    }

    // public function generate(Request $request)
    // {
    //     $request->validate([
    //         'promotion_id' => 'required|exists:promotions,id',
    //         'option_id'    => 'required|exists:options,id',
    //         'type_id'      => 'required|exists:type_frais,id',
    //     ]);

    //     $promotionId = $request->promotion_id;
    //     $optionId = $request->option_id;
    //     $typeId = $request->type_id;

    //     // ✅ Inscriptions des étudiants de cette promotion + option
    //     $inscriptions = Inscription::with(['etudiant', 'promotion.option'])
    //         ->where('code_promotion', $promotionId)
    //         ->whereHas('promotion', function ($q) use ($optionId) {
    //             $q->where('code_option', $optionId);
    //         })
    //         ->get();

    //     // ✅ Paiements correspondants
    //     $payes = Payement::with(['inscription.etudiant', 'inscription.promotion.option', 'typeFrais'])
    //         ->where('code_type', $typeId)
    //         ->whereHas('inscription', function ($q) use ($promotionId, $optionId) {
    //             $q->where('code_promotion', $promotionId)
    //                 ->whereHas('promotion', function ($q2) use ($optionId) {
    //                     $q2->where('code_option', $optionId);
    //                 });
    //         })
    //         ->get();

    //     $modalites = Modalite::where('code_promotion', $promotionId)
    //         ->where('code_type', $typeId)
    //         ->get();

    //     // // ✅ Inscriptions qui n’ont pas payé
    //     // $etudiantsPayes = $payes->pluck('code_inscription')->unique();
    //     // $nonPayes = $inscriptions->whereNotIn('id', $etudiantsPayes);

    //     // Étudiants qui ont payé
    //     $etudiantsPayes = Payement::where('code_type', $typeId)
    //         ->pluck('code_inscription')
    //         ->unique();

    //     // Étudiants qui n’ont pas payé
    //     $nonPayes = Inscription::with(['etudiant', 'promotion.option'])
    //         ->where('code_promotion', $promotionId)
    //         ->whereNotIn('id', $etudiantsPayes)
    //         ->get();


    //     // ✅ Générer PDF
    //     $pdf = Pdf::loadView('rapports.resultat', compact('payes', 'nonPayes','modalites'));

    //     return $pdf->download('rapport_irregularites.pdf');
    // }
    public function generate(Request $request)
    {
        $request->validate([
            'promotion_id' => 'required|exists:promotions,id',
            'type_id'      => 'required|exists:type_frais,id',
        ]);

        $promotionId = (int) $request->promotion_id;
        $typeId = (int) $request->type_id;
        
        // ✅ Inscriptions des étudiants de cette promotion
        $inscriptions = Inscription::with(['etudiant', 'promotion.option'])
            ->where('code_promotion', $promotionId)
            ->get();

        // ✅ Paiements correspondants
        $payes = Payement::with(['inscription.etudiant', 'inscription.promotion.option', 'typeFrais'])
            ->where('code_type', $typeId)
            ->whereHas('inscription', function ($q) use ($promotionId) {
                $q->where('code_promotion', $promotionId);
            })
            ->get();

        // ✅ Modalité pour cette promotion + type de frais
        $modalites = Modalite::where('code_promotion', $promotionId)
            ->where('code_type', $typeId)
            ->get();
        $modalite = Modalite::with('type')
            ->where('code_promotion', $promotionId)
            ->where('code_type', $typeId)
            ->first();
        $montantAp = $modalite->montant;

        $montant   = $modalite?->montant ?? 0;
        $typeFrais = $modalite?->typeFrais->designation ?? 'Inconnu';


        // ✅ Étudiants qui ont payé
        $etudiantsPayes = Payement::where('code_type', $typeId)
            ->pluck('code_inscription')
            ->unique();

        // ✅ Étudiants qui n’ont pas payé
        $nonPayes = Inscription::with(['etudiant', 'promotion.option'])
            ->where('code_promotion', $promotionId)
            ->whereNotIn('id', $etudiantsPayes)
            ->get();

        // ✅ Générer PDF
        $pdf = Pdf::loadView('rapports.resultat', compact('payes', 'nonPayes', 'modalites','montantAp'));

        return $pdf->download('rapport_irregularites.pdf');
    }
}
