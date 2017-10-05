<?php

namespace App\Http\Resources\Vehicle;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class VehicleResource extends Resource
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
            'id' => $this->id,
            'license_plate' => $this->license_plate,
            'seats_count' => $this->seats_count,
            'doors_count' => $this->doors_count,
            'wheels_count' => $this->wheels_count,
            'has_boot' => $this->has_boot,
            'has_trailer' => $this->has_trailer,
            'has_sunroof' => $this->has_sunroof,
            'has_gps' => $this->has_gps,
            'colour' => $this->colour,
            'engine_cc' => $this->engine_cc,
            'fuel_type' => [
                'id' => $this->fuelType->id,
                'name' => $this->fuelType->name
            ],
            'model' => [
                'id' => $this->model->id,
                'name' => $this->model->name,
                'is_hgv' => $this->model->is_hgv
            ],
            'owner' => [
                'id' => $this->owner->id,
                'name' => $this->owner->name,
                'profession' => $this->owner->profession,
                'company' => [
                    'id' => $this->owner->company->id,
                    'name' => $this->owner->company->name,
                ]
            ],
            'transmission' => ['id' => $this->transmission->id, 'name' => $this->transmission->name],
            'usage' => ['id' => $this->usage->id, 'name' => $this->usage->name],
            'weight_category' => ['id' => $this->weightCategory->id, 'name' => $this->weightCategory->name],
            'type' => ['id' => $this->type->id, 'name' => $this->type->name]
        ];
    }

    /**
     * Implementation of jsonapi.org
     *
     * @Todo Abstraction of include & fields logic
     * @Todo Validation of requested fields and include if is valid for expected object
     *
     * @param Request $request
     * @return array
     *
     * @internal Under development
     */
    private function getJsonApiFormat(Request $request){
        $include = explode(',', $request->query->get('include', ''));
        $fields = $request->query->get('fields', [$this->resource::TABLE_NAME => 'license_plate']);
        $fields = array_map(function ($value) {
            return explode(',', $value);
        }, $fields);

        $data = [
            'data' => [
                "type" => $this->resource::TABLE_NAME,
                "id" => $this->id,
                "attributes" => [],
            ]
        ];

        if(isset($fields[$this->resource::TABLE_NAME])){
            foreach ($fields[$this->resource::TABLE_NAME] as $field){
                $data['data']['attributes'][$field] = $this->__get($field);
            }
        }

        return $data;
    }
}
