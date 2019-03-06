@extends('frontend.master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">

			<form action="{{route('login_attempt')}}" method="post" class="beta-form-checkout">
				@csrf
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">

						<h4>Đăng nhập</h4>
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
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="email">Email<span style="color: red"> *</span></label>
							<input type="email" id="email" name="email" id="email" required>
						</div>
						<div class="form-block">
							<label for="password">Password<span style="color: red"> *</span></label>
							<input type="password" id="password" name="password" id="password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
    </div> <!-- .container -->
@endsection
