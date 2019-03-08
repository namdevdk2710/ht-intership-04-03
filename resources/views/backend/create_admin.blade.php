@extends('backend.layouts.master')
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Quản Lý Người Dùng</h1>
            </div>

            <div class="section-body">
                @if(Session::has('message'))
                    {!!Session::get('message')!!}
                @endif
                <div class="row d-flex justify-content-center">
                    <div class="col-6 ">
                        <div class="card">
                            <div class="card-header">
                                <h5>Thêm Quản Trị Viên</h5>
                            </div>
                            <form method="post" action="{{route('employee.store')}}">
                                @csrf
                                <div class="card-body" id="card-1">
                                    <div class="form-group">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <label>Email <span style="color: red">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" required
                                               value="{{old('email')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tên <span style="color: red">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" required
                                               value="{{old('name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Số Điện Thoại <span style="color: red">*</span></label>
                                        <input type="text" id="phone" name="phone" class="form-control" required
                                               value="{{old('phone')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày Sinh <span style="color: red">*</span></label>
                                        <input type="date" id="birthday" name="birthday" class="form-control" required
                                               value="{{old('birthday')}}">
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
                                                <td><input type="checkbox" value="{{$p->id}}" name="permission[]"></td>
                                            @endforeach
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <label>Mật Khẩu <span style="color: red">*</span></label>
                                        <input type="password" id="password" name="password" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>Xác Nhận Mật Khẩu<span style="color: red">*</span></label>
                                        <input type="password" id="confirm_password" name="confirm_password"
                                               class="form-control" required>
                                    </div>

                                    <div class="form-group d-flex justify-content-end">
                                        <input type="submit" id="submit" class="btn btn-success" value="Đăng Ký"
                                               required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection