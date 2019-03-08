<?php

namespace App\Http\Controllers\V1\Web\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Repositories\V1\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->repository->paginate(5);
        return view('backend.show_user_list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.create_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $result = $this->repository->store(
            [
                'name' => $request->input('name'),
                'password' => $request->input('password'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'birthday' => $request->input('birthday'),
            ]
        );
        if ($result) {
            session()->flash('message', "<div class='alert alert-success'>Thêm người dùng thành công!</div>");
            return redirect()->route('user.index');
        };
        session()->flash('message', "<div class='alert alert-success'>Thêm người dùng thất bại</div>");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return view('',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.edit_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $result = $this->repository->update($user->id, $request);
        if ($result) {
            session()->flash('message', "<div class='alert alert-success'>Cập nhật thông tin thành công!</div>");
            return redirect()->back();
        }
        session()->flash('message', "<div class='alert alert-danger'>Cập nhật thông tin thất bại!</div>");
        return redirect()->back();
    }

    public function updatePassword(UpdateUserPasswordRequest $request, User $user)
    {
        $result = $this->repository->update($user->id, $request);
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
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $this->repository->destroy($user->id);
        return redirect()->back();
    }

    public function loginAttempt(UserLoginRequest $request)
    {
        $cresident = $request->only(['email', 'password']);
        $result = $this->repository->login($cresident, $request->remember);
        if ($result) {
            if ($this->repository->hasRole(Auth::id())) {
                return redirect()->route('admin.home');
            }
            session()->flash('message', 'Đăng nhập thành công!');
            return redirect()->back();
        }
        session()->flash('message', 'Đăng nhập thất bại!');
        return redirect()->back();
    }

    public function login()
    {
        return view('frontend.page.login');
    }

    public function searchCustomer(Request $request)
    {
        $users = $this->repository->search($request, 5);
        return view('backend.show_user_list', compact('users'));
    }
}
