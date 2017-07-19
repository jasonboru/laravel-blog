@extends('layouts.app')

@section('content')
  <a href="/posts/{{$week->post_id}}" class="btn btn-lg btn-primary goBack">Go Back</a>

  <div class='overlay'>

    <div class="row">
      <div class="col-sm-6">
        <h1><h1>Week # {{$week->week_num}}</h1></h1>
      </div>
      <div class="col-sm-6">
        <small class="pull-right">Written on {{$week->created_at->format('m-d-Y')}}</small>
      </div>

    </div>



    <div class="row">
      <div class="col-md-6 col-sm-6">
        <a href="https://s3.amazonaws.com/final-project-growshow/uploads/{{$week->week_image}}" data-lightbox="{{$week->week_image}}" data-title="Week # {{$week->week_num}}">
          <img class="weekImg" style="width:100%" src="https://s3.amazonaws.com/final-project-growshow/uploads/{{$week->week_image}}">
        </a>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="well">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3 class="weekCatHeading">Nutrient:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div> <h3 class="weekInputHeading weekInputResult">{{$week->nutrient}}</h3></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3 class="weekCatHeading">Dosage:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div> <h3 class="weekInputHeading weekInputResult">{{$week->dosage}}</h3></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3 class="weekCatHeading">Additives:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div> <h3 class="weekInputHeading weekInputResult">{{$week->additives}}</h3></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3 class="weekCatHeading">Nutrient Strength:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div> <h3 class="weekInputHeading weekInputResult">{{$week->tds}}</h3></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3 class="weekCatHeading">pH level:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div> <h3 class="weekInputHeading weekInputResult">{{$week->ph}}</h3></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3 class="weekCatHeading">Avgerage Temperature:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div> <h3 class="weekInputHeading weekInputResult">{{$week->temperature}}&#8457</h3></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4">
              <h3 class="weekCatHeading">Avgerage Humidity:</h3>
            </div>
            <div class="col-md-8 col-sm-8">
              <div> <h3 class="weekInputHeading weekInputResult">{{$week->humidity}}%</h3></div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <br><br>

    <h2>Notes</h2>
    <div class="well">
      <span class="weekNotes">{!!$week->notes!!}</span>
    </div>

    <hr>


    @if(!Auth::guest())
      {{--  @if (Auth::user()->id == $post->user_id) --}}
          <a href="/weeks/{{$week->id}}/edit?post={{ $week->post_id }}" class="btn btn-default">Edit Week</a>

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
      </div>
    </div>


        <div class="row">
          <div id="weekcomment-form" class="col-md-8 col-md-offset-2">
            <h2>Add a new Comment</h2>
            @if(!Auth::guest())
              {{ Form::open(['route' => ['weekcomments.store', $week->id], 'method' => 'POST']) }}
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
             <h4>You need to be logged into your account to leave a comment. If you do not have an account you can <a href="/register">Register Here</a>.</h4>
           @endif
          </div>
    </div>
  </div>

@endsection
