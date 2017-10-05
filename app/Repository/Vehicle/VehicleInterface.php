<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Repository\Vehicle;

use App\Repository\BasicInterface;

interface VehicleInterface extends BasicInterface
{

    /**
     *
     * @param string $ownerName
     * @return array
     */
    public function getAllByOwnerName(string $ownerName) : array ;


}