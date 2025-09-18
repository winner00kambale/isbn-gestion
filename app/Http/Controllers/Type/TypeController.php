<?php

namespace App\Http\Controllers\Type;

use App\Http\Controllers\Controller;
use App\Models\Type_frais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function IndexType(Request $request)
    {
        $query = Type_frais::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('designation', 'LIKE', "%{$search}%");
        }

        $query->orderByDesc('id');

        $type = $query->paginate(10);

        return view('pages.type_frais.type', [
            'types' => $type,
            'search' => $request->input('search')
        ]);
    }
    public function FormType()
    {
        return view('pages.type_frais.type-store');
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

        Type_frais::create($data);
        return redirect()->route('type.index')->with('success', 'Type enregistré avec succès !');
    }
    public function edit(Type_frais $type)
    {
        return view('pages.type_frais.type-update', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $type = Type_frais::find($id);
        if (!$type) {
            return redirect()->route('type.index')->with('error', 'type non trouvé!');
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

        $type->update($data);

        return redirect()->route('type.index')->with('success', 'Mis à jour réussie !');
    }
}
