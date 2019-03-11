<?php

namespace App\Repositories\V1\UserRole;

use App\Repositories\BaseRepository;
use App\Models\UserRole;

class UserRoleRepository extends BaseRepository implements UserRoleRepositoryInterface
{
    public function getModel()
    {
        return UserRole::class;
    }
}
