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
							dffd
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection