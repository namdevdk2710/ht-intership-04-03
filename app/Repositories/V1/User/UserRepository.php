<?php

namespace App\Repositories\V1\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function getModel()
    {
        return User::class;
    }
    public function paginate($num)
    {
        return User::paginate($num);
    }
    public function login($data, $remember=false)
    {
        return Auth::attempt($data, $remember);
    }

}
