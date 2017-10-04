<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Repository\Vehicle;

use App\Model\Vehicle\Vehicle;

interface VehicleInterface
{

    /**
     * Insert single record into data storage
     * @param array $vehicleData
     * @return false|Vehicle
     */
    public function insert(array $vehicleData) ;

    /**
     *
     * @param int $vehicleId
     * @return null|object
     */
    public function getById(int $vehicleId);

    /**
     *
     * @param string $ownerName
     * @return array
     */
    public function getAllByOwnerName(string $ownerName) : array ;

    /**
     * @return array
     */
    public function getAll() : array ;

}