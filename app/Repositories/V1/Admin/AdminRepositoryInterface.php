<?php

namespace App\Repositories\V1\Admin;

interface AdminRepositoryInterface
{
    public function paginate($num);
    public function store($data);
    public function create();
}
