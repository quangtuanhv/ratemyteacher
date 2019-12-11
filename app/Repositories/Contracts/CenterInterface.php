<?php

namespace App\Repositories\Contracts;

interface CenterInterface extends RepositoryInterface
{
    public function create($inputs);
}
