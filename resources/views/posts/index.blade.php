@extends('layouts.app')

@section('content')
  <div class="overlay">
  <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
          <div class="well">
            <div class="row">
              <div class="col-md-3 col-sm-3">
                <a href="/posts/{{$post->id}}">
                <img class="allGrowsImg" style="height:120px" src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$post->cover_image}}">
                </a>
              </div>
              <div class="col-md-9 col-sm-9">
                <h3><a href="/posts/{{$post->id}}">{{$post->crop_name}}</a></h3>
                <h4>{{$post->strain}}</h4>
                <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
              </div>
            </div>

          </div>
        @endforeach

        {{$posts->links()}}

    @else
      <p>No posts found</p>
    @endif
  </div>
@endsection
