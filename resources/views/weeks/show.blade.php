@extends('layouts.app')

@section('content')

  <h1>Week # {{$week->week_num}}</h1>

  <div class="row">
    <div class="col-md-6 col-sm-6">
      <img style="width:100%" src="/storage/week_images/{{$week->week_image}}">
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
        <a href="/weeks/{{$week->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action' => ['WeeksController@destroy', $week->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    {{--  @endif --}}
  @endif

@endsection
