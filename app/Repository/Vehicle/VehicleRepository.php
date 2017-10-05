<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Repository\Vehicle;


use App\Model\Vehicle\Vehicle;
use App\Repository\BasicRepository;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository extends BasicRepository implements VehicleInterface
{

    /**
     * VehicleRepository constructor.
     * @param Vehicle $vehicleModel
     */
    public function __construct(Vehicle $vehicleModel)
    {
        parent::__construct($vehicleModel);
    }

    public function getAllByOwnerName(string $ownerName): Collection
    {
        // TODO: Implement getAllByOwnerName() method.
    }

}