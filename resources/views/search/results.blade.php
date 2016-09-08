@extends('app')

@section('content')


	@if(!$users->count())
		<p>No Results found, Sorry!</p>
	@else

		<div class="row">
			<!-- <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Home</div> -->
					<h2>Search for "{{ Request::input('query') }}"</h2>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								@include('user/partials/userblock')
							</div>

						</div>
					</div>
				<!-- </div>
			</div> -->
		</div>
	@endif

@endsection




