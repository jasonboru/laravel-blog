@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-default">Go Back</a>
  <h1>{{$post->crop_name}}</h1>
  <h2>{{$post->strain}}</h2>

  <div class="row">
    <div class="col-md-6 col-sm-6">
      <a href="/storage/cover_images/{{$post->cover_image}}" data-lightbox="{{$post->cover_image}}" data-title="{{$post->crop_name}} - {{$post->strain}}">
        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
      </a>
    </div>
    <div class="col-md-6 col-sm-6">
      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Method:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$post->method}}</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Location:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$post->location}}</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Lighting:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$post->lighting}}</div>
        </div>
      </div>

    </div>
  </div>

  <br><br>
  <div>
    {!!$post->body!!}
  </div>

  <hr>

  <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
  <hr>



  <h1>Weeks</h1>
     @if(count($weeks) > 0)
        @foreach($weeks as $week)
          <div class="well">
            <div class="row">
              <div class="col-md-3 col-sm-3">
                <a href="/weeks/{{$week->id}}">
                  <img style="width:100%" src="/storage/week_images/{{$week->week_image}}">
                </a>
              </div>
              <div class="col-md-9 col-sm-9">
                <h3><a href="/weeks/{{$week->id}}">Week # {{$week->week_num}}</a></h3>
                <div>{!!$week->notes!!}</div>
                <hr>
                <small>Written on {{$week->created_at}}</small>
              </div>
            </div>

          </div>
        @endforeach
    @else
        <p>No weeks found</p>
    @endif



  @if(!Auth::guest())
      @if (Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
        <a href="/weeks/create?post={{ $post->id }}" class="btn btn-primary">Add Week</a>

        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
      @endif
  @endif
@endsection
