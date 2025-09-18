<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Etudiant;
use App\Models\Inscription;
use App\Models\OMP;
use App\Models\Option;
use App\Models\Payement;
use App\Models\Prevenu;
use App\Models\RE;
use Attribute;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index(){
        $officiers = Etudiant::count();
        $prevenus = Inscription::count();
        $atrib = Payement::count();
        $dossiers = Option::count();
        return view('dashBoard.index.index', compact('officiers','prevenus','atrib','dossiers'));
    }

    public function getRapport(){
        return view('rapports.index');
    }
}
