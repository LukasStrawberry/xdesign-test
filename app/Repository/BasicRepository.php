<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Repository;


use Illuminate\Database\Eloquent\Collection;
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
        $record = $this->model->find(1);

        return $record ?: false;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
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