<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'trajets_id', 'montant_salaire', 'couleur'];

    public function setIdSalaire($id)
    {
        $this->id = $id;
    }

    public function getIdSalaire()
    {
        return $this->id;
    }

    public function setIdTrajet($idTrajet)
    {
        $this->trajets_id = $idTrajet;
    }

    public function getIdTrajet()
    {
        return $this->trajets_id;
    }

    public function setMontantSalaire($montant)
    {
        $this->montant_salaire = $montant;
    }

    public function getMontantSalaire()
    {
        return $this->montant_salaire;
    }

    public function setCouleur($recette)
    {
        $this->couleur = $this->settersColor($recette);
    }

    public function getCouleur()
    {
        return $this->couleur;
    }

    public function getDataSalaire()
    {
        $data['trajets_id'] = $this->getIdTrajet();
        $data['montant_salaire'] = $this->getMontantSalaire();
        $data['couleur'] = $this->getCouleur();
        return $data;
    }

    public function settersColor($recette)
    {
        $color = "white";
        $versement = new Versement();
        $simpleVersement = $versement->getSimpleVersement();
        if($recette == $simpleVersement->getMontantVersement())
        {
            $color = "grey";
        }
        else if($recette < $simpleVersement->getMontantVersement())
        {
            $color = "yellow";
        }
        else
        {
            $color = "green";
        }
        return $color;
    }

    public function verifierVersement($recette, $matricule)
    {
        $verification = false;
        $versement = new Versement();
        $versement->setMatricule($matricule);
        $simpleVersement = $versement->getSimpleVersementAvecVehicule();
        if($recette < $simpleVersement->getMontantVersement())
        {
            $verification = true;
        }
        return $verification;
    }

    public function calculSalaire($recette, $matricule)
    {
        $salaire = 0;
        $condition = $this->verifierVersement($recette, $matricule);
        $parametre = new Parametre();
        if($condition == true)
        {
            $parametre->setIdParametre(1);
            $pourcentage = $parametre->getSimpleParametre()->getPourcentage();
            $salaire = $recette * $pourcentage / 100;
        }
        else
        {
            $parametre->setIdParametre(2);
            $pourcentage = $parametre->getSimpleParametre()->getPourcentage();
            $salaire = $recette * $pourcentage / 100;
        }
        return $salaire;
    }
}
