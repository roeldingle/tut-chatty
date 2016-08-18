
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
			<a href="{{ route('profile.index',['username' => $person->username]) }}">{{ $person->username }}</a>
		</h4>
          <span class="testimonials-post">{{ $person->fname }} {{ $person->lname }}</span>
        </div>

	</div>
</div>

@endforeach
