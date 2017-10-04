<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Repository\Vehicle;


use App\Model\Vehicle\Vehicle;

class VehicleRepository implements VehicleInterface
{

    /**
     * @var Vehicle
     */
    private $vehicleModel;

    /**
     * VehicleRepository constructor.
     * @param Vehicle $vehicleModel
     */
    public function __construct(Vehicle $vehicleModel)
    {
        $this->vehicleModel = $vehicleModel;
    }

    public function insert(array $data)
    {
        if(!$data){
            throw new \LogicException(sprintf(
                'Vehicle data can not be empty'
            ));
        }

        return $this->vehicleModel->create($data) ?: false;
    }

    public function getById(int $vehicleId)
    {
        // TODO: Implement getById() method.
    }

    public function getAllByOwnerName(string $ownerName): array
    {
        // TODO: Implement getAllByOwnerName() method.
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

}