<?php

namespace App\Repositories\V1\User;

use App\Models\User;
use App\Models\UserRole;
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
    public function login($data, $remember = false)
    {
        return Auth::attempt($data, $remember);
    }
    public function hasRole($id)
    {
        $bool= User::findorfail($id)->userroles()->get();
        if ($bool->isEmpty()) {
            return true;
        }
        return false;
    }
}
