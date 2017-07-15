@extends('layouts.app')

@section('content')
  <h1>Edit this Week</h1>

  {!! Form::open(['action' => ['WeeksController@update', $week->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{Form::label('week_num', 'Week Number')}}
      {{Form::text('week_num', $week->week_num, ['class' => 'form-control', 'placeholder' => 'Week Number'])}}
    </div>
    <div class="form-group">
      {{Form::label('nutrient', 'Nutrient Brand/Type')}}
      {{Form::text('nutrient', $week->nutrient, ['class' => 'form-control', 'placeholder' => 'Nutrient Brand/Type'])}}
    </div>
    <div class="form-group">
      {{Form::label('dosage', 'Dosage Rate')}}
      {{Form::text('dosage', $week->dosage, ['class' => 'form-control', 'placeholder' => 'Dosage Rate'])}}
    </div>
    <div class="form-group">
      {{Form::label('additives', 'Additives')}}
      {{Form::text('additives', $week->additives, ['class' => 'form-control', 'placeholder' => 'Additives'])}}
    </div>
    <div class="form-group">
      {{Form::label('Nutrient Strength', 'Nutrient Strength')}}
      {{Form::text('tds', $week->tds, ['class' => 'form-control', 'placeholder' => 'Nutrient Strength'])}}
    </div>
    <div class="form-group">
      {{Form::label('pH Level', 'pH Level')}}
      {{Form::text('ph', $week->ph, ['class' => 'form-control', 'placeholder' => 'pH Level'])}}
    </div>
    <div class="form-group">
      {{Form::label('temperature', 'Average Temperature')}}
      {{Form::text('temperature', $week->temperature, ['class' => 'form-control', 'placeholder' => 'Average Temperature'])}}
    </div>
    <div class="form-group">
      {{Form::label('humidity', 'Average Humidity')}}
      {{Form::text('humidity', $week->humidity, ['class' => 'form-control', 'placeholder' => 'Average Humidity'])}}
    </div>
    <div class="form-group">
      {{Form::label('notes', 'Notes')}}
      {{Form::textarea('notes', $week->notes, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Notes'])}}
    </div>
    <div class="form-group">
      {{Form::file('week_image')}}
    </div>
    {{Form::hidden('post_id', $post)}}
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection
