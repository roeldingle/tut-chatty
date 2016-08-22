@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-5">
							@include('user.partials.userblock')
						</div>
						<div class="col-lg-4 col-lg-offset-3">
							<h3>{{ $users->first()->getFullName() }}'s Friends</h3>

							@if (!$users->first()->friends()->count())
								<p>No friends yet</p>
							@else

								@foreach($users->first()->friends() as $user)
									<?php 

									 	$where = array(
									        'key' => 'id',
									        'value' => $user->id
									    );

									 	$person = Auth::user()->getUserMeta($where)->first(); 

									 ?>
									 <div class="panel panel-default" >
									 	<div class="panel-body">

									 		<a href="{{ route('profile.index',['username' => $person->username]) }}">
										 		<img alt="" style="margin-right:10px" src="{{ $user->getAvatarUrl() }}" class="pull-left">
										 	</a>
									        <div class="pull-left">
									          <h4 class="media-heading">
												<a href="{{ route('profile.index',['username' => $person->username]) }}">{{ $person->username }}</a>
											</h4>
									          <span class="testimonials-post">{{ $person->fname }} {{ $person->lname }}</span>
									        </div>

										</div>
									</div>
								@endforeach
								
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection