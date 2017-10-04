<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

    public function models(){
        return $this->hasMany('App\Model\Vehicle\Model');
    }

}
