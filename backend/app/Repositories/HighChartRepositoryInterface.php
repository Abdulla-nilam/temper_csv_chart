<?php

namespace App\Repositories;

interface HighChartRepositoryInterface
{
    /**
     * @param $steps
     *
     * @return mixed
     */
    public function all($steps);
}
