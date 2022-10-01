<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'vehicules_id', 'pointage'];

    public function setIdGarage($id)
    {
        $this->id = $id;
    }

    public function getIdGarage()
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

    public function setPointage($pointage)
    {
        $this->pointage = $pointage;
    }

    public function getPointage()
    {
        return $this->pointage;
    }

    public function getDataGarage()
    {
        $data['vehicules_id'] = $this->getIdVehicule();
        $data['pointage'] = $this->getPointage();
        return $data;
    }

    public function updateGarage($pointage)
    {
        DB::table('garages')->where('vehicules_id', '=', $this->getIdVehicule())->update(["pointage" => $pointage]);
    }

    public function findByIdVehicule()
    {
        $tabData = DB::table('garages')
                ->where('vehicules_id', '=', $this->getIdVehicule())
                ->get();
        $garage = new Garage();
        foreach($tabData as $data)
        {
            $garage->setIdGarage($data->id);
            $garage->setIdVehicule($data->vehicules_id);
            $garage->setPointage($data->pointage);
        }
        return $garage;
    }
}
