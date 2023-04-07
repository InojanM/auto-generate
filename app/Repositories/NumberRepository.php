<?php

namespace App\Repositories;

use App\Models\Number;

class NumberRepository extends Repository
{
    protected $model;

    public function __construct(Number $number)
    {
        $this->model = $number;
    }


}
