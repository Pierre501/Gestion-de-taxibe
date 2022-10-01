<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'versements_id', 'matricule', 'marque', 'model', 'etat', 'nombre_de_place'];

    public function setIdVehicule($id)
    {
        $this->id = $id;
    }

    public function getIdVehicule()
    {
        return $this->id;
    }

    public function setIdVersement($id)
    {
        $this->versements_id = $id;
    }

    public function getIdVersement()
    {
        return $this->versements_id;
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

    public function setNombreDePlace($nbrPlace)
    {
        $this->nombre_de_place = $nbrPlace;
    }

    public function getNombreDePlace()
    {
        return $this->nombre_de_place;
    }

    public function setEtatString($etat)
    {
        $retour = "En panne";
        if($etat == 0)
        {
            $retour = "En bonne etat";
        }
        return $retour;
    }

    public function getDataSimpleVehicule()
    {
        $data['id'] = $this->getIdVehicule();
        $data['versements_id'] = $this->getIdVersement();
        $data['matricule'] = $this->getMatricule();
        $data['marque'] = $this->getMarque();
        $data['model'] = $this->getModel();
        $data['etat'] = $this->getEtat();
        $data['nombre_de_place'] = $this->getNombreDePlace();
        return $data;
    }

    public function findVehiculeById()
    {
        $data = Vehicule::find($this->getIdVehicule());
        $vehicule = new Vehicule();
        $vehicule->setIdVehicule($data->id);
        $vehicule->setMatricule($data->matricule);
        $vehicule->setMarque($data->marque);
        $vehicule->setModel($data->model);
        $vehicule->setEtat($data->etat);
        return $vehicule;
    }

    public function getLastVehicule()
    {
        $query = DB::table('vehicules')->latest()->get();
        $vehicule = new Vehicule();
        foreach($query as $rows)
        {
            $vehicule->setIdVehicule($rows->id);
            $vehicule->setIdVersement($rows->versements_id);
            $vehicule->setMatricule($rows->matricule);
            $vehicule->setMarque($rows->marque);
            $vehicule->setModel($rows->model);
            $vehicule->setEtat($rows->etat);
        }
        return $vehicule;
    }

    public function getAllVehicule()
    {
        $data = array();
        $query = DB::table('vehicules')->get();
        foreach($query as $rows)
        {
            $vehicule = new Vehicule();
            $vehicule->setIdVehicule($rows->id);
            $vehicule->setIdVersement($rows->versements_id);
            $vehicule->setMatricule($rows->matricule);
            $vehicule->setMarque($rows->marque);
            $vehicule->setModel($rows->model);
            $vehicule->setEtat($rows->etat);
            $data[] = $vehicule;
        }
        return $data;
    }

    public function getVehiculeDisponible($etat, $pointage)
    {
        $tabVehicule = array();
        $tabData = DB::table('vehicules')
                ->join('garages', 'vehicules.id', '=', 'garages.vehicules_id')
                ->where('vehicules.etat', '=', $etat)
                ->where('garages.pointage', '=', $pointage)
                ->get();
        foreach($tabData as $data)
        {
            $vehicule = new Vehicule();
            $vehicule->setIdVehicule($data->vehicules_id);
            $vehicule->setMatricule($data->matricule);
            $vehicule->setMarque($data->marque);
            $vehicule->setModel($data->model);
            $vehicule->setEtat($data->etat);
            $tabVehicule[] = $vehicule;
        }
        return $tabVehicule;
    }

    public function updateEtatVehicule($etat)
    {
        DB::table('vehicules')->where('matricule', '=', $this->getMatricule())->update(["etat" => $etat]);
    }
}
