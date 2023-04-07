<?php

namespace App\Services;

use App\Repositories\Repository;

class Service
{
    protected $repository;

    /**
     * This function used to call store function in repository
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->repository->create($data);
    }

    /**
     * This function used to call latest function in repository
     * @return mixed
     */
    public function latest()
    {
        return $this->repository->latest();
    }
}
