<?php

namespace App\Repositories\V1\Admin;

use App\Models\Role;
use App\Models\User;
use App\Repositories\BaseRepository;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function paginate($num)
    {
        $users = User::with(['roles'])->
        whereHas('roles', function ($q) {
            $q->where('role_id', '!=', 'null');
        })->orderby('name', 'asc')->paginate($num);
        return $users;
    }

    public function store($data)
    {
        $user = new User();
        $user->name = $data->input('name');
        $user->email = $data->input('email');
        $user->password = $data->input('password');
        $user->phone = $data->input('phone');
        $user->birthday = $data->input('birthday');
        $user->save();

        foreach ($data->input('permission') as $permission) {
            $user->userroles()->create([
                'role_id' => $permission,
                'user_id' => $user->id,
            ]);
        }
    }

    public function create()
    {
        $role = Role::where('id', '!=', '1')->get();
        return $role;
    }
}
