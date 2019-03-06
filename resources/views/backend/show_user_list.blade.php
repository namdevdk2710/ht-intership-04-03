@extends('backend.layouts.master')
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Quản Lý Người Dùng</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Components</a></div>
                    <div class="breadcrumb-item">Table</div>
                </div>
            </div>

            <div class="section-body">
                @if(Session::has('message'))
                    {!!Session::get('message')!!}
                @endif
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body" style="height: 500px;">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>TÊN</th>
                                            <th>Ngày Tạo</th>
                                            <th>Thông tin</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table-body">
                                        @foreach($users as $index=>$user)
                                            <tr id="table-row" >
                                                <td>{{$users->perPage()*($users->currentPage()-1)+$index+1}}</td>
                                                <td style="width: 200px;">{{$user->name}}</td>
                                                <td>{{$user->created_at}}</td>
                                                <td><a href="#" class="btn btn-info">Xem</a></td>
                                                <td><a href="{{route('user.edit',['user'=>$user->id])}}" class="btn btn-success">Sửa</a></td>
                                                <td><form action="{{route('user.destroy',['user'=>$user->id])}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <input class="btn btn-danger" type="submit" value="Xóa" data-name="{{$user->name}}" id="user_delete">
                                                    </form>
                                                 </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        {{$users->links('backend.modules.custom_pagination')}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>

@endsection
@section('footer')
@endsection
@section('script')
    <script src="{{asset('js/backend/user_list.js')}}"></script>
@endsection
