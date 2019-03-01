<?php

namespace App\Http\Controllers\V1\Web\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Repositories\V1\User\UserRepositoryInterface;
use Illuminate\Http\Request;

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
        $user = $this->repository->index();
        return view('backend.show_user_list', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return view('backend.create_user_form');
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
            ]
        );
        return response()->json($result);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user= $this->repository->find(1);
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
        //return view('',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $result= $this->repository->update($user->id, $request->all());
        if ($result) {
            session()->flash('message', 'Cập nhật thông tin thành công!');
            return redirect()->back();
        }
        session()->flash('message', 'Cập nhật thông tin thất bại!');
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
        $result = $this->repository->destroy($user);
        return $result;
    }

    public function login(Request $request)
    {
        $cresident = $request->only(['email', 'password']);
        $result = $this->repository->login($cresident, $request->remember);
        return response()->json($result);
    }
}
