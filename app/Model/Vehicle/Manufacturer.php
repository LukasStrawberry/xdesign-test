<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Manufacturer extends EloquentModel
{

    const TABLE_NAME = 'vehicle_manufacturer';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name'
    ];

    public function models(){
        return $this->hasMany(Model::class);
    }

}
