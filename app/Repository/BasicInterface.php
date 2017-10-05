<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Repository;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BasicInterface
{

    /**
     * Insert single record into data storage
     * @param array $data
     * @return false|Model
     */
    public function insert(array $data) ;

    /**
     * @param array $selector
     * @param array $data
     * @return false|Model
     */
    public function getOrCreate(array $selector, array $data = []) ;

    /**
     *
     * @param int $id
     * @return null|Model
     */
    public function getById(int $id);

    /**
     * @return array
     */
    public function getAll() : Collection ;

}