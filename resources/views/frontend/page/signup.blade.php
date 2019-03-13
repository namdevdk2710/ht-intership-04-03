@extends('frontend.master')
@section ('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đăng kí</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="index.html">Home</a> / <span>Đăng kí</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">

        <form method="post" action="{{route('register')}}">
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
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection 