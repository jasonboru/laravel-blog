@extends('layouts.app')

@section('content')
  <div class="overlay">
  <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
          <div class="well">
            <a class="blockLink" href="/posts/{{$post->id}}">
              <div class="row">
                <div class="col-md-4 col-sm-4">

                  <img class="allGrowsImg img-rounded" src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$post->cover_image}}">

                </div>
                <div class="col-md-5 col-sm-5">
                  <h3><a href="/posts/{{$post->id}}">{{$post->crop_name}}</a></h3>
                  <h4 class="indexStrain">{{$post->strain}}</h4>
                  <small>Written on {{$post->created_at->format('M-jS-Y')}} by </small><span class="author">{{$post->user->name}}</span>
                </div>
                <div class="col-md-3 col-sm-3 image-cropper">
                  <img class="authorAvatar" src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$post->user->avatar}}">

                </div>
              </div>
            </a>

          </div>
        @endforeach

        {{$posts->links()}}

    @else
      <p>No posts found</p>
    @endif
  </div>
@endsection
