@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ route('auth.register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Username</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">First name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fname">
							</div>
						</div>

						<div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Last name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lname">
							</div>
						</div>

						<div class="form-group">
				    		<label for="gender" class="col-sm-3 col-md-3 control-label text-right">Gender</label>
				    		<div class="col-sm-7 col-md-7">
				    			<div class="input-group">
				    				<div id="radioBtn" class="btn-group">
				    					<a class="btn btn-primary btn-sm" data-toggle="gender" data-title="Male" >Male</a>
				    					<a class="btn btn-primary btn-sm" data-toggle="gender" data-title="Female">Female</a>
				    				</div>
				    				<input type="hidden" name="gender" id="gender" value="">
				    			</div>
				    		</div>
				    	</div>

				    	<!-- Text input-->
				          <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
				            <!-- <label class="col-sm-2 control-label" for="textinput">E-Mail Address</label> -->
				            <div class="col-sm-8 col-sm-offset-2">
				              <input type="text" class="form-control" placeholder="Set an Avatar URL" name="avatar" value="">
				            </div>
				          </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
