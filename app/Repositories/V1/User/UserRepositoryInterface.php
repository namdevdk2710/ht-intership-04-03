<?php

namespace App\Repositories\V1\User;

interface UserRepositoryInterface
{
    public function paginate($num);
    public function login($data, $remember=false);
}
