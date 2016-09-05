@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Friends</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-5">
							<h2>Your Friends </h2>
							@if (!$friends->count())
								<p>No friends yet</p>
							@else

								@foreach($friends as $friend)
									<?php 

									 	$where = array(
									        'key' => 'id',
									        'value' => $friend->id
									    );

									 	$person = Auth::user()->getUserMeta($where)->first(); 

									 ?>
									 <div class="panel panel-default" >
									 	<div class="panel-body">

									 		@if(!$person->count())
									 			<p>---</p>
									 		@else
									 			<a href="{{ route('profile.index',['username' => $person->username]) }}">
											 		<img alt="" style="margin-right:10px" src="{{ $friend->getAvatarUrl() }}" class="pull-left">
											 	</a>
										        <div class="pull-left">
										          <h4 class="media-heading">
													<a href="{{ route('profile.index',['username' => $person->username]) }}">{{ $person->fname }} {{ $person->lname }}</a>
												</h4>
										          <span class="testimonials-post">{{ $person->username }}</span>
										        </div>

									 		@endif

									 		

										</div>
									</div>
								@endforeach
								
							@endif
						</div>
						<div class="col-lg-4 col-lg-offset-3">

							
							
							<h3>Friends Request</h3>

							@if (!$requests->count())
								<p>You have no friend request</p>
							@else

								@foreach($requests as $request)
									<?php 

									 	$where = array(
									        'key' => 'id',
									        'value' => $request->id
									    );

									 	$person = Auth::user()->getUserMeta($where)->first(); 

									 ?>

									 @if(!$person->count())
									 	<p>fdf</p>

									 @else
									 	<div class="panel panel-default" >
										 	<div class="panel-body">

										 		<a href="{{ route('profile.index',['username' => $person->username]) }}">
											 		<img alt="" style="margin-right:10px" src="{{ $person->getAvatarUrl() }}" class="pull-left">
											 	</a>
										        <div class="pull-left">
										          <h4 class="media-heading">
													<a href="{{ route('profile.index',['username' => $person->username]) }}">{{ $person->fname }} {{ $person->lname }}</a>
												</h4>
										          <span class="testimonials-post">{{ $person->username }}</span>
										        </div>

											</div>
										</div>
									 @endif
									 
								@endforeach
							@endif

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection