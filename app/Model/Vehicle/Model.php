<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{

    public function vehicles(){
        return $this->hasMany('App\Model\Vehicle\Vehicle');
    }

    public function manufacturer(){
        return $this->belongsTo('App\Model\Vehicle\Manufacturer');
    }

}
