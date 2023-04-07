<?php

namespace App\Services;

use App\Repositories\NumberRepository;

class NumberService extends Service
{

    protected $repository;

    public function __construct(NumberRepository $numberRepository)
    {
        $this->repository = $numberRepository;
    }

}
