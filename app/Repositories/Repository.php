<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository
{
    protected $model;

    /**
     * This function used to store data to table
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * This function used to get last record of the table
     * @return mixed
     */
    public function latest()
    {
        return $this->model->latest()->first();
    }

}
