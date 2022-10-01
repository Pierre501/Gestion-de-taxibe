<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateEncours extends Model
{
    use HasFactory;

    protected $annee;
    protected $mois;
    protected $jour;

    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setMois($mois)
    {
        $this->mois = $mois;
    }

    public function getMois()
    {
        return $this->mois;
    }

    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    public function getJour()
    {
        return $this->jour;
    }

    public function formatDateEncours()
    {
        $formatDateEncours = $this->getAnnee().'-'.$this->getMois().'-'.$this->getJour();
        return $formatDateEncours;
    }

    public function getDateEncours()
    {
        date_default_timezone_set('Indian/Antananarivo');
        $dateEncours = new DateEncours();
        $dateEncours->setAnnee(date('Y'));
        $dateEncours->setMois(date('m'));
        $dateEncours->setJour(date('d'));
        return $dateEncours->formatDateEncours();
    }
}
