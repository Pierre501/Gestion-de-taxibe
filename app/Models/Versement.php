<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Versement extends Vehicule
{

    protected $fillable = ['id','versement', 'montant_versement'];

    public function setIdVersement($id)
    {
        $this->id = $id;
    }

    public function getIdVersement()
    {
        return $this->id;
    }

    public function setVersement($versement)
    {
        $this->versement = $versement;
    }

    public function getVersement()
    {
        return $this->versement;
    }

    public function setMontantVersement($montant)
    {
        $this->montant_versement = $montant;
    }

    public function getMontantVersement()
    {
        return $this->montant_versement;
    }

    public function formatMillier($chiffre)
    {
        $valeur = number_format($chiffre, 0, '.', ' ');
        return $valeur;
    }

    public function getAllVersement()
    {
        $data = array();
        $query = DB::table('versements')->get();
        foreach($query as $rows)
        {
            $versement = new Versement();
            $versement->setIdVersement($rows->id);
            $versement->setVersement($rows->versement);
            $versement->setMontantVersement($rows->montant_versement);
            $data[] = $versement;
        }
        return $data;
    }

    public function getSimpleVersementAvecVehicule()
    {
        $versement = new Versement();
        $query = DB::table('versements')
                ->join('vehicules', 'versements.id', '=', 'vehicules.versements_id')
                ->where('vehicules.matricule', '=', $this->getMatricule())
                ->get();
        foreach($query as $rows)
        {
            $versement->setIdVehicule($rows->id);
            $versement->setIdVersement($rows->versements_id);
            $versement->setMatricule($rows->matricule);
            $versement->setMarque($rows->marque);
            $versement->setModel($rows->model);
            $versement->setEtat($rows->etat);
            $versement->setNombreDePlace($rows->nombre_de_place);
            $versement->setVersement($rows->versement);
            $versement->setMontantVersement($rows->montant_versement);
        }
        return $versement;
    }

    public function getAllVersementAvecVehicule()
    {
        $data = array();
        $query = DB::table('versements')
                ->join('vehicules', 'versements.id', '=', 'vehicules.versements_id')
                ->get();
        foreach($query as $rows)
        {
            $versement = new Versement();
            $versement->setIdVehicule($rows->id);
            $versement->setIdVersement($rows->versements_id);
            $versement->setMatricule($rows->matricule);
            $versement->setMarque($rows->marque);
            $versement->setModel($rows->model);
            $versement->setEtat($rows->etat);
            $versement->setNombreDePlace($rows->nombre_de_place);
            $versement->setVersement($rows->versement);
            $versement->setMontantVersement($rows->montant_versement);
            $data[] = $versement;
        }
        return $data;
    }
}
