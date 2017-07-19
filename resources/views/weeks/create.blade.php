@extends('layouts.app')

@section('content')
  <div class="overlay">
  <h1>Create New Week</h1>
  {{--<p>post {{ $post }}</p> --}}

  {!! Form::open(['action' => 'WeeksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="col-sm-4">
      <div class="form-group">
        {{Form::label('week_num', 'Week Number')}}
        {{Form::text('week_num', '', ['class' => 'form-control', 'placeholder' => 'Week Number'])}}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{Form::label('nutrient', 'Nutrient Brand/Type')}}
        {{Form::text('nutrient', '', ['class' => 'form-control', 'placeholder' => 'Nutrient Brand/Type'])}}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{Form::label('dosage', 'Dosage Rate')}}
        {{Form::text('dosage', '', ['class' => 'form-control', 'placeholder' => 'Dosage Rate'])}}
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        {{Form::label('additives', 'Additives')}}
        {{Form::text('additives', '', ['class' => 'form-control', 'placeholder' => 'Additives'])}}
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        {{Form::label('Nutrient Strength', 'Nutrient Strength')}}
        {{Form::text('tds', '', ['class' => 'form-control', 'placeholder' => 'Nutrient Strength'])}}
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        {{Form::label('pH Level', 'pH Level')}}
        {{Form::text('ph', '', ['class' => 'form-control', 'placeholder' => 'pH Level'])}}
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        {{Form::label('temperature', 'Average Temperature')}}
        {{Form::text('temperature', '', ['class' => 'form-control', 'placeholder' => 'Average Temperature'])}}
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        {{Form::label('humidity', 'Average Humidity')}}
        {{Form::text('humidity', '', ['class' => 'form-control', 'placeholder' => 'Average Humidity'])}}
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        {{Form::label('notes', 'Notes')}}
        {{Form::textarea('notes', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Notes'])}}
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        {{Form::file('week_image')}}
      </div>
    </div>
    {{Form::hidden('post_id', $post)}}
    {{Form::submit('Submit', ['class'=>'btn btn-lg btn-primary weekSubmit'])}}
  {!! Form::close() !!}

  </div>

@endsection
