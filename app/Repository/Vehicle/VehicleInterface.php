<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Repository\Vehicle;

use App\Repository\BasicInterface;
use Illuminate\Database\Eloquent\Collection;

interface VehicleInterface extends BasicInterface
{

    /**
     *
     * @param string $ownerName
     * @return array
     */
    public function getAllByOwnerName(string $ownerName) : Collection ;


}