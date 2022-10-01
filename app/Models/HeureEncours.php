<?php

namespace App\Models;



class HeureEncours extends DateEncours
{

    protected $heure;
    protected $minute;
    protected $seconde;

    public function setHeure($heure)
    {
        $this->heure = $heure - 1;
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function setMinute($minute)
    {
        $this->minute = $minute;
    }

    public function getMinute()
    {
        return $this->minute;
    }

    public function setSeconde($seconde)
    {
        $this->seconde = $seconde;
    }

    public function getSeconde()
    {
        return $this->seconde;
    }

    public function formatHeureEncours()
    {
        $formatHeureEncours = $this->getHeure().':'.$this->getMinute().':'.$this->getSeconde();
        return $formatHeureEncours;
    }

    public function deFormatHeureEncours($heureEncours)
    {
        $tabSplitter = explode(':', $heureEncours);
        $heureActuel = new HeureEncours();
        $heureActuel->setHeure($tabSplitter[0]+1);
        $heureActuel->setMinute($tabSplitter[1]);
        $heureActuel->setSeconde($tabSplitter[2]);
        return $heureActuel;
    }

    public function getHeureEncours()
    {
        date_default_timezone_set('Indian/Antananarivo');
        $heureEncours = new HeureEncours();
        $heureEncours->setHeure(date('H'));
        $heureEncours->setMinute(date('i'));
        $heureEncours->setSeconde(date('s'));
        return $heureEncours->formatHeureEncours();
    }

    public function verificationHeureEncours()
    {
        $verification = false;
        $heureEncours = $this->deFormatHeureEncours($this->getHeureEncours());
        if(intval($heureEncours->getHeure()) >= 17 && intval($heureEncours->getHeure()) <= 23)
        {
            $verification = true;
        }
        return $verification;
    }
}
