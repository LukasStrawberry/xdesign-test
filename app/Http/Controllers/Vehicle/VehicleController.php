<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Resources\Vehicle\VehicleResource;
use App\Http\Resources\Vehicle\VehicleResourceCollection;
use App\Model\Vehicle\Vehicle;
use App\Repository\Vehicle\VehicleRepository;
use App\Service\Vehicle\VehicleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{

    /**
     * @var VehicleService
     */
    private $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VehicleResourceCollection($this->vehicleService->getVehicleRepository()->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vehicle\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$vehicle = $this->vehicleService->getVehicleRepository()->getById($id)){
            exit();
        }

        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vehicle\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vehicle\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
