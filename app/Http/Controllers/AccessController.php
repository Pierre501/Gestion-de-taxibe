<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    
    public function showLoginForm()
    {
        return view('chauffeur.login');
    }

    public function home()
    {
        $data = array();
        $vehicule = new Vehicule();
        $data['tabVehicule'] = $vehicule->getVehiculeDisponible(0,0);
        return view('chauffeur.accueil', $data);
    }
}
