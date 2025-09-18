<?php

namespace App\Http\Controllers\Promotion;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function promotionIndex()
    {
        $promotions = Promotion::join('options', 'promotions.code_option', '=', 'options.id')
            ->select('promotions.*', 'options.designation as option')
            ->orderByDesc('promotions.id')
            ->paginate(10);

        return view('pages.promotion.promotion', [
            'promotions' => $promotions
        ]);
    }

    public function promotionForm()
    {
        $options = Option::latest()->get();
        return view('pages.promotion.promotion-store', compact('options'));
    }

    public function storeOption(Request $request)
    {
        $validated = $request->validate([
            'designation' => 'nullable',
        ]);

        Option::create($validated);
        return redirect()->back()->with('success', 'Option enregistrée avec succès !');
    }

    public function storePromotion(Request $request)
    {
        Promotion::create($request->all());
        return redirect()->route('promotion.index')->with('success', 'promotion enregistrée avec succès !');
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        $options = Option::all();

        return view('pages.promotion.edit', compact('promotion', 'options'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'designation' => 'required',
            'code_option' => 'required|exists:options,id',
        ]);

        $promotion = Promotion::findOrFail($id);
        $promotion->designation = $request->designation;
        $promotion->code_option = $request->code_option;
        $promotion->save();

        return redirect()->route('promotion.index')->with('success', 'Promotion mise à jour avec succès !');
    }
}
