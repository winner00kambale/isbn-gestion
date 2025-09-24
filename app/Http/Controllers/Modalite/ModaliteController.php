<?php

namespace App\Http\Controllers\Modalite;

use App\Http\Controllers\Controller;
use App\Models\Modalite;
use App\Models\Promotion;
use App\Models\Type_frais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModaliteController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');

        $modalites = Modalite::join('promotions', 'modalites.code_promotion', '=', 'promotions.id')
            ->join('options', 'promotions.code_option', '=', 'options.id')
            ->join('type_frais', 'modalites.code_type', '=', 'type_frais.id')
            ->select('modalites.*', 'promotions.designation as promotion', 'options.designation as option', 'type_frais.designation as type')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('modalites.montant', 'like', "%$search%")
                        ->orWhere('promotions.designation', 'like', "%$search%")
                        ->orWhere('options.designation', 'like', "%$search%")
                        ->orWhere('type_frais.designation', 'like', "%$search%");
                });
            })
            ->orderByDesc('modalites.id')
            ->paginate(10);
        return view('pages.modalite.index', compact('modalites'));
    }

    public function create()
    {
        $promotions = DB::table('promotions')
            ->join('options', 'promotions.code_option', '=', 'options.id')
            ->select('promotions.id', 'promotions.designation as promotion', 'options.designation as option')
            ->get();

        $type = Type_frais::all();

        return view('pages.modalite.create', compact('promotions', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_promotion' => 'required|exists:promotions,id',
            'code_type' => 'required|exists:type_frais,id',
            'montant' => 'required'
        ]);

        Modalite::create([
            'montant' => $request->montant,
            'code_promotion' => $request->code_promotion,
            'code_type' => $request->code_type,
        ]);

        return redirect()->route('modalite.index')->with('success', 'Enregistrée avec succès !');
    }

    public function edit($id)
    {
        $modalites = Modalite::with(['type', 'promotion.option'])->findOrFail($id);
        $type = Type_frais::orderByDesc('id')->get();
        $promotions = Promotion::with('option')->orderBy('designation')->get(); 
        return view('pages.modalite.edit', compact('modalites', 'promotions','type'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Validation
        $request->validate([
            'code_promotion' => 'required|exists:promotions,id',
            'code_type' => 'required|exists:type_frais,id',
            'montant' => 'required'
        ]);

        // ✅ Retrouver la modalité
        $modalite = Modalite::findOrFail($id);

        // ✅ Mise à jour
        $modalite->update([
            'montant' => $request->montant,
            'code_promotion' => $request->code_promotion,
            'code_type' => $request->code_type,
        ]);

        // ✅ Redirection
        return redirect()->route('modalite.index')->with('success', 'Mise à jour effectuée avec succès !');
    }
}
