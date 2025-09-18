<?php

namespace App\Http\Controllers\Option;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    public function IndexOption(Request $request)
    {

        $query = Option::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('designation', 'LIKE', "%{$search}%");
        }

        $query->orderByDesc('id');

        $option = $query->paginate(10);

        return view('pages.option.option', [
            'options' => $option,
            'search' => $request->input('search')
        ]);
    }
    public function FormOption()
    {
        return view('pages.option.store-option');
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

        Option::create($data);
        return redirect()->route('option.index')->with('success', 'Option enregistrée avec succès !');
    }
    public function edit(Option $option)
    {
        return view('pages.option.update-option', compact('option'));
    }

    public function update(Request $request, $id)
    {
        $option = Option::find($id);
        if (!$option) {
            return redirect()->route('option.index')->with('error', 'Option non trouvée!');
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

        $option->update($data);

        return redirect()->route('option.index')->with('success', 'Mis à jour réussie !');
    }
}
