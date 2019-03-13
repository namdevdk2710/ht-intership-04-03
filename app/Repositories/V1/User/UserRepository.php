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
        return User::doesntHave('userroles')->orderby('name', 'asc')->paginate($num);
    }

    public function login($data, $remember = false)
    {
        return Auth::attempt($data, $remember);
    }

    public function search($data, $num)
    {
        $user = User::where('email', 'LIKE', '%'.$data->search.'%')
            ->orwhere('name', 'LIKE', '%' . $data->search . '%')
            ->paginate($num);
        $user->appends(['search' => $data->search]);

        return $user;
    }

    public function verify($token)
    {
        $user = User::where('verification_code', $token)->first();
        $user->verification_code = null;
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }
}
