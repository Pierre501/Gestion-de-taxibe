<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'parametre', 'pourcentage'];

    public function setIdParametre($id)
    {
        $this->id = $id;
    }

    public function getIdParametre()
    {
        return $this->id;
    }

    public function setParametre($parametre)
    {
        $this->parametre = $parametre;
    }

    public function getParametre()
    {
        return $this->parametre;
    }

    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
    }

    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    public function getSimpleParametre()
    {
        $rows = Parametre::find($this->getIdParametre());
        $parametre = new Parametre();
        $parametre->setIdParametre($rows->id);
        $parametre->setParametre($rows->parametre);
        $parametre->setPourcentage($rows->pourcentage);
        return $parametre;
    }

    public function getAllParametre()
    {
        $data = array();
        $query = Parametre::all();
        foreach($query as $rows)
        {
            $parametre = new Parametre();
            $parametre->setIdParametre($rows->id);
            $parametre->setParametre($rows->parametre);
            $parametre->setPourcentage($rows->pourcentage);
            $data[] = $parametre;
        }
        return $data;
    }
}
