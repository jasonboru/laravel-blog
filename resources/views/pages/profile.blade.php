@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>{{ $user->name }}'s Profile</h2></div>

        <div class="panel-body">
          <img src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
{{--
          {!! Form::open(['action' => '/profile', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
              {{Form::label('Update Profile Image', 'Update Profile Image')}}
              {{Form::file('avatar')}}
            </div>
            {{Form::submit('Submit', ['class'=>'btn btn-primary pull-right'])}}
          {!! Form::close() !!}
--}}

          <form enctype="multipart/form-data" action="/profile" method="POST">
            <label>Update Profile Image</label>
            <input type="file" name="avatar">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="pull-right btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
