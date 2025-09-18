<?php

namespace App\Http\Controllers\Rapport;

use App\Http\Controllers\Controller;
use App\Models\Payement;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function recu(){
        return view('rapports.recu');
    }

    public function getRapport(){
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
}
