<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{

    const TABLE_NAME = 'vehicle_model';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name', 'is_hgv'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }

}
