@extends('layouts.app')

@section('content')
  <a href="/posts/{{$week->post_id}}" class="btn btn-default">Go Back</a>

  <h1>Week # {{$week->week_num}}</h1>

  <div class="row">
    <div class="col-md-6 col-sm-6">
      <a href="/storage/week_images/{{$week->week_image}}" data-lightbox="{{$week->week_image}}" data-title="Week # {{$week->week_num}}">
        <img style="width:100%" src="/storage/week_images/{{$week->week_image}}">
      </a>
    </div>
    <div class="col-md-6 col-sm-6">
      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Nutrient:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$week->nutrient}}</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Dosage:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$week->dosage}}</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Additives:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$week->additives}}</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Nutrient Strength:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$week->tds}}</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>pH level:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$week->ph}}</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Avgerage Temperature:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$week->temperature}}</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <h4>Avgerage Humidity:</h4>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="well"> {{$week->humidity}}</div>
        </div>
      </div>

    </div>
  </div>

  <br><br>

  <h2>Notes</h2>
  <div class="well">
    {!!$week->notes!!}
  </div>

  <hr>

  <small>Written on {{$week->created_at}}</small>
  <hr>


  @if(!Auth::guest())
    {{--  @if (Auth::user()->id == $post->user_id) --}}
        <a href="/weeks/{{$week->id}}/edit?post={{ $week->post_id }}" class="btn btn-default">Edit</a>

        {!!Form::open(['action' => ['WeeksController@destroy', $week->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    {{--  @endif --}}
  @endif

  <div class="row">

    <div class="col-md-8 col-md-offset-2">
      <h2>Comments</h2>
      @foreach($week->weekcomments as $comment)
        <div class="panel panel-default comment">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-9">
                Comment by: {{ $comment->name }}
              </div>
              <div class="col-md-3">
                <small> {{ $comment->created_at }} </small>
              </div>
            </div>
          </div>
          <div class="panel-body">{{ $comment->comment }}</div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="row">
    <div id="weekcomment-form" class="col-md-8 col-md-offset-2">
      <h2>Add a new Comment</h2>
      {{ Form::open(['route' => ['weekcomments.store', $week->id], 'method' => 'POST']) }}
        <div class="row">

          <div class="col-md-6">
            {{ Form::label('name', "Name:") }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
          </div>

          <div class="col-md-6">
            {{ Form::label('email', "Email:") }}
            {{ Form::text('email', null, ['class' => 'form-control']) }}
          </div>

          <div class="col-md-12">
            {{ Form::label('comment', "Comment:") }}
            {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

            {{ Form::submit('Add Comment', ['class' => 'btn-success btn-block', 'style' => 'margin:15px 0;']) }}
          </div>

        </div>

      {{ Form::close()}}
    </div>
  </div>

@endsection
