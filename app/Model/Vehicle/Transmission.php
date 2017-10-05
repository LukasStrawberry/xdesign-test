<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{

    const TABLE_NAME = 'vehicle_transmission';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

}
