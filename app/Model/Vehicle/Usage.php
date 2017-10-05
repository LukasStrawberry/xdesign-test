<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{

    const TABLE_NAME = 'vehicle_usage';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

}
