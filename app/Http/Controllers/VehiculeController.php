<?php

namespace App\Http\Controllers;

use App\Models\DateEncours;
use App\Models\DetailsTrajet;
use App\Models\Garage;
use App\Models\HeureEncours;
use App\Models\ListeSalaire;
use App\Models\Panne;
use App\Models\Salaire;
use App\Models\Trajet;
use App\Models\User;
use App\Models\Vehicule;
use App\Models\VehiculeEnTrajet;
use App\Models\Versement;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    
    public function showPageTrajet()
    {
        return view('chauffeur.trajets');
    }

    public function showPageSalaire()
    {
        $user = new User();
        $listeSalaire = new ListeSalaire();
        $data['listeSalaire'] = $listeSalaire->getAllSalaireJournalie($user->getUserAuthentifie()->getIdUser());
        return view('chauffeur.salaire', $data);
    }

    public function showPageMaintenance()
    {
        $user = new User();
        $trajets = new Trajet();
        $data = array();
        $condition = $trajets->verifierChauffeurEnTrajet($user->getUserAuthentifie());
        $dateEncours = new DateEncours();
        $heureEncours = new HeureEncours();
        $vehiculeEnTrajets = new VehiculeEnTrajet();
        if($condition == true)
        {
            $data['vehicule'] = $vehiculeEnTrajets->getSimpleVehiculeEnTrajets($user->getUserAuthentifie());
            $data['heureEncours'] = $heureEncours->getHeureEncours();
            $data['dateEncours'] = $dateEncours->getDateEncours();
        }
        else
        {
            $data['vehicule'] = $vehiculeEnTrajets;
            $data['heureEncours'] = "";
            $data['dateEncours'] = "";
        }
        return view('chauffeur.maintenance', $data);
    }

    public function ajouter(Request $request)
    {
        $data = array();
        $user = new User();
        $trajets = new Trajet();
        $condition = $trajets->verifierChauffeurEnTrajet($user->getUserAuthentifie());
        if($condition == true)
        {
            $data['erreur'] = "Ajout véhicule invalide";
        }
        else
        {
            $garage = new Garage();
            $garage->setIdVehicule($request->vehicules_id);
            $garage->updateGarage(1);
            $trajets->setIdChauffeur($user->getUserAuthentifie()->getIdUser());
            $trajets->setIdVehicule($request->vehicules_id);
            $dataTrajet = $trajets->getDataTrajet();
            Trajet::create($dataTrajet);
        }
        $vehicule = new Vehicule();
        $data['tabVehicule'] = $vehicule->getVehiculeDisponible(0,0);
        return view('chauffeur.accueil', $data);
    }

    public function detailsTrajet(Request $request)
    {
        $data = array();
        $heureEncours = new HeureEncours();
        $verification = $heureEncours->verificationHeureEncours();
        if($verification == true)
        {
            $user = new User();
            $trajets = new Trajet();
            $detailsTrajets = new DetailsTrajet();
            $condition = $detailsTrajets->verificationDetailsTrajet($user->getUserAuthentifie());
            if($condition == true)
            {
                $data['erreur'] = "Vous avez déja inserer votre trajets";
            }
            else
            {
                $simpleTrajets = $trajets->getSimpleTrajets($user->getUserAuthentifie());
                if(!empty($simpleTrajets))
                {
                    $detailsTrajets->setIdTrajet($simpleTrajets->getIdTrajet());
                    $detailsTrajets->setKilometreEffectue($request->kilometre_effectue);
                    $detailsTrajets->setMontantRecette($request->recette);
                    $detailsTrajets->setMontantCarburant($request->carburant);
                    $dataDetailsTrajets = $detailsTrajets->getDataDetailsTrajet();
                    DetailsTrajet::create($dataDetailsTrajets);
                    $garage = new Garage();
                    $garage->setIdVehicule($simpleTrajets->getIdVehicule());
                    $garage->updateGarage(0);
                    $vehiculeEnTrajets = new VehiculeEnTrajet();
                    $matricule = $vehiculeEnTrajets->getSimpleVehiculeEnTrajets($user->getUserAuthentifie())->getMatricule();
                    $salaire = new Salaire();
                    $salaire->setIdTrajet($simpleTrajets->getIdTrajet());
                    $salaire->setMontantSalaire($salaire->calculSalaire($request->recette, $matricule));
                    $salaire->setCouleur($request->recette);
                    $dataSalaire = $salaire->getDataSalaire();
                    Salaire::create($dataSalaire);
                }
            }
        }
        else
        {
            $data['erreur'] = "Vous ne pouvez pas entre votre trajet avant 18h00";
        }
        return view('chauffeur.trajets', $data);
    }

    public function panne()
    {
        $user = new User();
        $trajets = new Trajet();
        $simpleTrajets = $trajets->getSimpleTrajets($user->getUserAuthentifie());
        $panne = new Panne();
        $panne->setIdVehicule($simpleTrajets->getIdVehicule());
        $dataPanne = $panne->getDataPanne();
        Panne::create($dataPanne);
        $vehiculeEnTrajets = new VehiculeEnTrajet();
        $simpleVehicule = $vehiculeEnTrajets->getSimpleVehiculeEnTrajets($user->getUserAuthentifie());
        $vehicule = new Vehicule();
        $vehicule->setMatricule($simpleVehicule->getMatricule());
        $vehicule->updateEtatVehicule(1);
        $trajet = Trajet::find($simpleTrajets->getIdTrajet());
        $trajet->delete();
        $data['vehicule'] = $vehiculeEnTrajets;
        $data['heureEncours'] = "";
        $data['dateEncours'] = "";
        return view('chauffeur.maintenance', $data);
    }

}
