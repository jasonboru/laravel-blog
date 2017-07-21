@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-lg btn-primary goBack">Go Back</a>
  <div class="overlay">
    <div class="row">
      <div class="col-sm-6">
        <h1>{{$post->crop_name}}</h1>
      </div>
      <div class="col-sm-6">
        <div class="pull-right">
        <small>Written on {{$post->created_at->format('m-d-Y')}} by</small><span class="author"> {{$post->user->name}}<span>
          <img src="https://s3.amazonaws.com/final-project-growshow/uploads/{{ $post->user->avatar}}" style="width:32px; height:32px; border-radius:50%; margin-left:5px;">
        </div>
      </div>

    </div>

  <hr>
  <h2 class="strain">{{$post->strain}}</h2>

  <div class="row">
    <div class="col-md-6 col-sm-6">
      <a href="https://s3.amazonaws.com/final-project-growshow/uploads/{{$post->cover_image}}" data-lightbox="{{$post->cover_image}}" data-title="{{$post->crop_name}} - {{$post->strain}}">
        <img class="CropImg" style="width:100%" src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$post->cover_image}}">
      </a>
    </div>
    <div class="col-md-6 col-sm-6">
      <div class="well cropParam">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3>Method:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div><h3 class="postInputResult">{{$post->method}}</h3></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3>Location:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div><h3 class="postInputResult"> {{$post->location}}</h3></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3>Lighting:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div><h3 class="postInputResult"> {{$post->lighting}}</h3></div>
            </div>
          </div>
      </div>

    </div>
  </div>

  <h3>Notes:</h3>
  <div class="well notesWell">
    <span class="postNotes">{!! $post->body !!}</span>
  </div>

  <hr>

  <h1>Weeks</h1>
     @if(count($weeks) > 0)
        @foreach($weeks as $week)
          <div class="well">
            <div class="row">
              <div class="col-md-3 col-sm-3">
                <a href="/weeks/{{$week->id}}">
                  <img class="allWeekImg" style="width:100%" src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$week->week_image}}">
                </a>
              </div>
              <div class="col-md-9 col-sm-9">
                <h3><a href="/weeks/{{$week->id}}?user={{ $post->user_id }}">Week # {{$week->week_num}}</a></h3>
                <div>{!!$week->notes!!}</div>
                <hr>
                <small>Written on {{$week->created_at->format('m-d-Y')}}</small>
              </div>
            </div>

          </div>
        @endforeach
    @else
        <p>There are no weeks listed for this crop yet.</p>
    @endif

    @if(!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
          <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit Post</a>
          <a href="/weeks/create?post={{ $post->id }}" class="btn btn-primary">Add a Week</a>

          {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Delete Post', ['class' => 'btn btn-danger bbDelete'])}}
          {!!Form::close()!!}
        @endif
    @endif

    <hr>

    <div class="row">

      <div class="col-md-8 col-md-offset-2">
        <h2>Comments</h2>
          @if(count($post->comments) > 0)
            @foreach($post->comments as $comment)
              <div class="panel panel-default comment">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-9">
                      <img src="https://s3.amazonaws.com/final-project-growshow/uploads/{{ $comment->avatar}}" style="width:32px; height:32px; border-radius:50%;">

                       {{ $comment->name }}
                    </div>
                    <div class="col-md-3">
                      <small> {{ $comment->created_at->format('m,d,Y') }} </small>
                    </div>
                  </div>
                </div>
                <div class="panel-body">{{ $comment->comment }}</div>
              </div>
            @endforeach
          @else
            <p>There are no comments for this post yet.... you should add one!</p>
          @endif
      </div>
    </div>

    <hr>

    <div class="row">
      <div id="comment-form" class="col-md-8 col-md-offset-2">
        <h2>Add a new Comment</h2>
        @if(!Auth::guest())
        {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
          <div class="row">

            {{Form::hidden('name', Auth::user()->name)}}
            {{Form::hidden('email', Auth::user()->email)}}
            {{Form::hidden('avatar', Auth::user()->avatar)}}

            <div class="col-md-12">
              {{ Form::label('comment', "Comment:") }}
              {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

              {{ Form::submit('Add Comment', ['class' => 'btn-success btn-block', 'style' => 'margin:15px 0;']) }}
            </div>

          </div>

        {{ Form::close()}}
        @else
          <h4 class="notLogInMsg">You need to be logged into your account to leave a comment. If you do not have an account you can <a href="/register">Register Here</a>.</h4>
        @endif
      </div>
    </div>

  </div>




@endsection
