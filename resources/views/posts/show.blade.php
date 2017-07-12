@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-default">Go Back</a>
  <h1>{{$post->crop_name}}</h1>
  <h2>{{$post->strain}}</h2>
  <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
  <br><br>
  <div>
    {!!$post->body!!}
  </div>

  <hr>

  <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
  <hr>

  {{-- add in the weeks for each post

  <h1>weeks</h1>
    @if(count($weeks) > 0)
        @foreach($weeks as $week)
          <div class="well">
            <div class="row">
              <div class="col-md-3 col-sm-3">
                <img style="height:120px" src="/storage/cover_images/{{$week->cover_image}}">
              </div>
              <div class="col-md-9 col-sm-9">
                <h3><a href="/weeks/{{$week->id}}">{{$week->week_num}}</a></h3>
                <small>Written on {{$week->created_at}}</small>
              </div>
            </div>

          </div>
        @endforeach
      @else
        <p>No weeks found</p>
      @endif

  --}}

  @if(!Auth::guest())
      @if (Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
        <a href="/weeks/create" class="btn btn-primary">Add Week</a>

        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
      @endif
  @endif
@endsection
