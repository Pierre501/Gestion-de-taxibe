<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panne extends Model
{
    use HasFactory;

    protected $fillable = ['vehicules_id'];

    public function setIdPanne($idPanne)
    {
        $this->id = $idPanne;
    }

    public function getIdPanne()
    {
        return $this->id;
    }

    public function setIdVehicule($idVehicule)
    {
        $this->vehicules_id = $idVehicule;
    }

    public function getIdVehicule()
    {
        return $this->vehicules_id;
    }

    public function getDataPanne()
    {
        $data['vehicules_id'] = $this->getIdVehicule();
        return $data;
    }
}
