<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Requests\Vehicle\ShowVehicle;
use App\Http\Resources\Vehicle\VehicleResource;
use App\Http\Resources\Vehicle\VehicleResourceCollection;
use App\Service\Vehicle\VehicleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
        $allowedMethods = ['GET'];
        throw new MethodNotAllowedHttpException($allowedMethods, sprintf(
            'Method "%s" is not allowed. Allowed methods: ["%s"]',
            $request->getMethod(), implode('","', $allowedMethods)
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param ShowVehicle $showVehicleRequest
     * @param int $vehicleId
     * @return \Illuminate\Http\Response
     */
    public function show(ShowVehicle $showVehicleRequest, $vehicleId)
    {
        if(!$vehicle = $this->vehicleService->getVehicleRepository()->getById($vehicleId)){
            abort(404, sprintf(
                'Vehicle with id "%s" was not found', $vehicleId
            ));
        }

        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $vehicleId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicleId)
    {
        $allowedMethods = ['GET'];
        throw new MethodNotAllowedHttpException($allowedMethods, sprintf(
            'Method "%s" is not allowed. Allowed methods: ["%s"]',
            $request->getMethod(), implode('","', $allowedMethods)
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $vehicleId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $vehicleId)
    {
        $allowedMethods = ['GET'];
        throw new MethodNotAllowedHttpException($allowedMethods, sprintf(
            'Method "%s" is not allowed. Allowed methods: ["%s"]',
            $request->getMethod(), implode('","', $allowedMethods)
        ));
    }
}
