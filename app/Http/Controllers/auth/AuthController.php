<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('dashBoard.autentification.login');
    }

    public function login1()
    {
        return redirect()->route('dashBoard.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashBoard.index')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'username' => 'Les informations de connexion sont incorrectes.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    public function getUsers()
    {
        $users = User::all();
        return view('dashBoard.autentification.user', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::create($validated);
        return redirect()->route('user.index')->with('success', 'Utilisateur enregistré avec succès !');
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $user->update($validated);
        return redirect()->route('user.index')->with('success', 'Utilisateur modifié avec succès !');
    }
    public function destroy(User $id)
    {
        $id->delete();

        return redirect()->route('user.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
