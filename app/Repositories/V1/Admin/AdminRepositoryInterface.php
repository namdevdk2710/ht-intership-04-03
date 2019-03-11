<?php

namespace App\Repositories\V1\Admin;

use App\Models\User;

interface AdminRepositoryInterface
{
    public function paginate($num);
    public function store($data);
    public function roleList();
    public function edit(User $employee);
    public function updatePassword($request, $id);
}
