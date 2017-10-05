<?php

namespace App\Http\Resources\Vehicle;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        if($request->query->has('include') || $request->query->has('fields')) {
            return $this->getJsonApiFormat($request);
        }

        return [
            'data' => $this->collection
        ];
    }
}
