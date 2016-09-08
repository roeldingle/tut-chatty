@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- <div class="panel panel-default">
				<div class="panel-heading">{{$page}}</div>
				<div class="panel-body"> -->
					<form role="form" action="{{ route('status.post') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row status-form">
							<textarea placeholder="What's up {{ Auth::user()->getFullName() }}?" name="status" class="col-md-8{{ $errors->has('status') ? ' red-border' : '' }}"  rows="4"></textarea>
						</div>
						<div class="row">
							<button class="btn btn-default status-btn">Update Status</button>
						</div>
					</form>
					<hr>
					<div class="row">
						<div class="status-container col-md-8">
							@if (!$statuses->count())
								<p>There's nothing on your timeline yet</p>
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
												<li><a href="">Like</a></li>
												<li>10 likes</li>
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
														<li><a href="">Like</a></li>
														<li>10 likes</li>
													</ul>
												</div>
											
										@endforeach


											<form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="POST">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">

												<div class="row status-form">
													<textarea placeholder="Reply to this status"  name="reply-{{ $status->id }}" rows="2" class='col-md-12{{ $errors->has("reply-{$status->id}") ? " red-border" : "" }}'></textarea>
												</div>
												<div class="row">
													<input type="submit" value="Reply" class="reply-btn btn btn-default btn-sm" />
												</div>
											</form>
										</div>



									</div>
								@endforeach
								{!! $statuses->render() !!}
							@endif
						</div>
					<!-- </div>
				</div>
			</div> -->
		</div>
	</div>

@endsection
