<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class OwnerCompany extends Model
{

    public function employees(){
        return $this->hasMany('App\Model\Vehicle\Owner');
    }

}
