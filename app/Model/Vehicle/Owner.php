<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{

    const TABLE_NAME = 'vehicle_owner';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name', 'profession'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    public function company(){
        return $this->belongsTo(OwnerCompany::class);
    }

}
