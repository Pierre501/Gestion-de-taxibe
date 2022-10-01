<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = ['id' ,'users_id', 'vehicules_id'];

    public function setIdTrajet($idTrajet)
    {
        $this->id = $idTrajet;
    }

    public function getIdTrajet()
    {
        return $this->id;
    }

    public function setIdChauffeur($idChauffeur)
    {
        $this->users_id = $idChauffeur;
    }

    public function getIdChauffeur()
    {
        return $this->users_id;
    }

    public function setIdVehicule($idVehicule)
    {
        $this->vehicules_id = $idVehicule;
    }

    public function getIdVehicule()
    {
        return $this->vehicules_id;
    }

    public function getDataTrajet()
    {
        $data['users_id'] = $this->getIdChauffeur();
        $data['vehicules_id'] = $this->getIdVehicule();
        return $data;
    }

    public function verifierChauffeurEnTrajet($user)
    {
        $verification = false;
        $dateEncours = new DateEncours();
        $rows = DB::table('verificationChauffeurEnTrajet')
                ->where('users_id', $user->getIdUser())
                ->where('date_creation', $dateEncours->getDateEncours())
                ->count('id');
        if($rows == 1)
        {
            $verification = true;
        }
        return $verification;
    }

    public function getNbrJourParVehicule($calendriers,$vehicule)
    {
        $nbrJour = 0;
        $query = DB::table('trajets')
                    ->select('count(vehicules_id) as compteur')
                    ->where('vehicules_id', $vehicule->getIdVehicule())
                    ->whereBetween('created_at', [$calendriers->getDebutDuMois(), $calendriers->getFinDuMois()])
                    ->get();
        foreach($query as $rows)
        {
            $nbrJour = $rows->compteur;
        }
        return $nbrJour;
    }

    public function getSimpleTrajets($user)
    {
        $dateEncours = new DateEncours();
        $query = DB::table('verificationChauffeurEnTrajet')
                ->where('users_id', $user->getIdUser())
                ->where('date_creation', $dateEncours->getDateEncours())
                ->get();
        $trajets = new Trajet();
        foreach($query as $rows)
        {
            $trajets->setIdTrajet($rows->id);
            $trajets->setIdChauffeur($rows->users_id);
            $trajets->setIdVehicule($rows->vehicules_id);
        }
        return $trajets;
    }
}
