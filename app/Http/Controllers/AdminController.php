<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\Parametre;
use App\Models\Vehicule;
use App\Models\Versement;
use Illuminate\Http\Request;
use App\Models\VehiculeEnTrajet;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function create()
    {
        return view('admin.login');
    }

    public function home()
    {
        $vehicule = new VehiculeEnTrajet();
        $data['tabVehicule'] = $vehicule->getListeChauffeurCorrespondant();
        return view('admin.accueil', $data);
    }

    public function showPageAjoutVehicule()
    {
        $versement = new Versement();
        $data['listeVersement'] = $versement->getAllVersement();
        return view('admin.ajoutVehicule', $data);
    }

    public function showPageParametre()
    {
        $parametre = new Parametre();
        $data['listeParametre'] = $parametre->getAllParametre();
        return view('admin.parametre', $data);
    }

    public function showPageVehicule()
    {
        $data = array();
        $versement = new Versement();
        $data['listeVehicule'] = $versement->getAllVersementAvecVehicule();
        return view('admin.vehicule', $data);
    }

    public function showPageStatistique()
    {
        return view('admin.statistique');
    }

    public function showPageVersement()
    {
        return view('admin.versement');
    }

    public function showPageModifParametre($id)
    {
        $parametre = new Parametre();
        $parametre->setIdParametre($id);
        $data['parametre'] = $parametre->getSimpleParametre();
        return view('admin.modifParametre', $data);
    }

    public function ajoutVehicule(Request $request)
    {
        $data = $request->all();
        $vehicule = new Vehicule();
        $vehicule->setIdVersement($data['versement']);
        $vehicule->setMatricule($data['matricule']);
        $vehicule->setMarque($data['marque']);
        $vehicule->setModel($data['modele']);
        $vehicule->setNombreDePlace($data['nbrPlace']);
        $vehicule->setEtat(0);
        $dataVehicule = $vehicule->getDataSimpleVehicule();
        Vehicule::create($dataVehicule);
        $nouveauVehicule = $vehicule->getAllVehicule();
        $garage = new Garage();
        $garage->setIdVehicule(end($nouveauVehicule)->getIdVehicule());
        $garage->setPointage(0);
        $dataGarage = $garage->getDataGarage();
        Garage::create($dataGarage);
        $tab = array();
        $versement = new Versement();
        $tab['listeVehicule'] = $versement->getAllVersementAvecVehicule();
        return view('admin.vehicule', $tab);
    }

    public function modifierParametre(Request $request)
    {
        $parametre = Parametre::find($request->id);
        $parametre->pourcentage = $request->pourcentage;
        $parametre->update();
        $data['listeParametre'] = $parametre->getAllParametre();
        return view('admin.parametre', $data);
    }

    public function store(Request $request)
    {
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'] , 'password' => $check['password']]))
        {
            return redirect()->route('admin.accueil');
        }
        else
        {
            return back()->with('error', 'Acces refuse');
        }
    }

    public function destroy()
    {
        Auth::guard('admin')->logout();
        return redirect('/login-admin');
    }
}
