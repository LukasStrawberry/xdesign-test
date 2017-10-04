<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class WeightCategory extends Model
{

    public function vehicles(){
        return $this->hasMany('App\Model\Vehicle\Vehicle');
    }

}
