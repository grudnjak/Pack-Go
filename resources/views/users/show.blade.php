@extends('layouts.app')

@section('content')
<div class="container" style="width: 30%; float: left">
	Name:  {{$user->name}}<br>
	Email address: {{$user->email}}<br>
	Profile picture:  {{$user->pic_url}}<br>
</div>
@if(Auth::user()->admin)
	<a href="/users/{{$user->id}}/edit" class="float-right btn btn-primary">Edit profile</a>
@endif
@if($user->provider)
	@foreach($user->motorhome->sortByDesc('created_at') as $rv)
	<div class="jumbotron jumbotron-fluid" style="overflow: hidden">
		<div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/storage/cover_images/{{$rv->cover_image}}">
                        </div>
		<div class="container" style="margin-top: 20vh;float: right; width: 30%">
			<div class="lead">
				{{ $rv->description }}
			</div>
		</div>
	</div>
	@endforeach
@endif
@endsection