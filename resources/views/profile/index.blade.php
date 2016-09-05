@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Profile</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-5">

							@foreach($users as $key=>$user)

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
										<a href="{{ route('profile.index',['username' => $person->username]) }}">{{ $person->fname }} {{ $person->lname }}</a>
									</h4>
							          <span class="testimonials-post">{{ $person->username }}</span>
							        </div>

								</div>
							</div>

							@endforeach

						</div>
						<div class="col-lg-4 col-lg-offset-3">

							@if (Auth::user()->hasFriendRequestsPending($users->first()))
								<p>Waiting for {{$users->first()->getFullName()}} to accept friend request</p>
							@elseif (Auth::user()->hasFriendRequestReceived($users->first()))
								<a href="{{ route('friend.accept' , ['username' => $users->first()->username])}}" class="btn btn-primary">Accept friend request</a>
							@elseif (Auth::user()->isFriendsWith($users->first()))
								<p>You are friends with {{$users->first()->getFullName()}}</p>
							@else
								@if(Auth::user()->id != $users->first()->id)
									<a href="{{ route('friend.add' , ['username' => $users->first()->username])}}" class="btn btn-primary">Add as friend</a>
								@endif
							@endif

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
												<a href="{{ route('profile.index',['username' => $person->username]) }}">{{ $person->fname }} {{ $person->lname }}</a>
											</h4>
									          <span class="testimonials-post">{{ $person->username }}</span>
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