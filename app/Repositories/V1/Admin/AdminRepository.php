<?php

namespace App\Repositories\V1\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
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

    public function updateAdmin($id, $data)
    {
        $model= $this->model->findorfail($id);

        $dataArray= $data->all();
        $fill =$model->fill($dataArray);

        if ($data->hasFile('image')) {
            $file = $data->image;
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/avatar'), $fileName);
            $fill->image= $fileName;
        }

        if ($model->save()) {
            if ($dataArray['permission']) {
                $model->userroles()->delete();
                foreach ($dataArray['permission'] as $permission) {
                    $model->userroles()->create([
                        'role_id' => $permission,
                        'user_id' => $model->id,
                    ]);
                }
            }
        }
    }
    public function roleList()
    {
        $role = Role::where('id', '!=', '1')->get();
        return $role;
    }

    public function edit(User $employee)
    {
        $roles = $employee->userroles()->get();
        foreach ($roles as $index => $role){
            $userrole[$index] = $role->role_id;
        }
        $employee->role =$userrole;
        return $employee;
    }

    public function updatePassword($request, $id)
    {
        $model= $this->model->findorfail($id);
        $dataArray= $request->all();
        $model->fill($dataArray);

        return $model->save();
    }
}
