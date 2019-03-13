<?php

namespace App\Http\Controllers\V1\Web\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Repositories\V1\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            return redirect()->route('user.index')
                ->with('message', "<div class='alert alert-success'>Thêm người dùng thành công!</div>");
        };

        return redirect()->back()
            ->with('message', "<div class='alert alert-success'>Thêm người dùng thất bại</div>");
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

            return redirect()->back()
                ->with('message', "<div class='alert alert-success'>Cập nhật thành công!</div>");
        }

        return redirect()->back()->with('message', "<div class='alert alert-danger'>Cập nhật thất bại!</div>");
    }

    public function updatePassword(UpdateUserPasswordRequest $request, User $user)
    {
        $result = $this->repository->update($user->id, $request);
        if ($result) {

            return redirect()->back()
                ->with('message', "<div class='alert alert-success'>Cập nhật thành công!</div>");
        }

        return redirect()->back()
            ->with('message', "<div class='alert alert-danger'>Cập nhật thất bại!</div>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->repository->destroy($user->id);

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

            return redirect()->back()->with('message', 'Đăng nhập thành công!');
        }

        return redirect()->back()->with('message', 'Đăng nhập thất bại!');
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

    public function showRegistrationForm()
    {
        return view('frontend.page.signup');
    }
    public function register(Request $request)
    {
        $code = str_random(50);
        $user = $this->repository->store(
            [
                'name' => $request->input('name'),
                'password' => $request->input('password'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'birthday' => $request->input('birthday'),
                'verification_code' => $code,
            ]
        );

        if ($user) {
            Mail::to($request->input('email'))->send(new VerifyMail($user));

            return redirect()->back()
                ->with('message', "<div class='alert alert-success'>Đăng ký thành công!</div>");
        };

        return redirect()->back()
            ->with('message', "<div class='alert alert-success'>Thêm người dùng thất bại</div>");
    }

    public function verifyAccount(Request $request)
    {
        if ($request->token = null) {

            return redirect()->route('index')
                ->with('message', "<div class='alert alert-success'>Tài Khoản Đã Được Xác Nhận!</div>");
        }
        $user = $this->repository->verify($request->token);
        if ($user) {
            Auth::loginUsingId($user->id);
        }
        return redirect()->route('index')
            ->with('message', "<div class='alert alert-success'>Xác Nhận Tài Khoản Thành Công!</div>");
    }
}
