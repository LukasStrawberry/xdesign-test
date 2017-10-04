<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{

    public function vehicles(){
        return $this->hasMany('App\Model\Vehicle\Vehicle');
    }

    public function company(){
        return $this->belongsTo('App\Model\Vehicle\OwnerCompany');
    }

}
