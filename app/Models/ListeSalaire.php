<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ListeSalaire extends Model
{

    protected $matricule;
    protected $kilometre;
    protected $recette;
    protected $carburant;
    protected $salaire;
    protected $date;

    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    public function getMatricule()
    {
        return $this->matricule;
    }

    public function setKilometreEffectue($kilometre)
    {
        $this->kilometre = $kilometre;
    }

    public function getKilometreEffectue()
    {
        return $this->kilometre;
    }

    public function setMontantRecette($recette)
    {
        $this->recette = $recette;
    }

    public function getMontantRecette()
    {
        return $this->recette;
    }

    public function setMontantCarburant($carburant)
    {
        $this->carburant = $carburant;
    }

    public function getMontantCarburant()
    {
        return $this->carburant;
    }

    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;
    }

    public function getSalaire()
    {
        return $this->salaire;
    }

    public function setDateSalaire($date)
    {
        $this->dateSalaire = $date;
    }

    public function getDateSalaire()
    {
        return $this->dateSalaire;
    }

    public function formatMillier($chiffre)
    {
        $valeur = number_format($chiffre, 0, '.', ' ');
        return $valeur;
    }

    public function getAllSalaireJournalie($user_id)
    {
        $data = array();
        $query = DB::table('listeSalaire')
                ->where('users_id', $user_id)
                ->orderBy('dateSalaire', 'desc')
                ->get();
        foreach($query as $rows)
        {
            $listeSalaire = new ListeSalaire();
            $listeSalaire->setMatricule($rows->matricule);
            $listeSalaire->setKilometreEffectue($rows->kilometre_effectue);
            $listeSalaire->setMontantRecette($rows->montant_recette);
            $listeSalaire->setMontantCarburant($rows->montant_carburant);
            $listeSalaire->setSalaire($rows->montant_salaire);
            $listeSalaire->setDateSalaire($rows->dateSalaire);
            $data[] = $listeSalaire;
        }
        return $data;
    }
}
