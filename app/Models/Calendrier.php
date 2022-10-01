<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Calendrier extends Model
{
    use HasFactory;

    protected $fillable = ['mois', 'annee', 'debut_du_mois', 'fin_du_mois'];

    public function setMois($mois)
    {
        $this->mois = $mois;
    }

    public function getMois()
    {
        return $this->mois;
    }

    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setDebutDuMois($debut)
    {
        $this->debut_du_mois = $debut;
    }

    public function getDebutDuMois()
    {
        return $this->debut_du_mois;
    }

    public function setFinDuMois($fin)
    {
        $this->fin_du_mois = $fin;
    }

    public function getFinDuMois()
    {
        return $this->fin_du_mois;
    }

    public function getSimpleCalendrier()
    {
        $sql = DB::table('calendriers')
                        ->where('mois', '=', $this->getMois())
                        ->where('annee', '=', $this->getAnnee())
                        ->get();
        $calendrier = new Calendrier();
        foreach($sql as $query)
        {
            $calendrier->setMois($query->mois);
            $calendrier->setAnnee($query->annee);
            $calendrier->setDebutDuMois($query->debut_du_mois);
            $calendrier->setFinDuMois($query->fin_du_mois);
        }
        return $calendrier;
    }
}
