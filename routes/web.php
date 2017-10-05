<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (\App\Service\Vehicle\VehicleService $vehicleService) {
    return view('vehicles', ['vehicles' => $vehicleService->getVehicleRepository()->getAll()]);
});

Route::get('/{vehicle}', function (
    \App\Http\Requests\Vehicle\ShowVehicle $request,
    \App\Service\Vehicle\VehicleService $vehicleService,
    $vehicleId
) {
    return view('vehicle', ['vehicle' => $vehicleService->getVehicleRepository()->getById($vehicleId)]);
});
