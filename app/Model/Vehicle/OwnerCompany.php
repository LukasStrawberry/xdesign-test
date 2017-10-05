<?php

namespace App\Model\Vehicle;

use Illuminate\Database\Eloquent\Model;

class OwnerCompany extends Model
{

    const TABLE_NAME = 'vehicle_owner_company';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function employees(){
        return $this->hasMany(Owner::class);
    }

}
