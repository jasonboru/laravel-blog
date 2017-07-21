@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3>Your Grow Posts</h3>
                    @if(count($posts) > 0)
                    <table class="table table-striped">
                      <tr>
                        <th>Grows</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      @foreach($posts as $post)
                        <tr>
                          <td width="20%"><img style="width:100%" src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$post->cover_image}}"></td>
                          <td><a href="/posts/{{$post->id}}">{{$post->crop_name}}</a> - {{$post->strain}}</td>
                          <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit Post</a></td>
                          <td>
                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right bbDelete'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete Post', ['class' => 'btn btn-danger bbDelete'])}}
                            {!!Form::close()!!}
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  @else
                    <p>You have no posts</p>
                  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
