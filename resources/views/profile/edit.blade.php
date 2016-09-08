@extends('app')

@section('content')

<?php 

	$where = array(
	    'key' => 'id',
	    'value' => Auth::user()->id
	);

	$person = Auth::user()->getUserMeta($where)->first(); 

?>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

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

					 <form class="form-horizontal" role="form" method="POST" action="{{ route('profile.edit') }}">

					 	<input type="hidden" name="_token" value="{{ csrf_token() }}">

				        <fieldset>

				          <!-- Text input-->
				          <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
				            <!-- label class="col-sm-2  control-label" for="textinput">Username</label> -->
				            <div class="col-sm-8 col-sm-offset-2">
				              <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username')  ?: $person->username  }}">
				            </div>
				          </div>

				          <!-- Text input-->
				          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				            <!-- <label class="col-sm-2 control-label" for="textinput">E-Mail Address</label> -->
				            <div class="col-sm-8 col-sm-offset-2">
				              <input type="text" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') ?: $person->email }}">
				            </div>
				          </div>



				          <!-- Text input-->
				          <div class="form-group">
				            <!-- <label class="col-sm-2 control-label" for="textinput">First name</label> -->
				            <div class="col-sm-4 col-sm-offset-2{{ $errors->has('fname') ? ' has-error' : '' }}">
				              <input type="text" placeholder="First name" name="fname" class="form-control" value="{{ old('fname') ?: $person->fname }}" >
				            </div>

				         <!--    <label class="col-sm-2 control-label" for="textinput">Last name</label> -->
				            <div class="col-sm-4{{ $errors->has('lname') ? ' has-error' : '' }}">
				              <input type="text" placeholder="Last name" name="lname" class="form-control" value="{{  old('lname') ?: $person->lname }}">
				            </div>
				          </div>

				          <div class="form-group">
				    		<label for="gender" class="col-sm-3 col-md-3 control-label text-right">Gender</label>
				    		<div class="col-sm-7 col-md-7">
				    			<div class="input-group">
				    				<div id="radioBtn" class="btn-group">
				    					<a class="btn btn-primary btn-sm {{ strtolower($person->gender) == 'male' ? 'active' : '' }}" data-toggle="gender" data-title="Male" >Male</a>
				    					<a class="btn btn-primary btn-sm {{ strtolower($person->gender) == 'female' ? 'active' : '' }}" data-toggle="gender" data-title="Female">Female</a>
				    				</div>
				    				<input type="hidden" name="gender" id="gender" value="{{ $person->gender ?: '' }}">
				    			</div>
				    		</div>
				    	</div>

				    	<!-- Text input-->
				          <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
				            <!-- <label class="col-sm-2 control-label" for="textinput">E-Mail Address</label> -->
				            <div class="col-sm-8 col-sm-offset-2">
				              <input type="text" class="form-control" placeholder="Set an Avatar URL" name="avatar" value="{{ old('avatar') ?: $person->avatar }}">
				            </div>
				          </div>


				          <!-- Text input--
				          <div class="form-group">
				            <!-- <label class="col-sm-2 control-label" for="textinput">First name</label> --
				            <div class="col-sm-4 col-sm-offset-2">
				              <input type="text" placeholder="Gender" class="form-control">
				            </div>

				         <!--    <label class="col-sm-2 control-label" for="textinput">Last name</label> --
				            <div class="col-sm-4">
				              <input type="text" placeholder="Birthdate" class="form-control">
				            </div>
				          </div>

				      		-->

				          <hr />

				          <div class="form-group">
				            <div class="col-sm-10">
				              <div class="pull-right">
				                <button type="submit" class="btn btn-default">Cancel</button>
				                <button type="submit" class="btn btn-primary">Register</button>
				              </div>
				            </div>
				          </div>

				        </fieldset>
				      </form>


				</div>
			</div>
		</div>
	</div>

@endsection


