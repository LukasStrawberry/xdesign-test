<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{

    public function vehicles(){
        return $this->hasMany('App\Model\Vehicle\Vehicle');
    }

}
