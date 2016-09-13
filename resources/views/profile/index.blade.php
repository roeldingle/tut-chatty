@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- <div class="panel panel-default">
				<div class="panel-heading">Profile</div>
				<div class="panel-body"> -->
					<div class="row">
						<div class="col-lg-8">

							<!-- User profile -->
							@foreach($users as $key=>$user)

							 <?php 

							 	$where = array(
							        'key' => 'id',
							        'value' => $user->id
							    );

							 	$person = Auth::user()->getUserMeta($where)->first(); 


							 ?>
							 @if (!$person->count())
							 	<p>Please update profile info</p>
							 @else
								 <h2>{{ $person->fname }}'s Profile</h2>
								 <div class="panel panel-default" >
								 	<div class="panel-body">

								 		<a href="{{ route('profile.index',['username' => $person->username]) }}">
									 		<img alt="" style="margin-right:10px" src="{{ $user->getAvatarUrl() }}" class="profile-img pull-left">
									 	</a>
								        <div class="pull-left">
								          <h4 class="media-heading">
											<a href="{{ route('profile.index',['username' => $person->username]) }}">{{ $person->fname }} {{ $person->lname }}</a>
										</h4>
								          <p class="testimonials-post">{{ $user->email }}</p>
								          <p class="testimonials-post">{{ $person->username }}</p>
								          <p class="testimonials-post">{{ $person->gender }}</p>
								        </div>

									</div>
								</div>
							@endif

							@endforeach


							<!-- Status -->
							<div class="row">
								<div class="status-container">
									@if (!$statuses->count())
										<p>Has not yet posted anything yet</p>
									@else
										@foreach ($statuses as $status)
										
											<div class="status-item">
												<a class="avatar pull-left" href="{{ route('profile.index', ['username' => $status->user->username ]) }}">
													<img class="profile-img" alt="" src="{{ $status->user->getAvatarUrl() }}" />
												</a>
												<div class="" style="margin-left:10%">
													<h4 class="">
														<a href="{{ route('profile.index', ['username' => $status->user->username ]) }}">{{$status->user->getFullName()}}</a>
													</h4>
													<p class="status-content">{{ $status->body }}</p>
													<ul class="list-inline">
														<li>{{ $status->created_at->diffForHumans() }}</li>
							
														<li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count()) }}</li>
													</ul>
												</div>

												<div class="status-reply">
												@foreach ($status->replies as $reply)
										
														<a class="avatar pull-left" href="{{ route('profile.index', ['username' => $reply->user->username ]) }}">
															<img class="profile-img" alt="" src="{{ Auth::user()->getAvatarUrlById($reply->user->id) }}" />
														</a>
														<div class="" style="margin-left:10%">
															<h5 class="">
																<a href="{{ route('profile.index', ['username' => $reply->user->username ]) }}">{{$reply->user->getFullName()}}</a>
															</h5>
															<p class="status-content">{{ $reply->body }}</p>
															<ul class="list-inline">
																<li>{{ $reply->created_at->diffForHumans() }}</li>
																@if($reply->user->id !== Auth::user()->id)
																	<li><a href="{{ route('status.like', ['statusId' => $reply->id ]) }}">Like</a></li>
																@endif
																<li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>
															</ul>
														</div>
													
												@endforeach

												@if($authUserIsFriend || Auth::user()->id === $status->user->id)
													<form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="POST">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">

														<div class="row status-form">
															<textarea placeholder="Reply to this status"  name="reply-{{ $status->id }}" rows="2" class='col-md-12{{ $errors->has("reply-{$status->id}") ? " red-border" : "" }}'></textarea>
														</div>
														<div class="row">
															<input type="submit" value="Reply" class="reply-btn btn btn-default btn-sm" />
														</div>
													</form>
												
												@endif
												</div>

											</div>
										@endforeach
										
									@endif
									</div>
								</div>
								<!-- end Status -->



						</div>
						<div class="col-lg-4">

							@if (Auth::user()->hasFriendRequestsPending($users->first()))
								<p>Waiting for {{$users->first()->getFullName()}} to accept friend request</p>
							@elseif (Auth::user()->hasFriendRequestReceived($users->first()))
								<a href="{{ route('friend.accept' , ['username' => $users->first()->username] )}}" class="btn btn-primary">Accept friend request</a>
							@elseif (Auth::user()->isFriendsWith($users->first()))
								<p>You are friends with {{$users->first()->getFullName()}}</p>
								<form method="POST" action="{{ route('friend.delete' , ['username' => $users->first()->username] )}}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="submit" name="delete-friend" value="Unfriend" class="btn btn-primary">
								</form>
							@else
								@if(Auth::user()->id != $users->first()->id)
									<a href="{{ route('friend.add' , ['username' => $users->first()->username])}}" class="btn btn-primary">Add as friend</a>
								@endif
							@endif

							<h3>Friends</h3>

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
										 		<img alt="" style="margin-right:10px" src="{{ $person->getAvatarUrl() }}" class="pull-left profile-img">
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
				<!-- 	</div>
				</div>
			</div> -->
		</div>
	</div>

@endsection