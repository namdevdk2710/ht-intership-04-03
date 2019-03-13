<?php

namespace App\Http\Controllers\V1\Web\backend;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Models\User;
use App\Repositories\V1\Admin\AdminRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $repository;

    public function __construct(AdminRepositoryInterface $repository)
    {
        return $this->repository = $repository;
    }

    public function index()
    {
        $users = $this->repository->paginate(5);
        return view('backend.show_admin_list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = $this->repository->roleList();
        return view('backend.create_admin', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee)
    {
        $employee = $this->repository->edit($employee);
        $permission = $this->repository->roleList();
        return view('backend.edit_admin', compact(['permission', 'employee']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, User $employee)
    {
        $result = $this->repository->updateAdmin($employee->id, $request);
        if ($result) {
            session()->flash('message', "<div class='alert alert-success'>Cập nhật thông tin thành công!</div>");
            return redirect()->back();
        }
        session()->flash('message', "<div class='alert alert-danger'>Cập nhật thông tin thất bại!</div>");
        return redirect()->back();
    }

    public function updatePassword(UpdateUserPasswordRequest $request, User $employee)
    {
        $result = $this->repository->update($employee->id, $request);
        if ($result) {
            session()->flash('message', "<div class='alert alert-success'>Cập nhật thông tin thành công!</div>");
            return redirect()->back();
        }
        session()->flash('message', "<div class='alert alert-danger'>Cập nhật thông tin thất bại!</div>");
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee)
    {
        $this->repository->destroy($employee->id);
    }
}
