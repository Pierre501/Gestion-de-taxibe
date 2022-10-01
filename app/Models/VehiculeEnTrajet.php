<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VehiculeEnTrajet extends Model
{
    
    protected $nom;
    protected $tel;
    protected $matricule;
    protected $marque;
    protected $model;
    protected $etat;

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    public function getMatricule()
    {
        return $this->matricule;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function getListeChauffeurCorrespondant()
    {
        $data = array();
        $dateEncours = new DateEncours();
        $query = DB::table('vehiculeEnTrajet')
                ->where('created_at', '=', $dateEncours->getDateEncours())
                ->get();
        foreach($query as $rows)
        {
            $vehiculeEnTrajet = new VehiculeEnTrajet();
            $vehiculeEnTrajet->setNom($rows->name);
            $vehiculeEnTrajet->setTel($rows->tel);
            $vehiculeEnTrajet->setMatricule($rows->matricule);
            $vehiculeEnTrajet->setMarque($rows->marque);
            $vehiculeEnTrajet->setModel($rows->model);
            $vehiculeEnTrajet->setEtat($rows->etat);
            $data[] = $vehiculeEnTrajet;
        }
        return $data;
    }

    public function getSimpleVehiculeEnTrajets($user)
    {
        $vehiculeEnTrajet = new VehiculeEnTrajet();
        $query = DB::table('vehiculeEnTrajet')
                ->where('tel', $user->getTel())
                ->latest()
                ->get();
        foreach($query as $rows)
        {
            $vehiculeEnTrajet->setNom($rows->name);
            $vehiculeEnTrajet->setTel($rows->tel);
            $vehiculeEnTrajet->setMatricule($rows->matricule);
            $vehiculeEnTrajet->setMarque($rows->marque);
            $vehiculeEnTrajet->setModel($rows->model);
            $vehiculeEnTrajet->setEtat($rows->etat); 
        }
        return $vehiculeEnTrajet;
    }
}
