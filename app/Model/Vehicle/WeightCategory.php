<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class WeightCategory extends Model
{

    const TABLE_NAME = 'vehicle_weight_category';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'id', 'name'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

}
