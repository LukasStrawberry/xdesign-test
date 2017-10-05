<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Vehicle extends EloquentModel
{

    const TABLE_NAME = 'vehicle';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'license_plate', 'seats_count', 'doors_count', 'wheels_count',
        'has_boot', 'has_trailer', 'has_sunroof', 'has_gps', 'colour',
        'engine_cc', 'fuel_type_id', 'model_id', 'owner_id', 'transmission_id',
        'usage_id', 'weight_category_id', 'type_id'
    ];

    protected $casts = [
        'has_gps' => 'boolean',
        'has_sunroof' => 'boolean',
        'has_trailer' => 'boolean',
        'has_boot' => 'boolean',
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function fuelType(){
        return $this->belongsTo(FuelType::class);
    }

    public function model(){
        return $this->belongsTo(Model::class);
    }

    public function owner(){
        return $this->belongsTo(Owner::class);
    }

    public function transmission(){
        return $this->belongsTo(Transmission::class);
    }

    public function weightCategory(){
        return $this->belongsTo(WeightCategory::class);
    }

    public function usage(){
        return $this->belongsTo(Usage::class);
    }

}
