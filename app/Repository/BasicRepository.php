<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

class BasicRepository implements BasicInterface
{

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function insert(array $vehicleData)
    {
        if(!$vehicleData){
            throw new \LogicException(sprintf(
                'Insert data can not be empty'
            ));
        }

        return $this->model->create($vehicleData) ?: false;
    }

    public function getById(int $vehicleId)
    {
        // TODO: Implement getById() method.
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function getOrCreate(array $selector, array $data = [])
    {
        if (!is_null($instance = $this->model->where($selector)->first())) {
            return $instance;
        }

        $data = array_merge($selector, $data);

        return $this->insert($data) ?: false;
    }

}