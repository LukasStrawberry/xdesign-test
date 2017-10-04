<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    public function fuelType(){
        return $this->belongsTo('App\Model\Vehicle\FuelType');
    }

    public function model(){
        return $this->belongsTo('App\Model\Vehicle\Model');
    }

    public function owner(){
        return $this->belongsTo('App\Model\Vehicle\Owner');
    }

    public function transmission(){
        return $this->belongsTo('App\Model\Vehicle\Transmission');
    }

    public function weightCategory(){
        return $this->belongsTo('App\Model\Vehicle\WeightCategory');
    }

    public function usage(){
        return $this->belongsTo('App\Model\Vehicle\Usage');
    }

}
