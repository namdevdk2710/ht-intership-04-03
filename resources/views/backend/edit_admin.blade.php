@extends('backend.layouts.master')
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Người Dùng</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-7 ">
                    <div class="card">
                        <div class="card-header">
                            <h5>Chỉnh Sửa Thông Tin Người Dùng</h5>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(Session::has('message'))
                        {!!Session::get('message')!!}
                        @endif
                        <form method="post" action="{{route('employee.update',['employee'=>$employee->id])}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body" id="card-1">
                                <div class="form-group" >
                                    <img id="image-img" style="margin-bottom: 1vh" src="{{asset('storage/img/avatar').'/'.$employee->image}}">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Email </label>
                                    <input readonly type="email" id="email" name="email" class="form-control"
                                           required
                                           value="{{$employee->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Tên </label>
                                    <input type="text" id="name" name="name" class="form-control" required
                                           value="{{$employee->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Số Điện Thoại </label>
                                    <input type="text" id="phone" name="phone" class="form-control" required
                                           value="{{$employee->phone}}">
                                </div>
                                <div class="form-group">
                                    <label>Ngày Sinh </label>
                                    <input type="date" id="birthday" name="birthday" class="form-control" required
                                           value="{{$employee->birthday}}">
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                    <th>Quyền</th>
                                    @foreach($permission as $p)
                                        <th>{{$p->name}}</th>
                                    @endforeach
                                    </thead>
                                    <tbody>
                                    <tr data-id="">
                                        <td></td>
                                        @foreach($permission as $p)
                                            <td><input type="checkbox" value="{{$p->id}}" {{in_array($p->id,$employee->role)?'checked':''}} name="permission[]"></td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="form-group d-flex justify-content-end">
                                    <input type="submit" id="submit" class="btn btn-success" value="Cập Nhật"
                                           required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-5 ">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('employee.update_password',[$employee->id])}}">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Mật Khẩu Mới</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Xác Nhận Mật Khẩu </label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                           class="form-control">
                                </div>
                                <div class="form-group">

                                    <input type="submit" name="passworn_btn" id="passworn_btn   "
                                           class="btn btn-danger" value="Đổi Mật Khẩu">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    #image-img {
        width: 100px;


    }
</style>
@endsection
@section('script')
<script src="{{asset('js/backend/user_edit.js')}}"></script>
@endsection