@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h3><span class="allPostHeading">All Posts for </span>{{Auth::user()->name}}</h3>
                    </div>
                    <div class="col-md-6">
                      <a href="/posts/create" class="btn btn-primary pull-right dashCreate">Create a New Post</a>
                    </div>
                  </div>
                    @if(count($posts) > 0)

                      @foreach($posts as $post)

                        <div class="well row dashWell center-block">
                          <div class="col-sm-4">
                              <img class="allDashImg img-rounded" src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$post->cover_image}}">
                          </div>
                          <div class="col-sm-4">
                              <a href="/posts/{{$post->id}}">
                                <h3 class="dashCrop">{{$post->crop_name}} </h3>
                                <h4 class="dashStrain">{{$post->strain}} </h4>
                              </a>
                          </div>
                          <div class="col-sm-4">
                              <a href="/posts/{{$post->id}}/edit" class="btn btn-default center-block dashBtn">Edit Post</a>
                              <br>

                              {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'bbDelete'])!!}
                                  {{Form::hidden('_method', 'DELETE')}}
                                  {{Form::submit('Delete Post', ['class' => 'btn btn-danger bbDelete center-block dashBtn'])}}
                              {!!Form::close()!!}
                          </div>
                        </div>

                      @endforeach

                  @else
                    <p>You have no posts</p>
                  @endif

                </div>
            </div>
        </div>
    </div>
@endsection
