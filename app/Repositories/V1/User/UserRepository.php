<?php

namespace App\Repositories\V1\User;

use App\Models\Role;
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
    public function hasRole($id)
    {
        $role = UserRole::where('user_id', $id)->get();
        if (count($role)) return true;

        return false;
    }

    public function updatePassword($request, $id)
    {
        $model= $this->model->findorfail($id);
        $dataArray= $request->all();
        $model->fill($dataArray);

        return $model->save();
    }
}
