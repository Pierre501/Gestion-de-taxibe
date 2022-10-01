<?php

namespace App\Models;

use App\Models\VehiculeEnTrajet;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailsTrajet extends Model
{
    use HasFactory;

    protected $fillable = ['trajets_id', 'kilometre_effectue', 'montant_recette', 'montant_carburant'];

    public function setIdTrajet($idTrajet)
    {
        $this->trajets_id = $idTrajet;
    }

    public function getIdTrajet()
    {
        return $this->trajets_id;
    }

    public function setKilometreEffectue($kilometre)
    {
        $this->kilometre_effectue = $kilometre;
    }

    public function getKilometreEffectue()
    {
        return $this->kilometre_effectue;
    }

    public function setMontantRecette($recette)
    {
        $this->montant_recette = $recette;
    }

    public function getMontantRecette()
    {
        return $this->montant_recette;
    }

    public function setMontantCarburant($carburant)
    {
        $this->montant_carburant = $carburant;
    }

    public function getMontantCarburant()
    {
        return $this->montant_carburant;
    }

    public function getDataDetailsTrajet()
    {
        $data['trajets_id'] = $this->getIdTrajet();
        $data['kilometre_effectue'] = $this->getKilometreEffectue();
        $data['montant_recette'] = $this->getMontantRecette();
        $data['montant_carburant'] = $this->getMontantCarburant();
        return $data;
    }

    public function verificationDetailsTrajet($user)
    {
        $verification = false;
        $dateEncours = new DateEncours();
        $rows = DB::table('verificationDetailsTrajets')
                ->where('users_id', $user->getIdUser())
                ->where('dateCreation', $dateEncours->getDateEncours())
                ->count('id');
        if($rows == 1)
        {
            $verification = true;
        }
        return $verification;
    }
}
