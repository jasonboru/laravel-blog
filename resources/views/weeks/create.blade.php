@extends('layouts.app')

@section('content')
  <h1>Create New Week</h1>

  {!! Form::open(['action' => 'WeeksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{Form::label('week_num', 'Week Number')}}
      {{Form::text('week_num', '', ['class' => 'form-control', 'placeholder' => 'Week Number'])}}
    </div>
    <div class="form-group">
      {{Form::label('nutrient', 'Nutrient Brand/Type')}}
      {{Form::text('nutrient', '', ['class' => 'form-control', 'placeholder' => 'Nutrient Brand/Type'])}}
    </div>
    <div class="form-group">
      {{Form::label('dosage', 'Dosage Rate')}}
      {{Form::text('dosage', '', ['class' => 'form-control', 'placeholder' => 'Dosage Rate'])}}
    </div>
    <div class="form-group">
      {{Form::label('temperature', 'Average Temperature')}}
      {{Form::text('temperature', '', ['class' => 'form-control', 'placeholder' => 'Average Temperature'])}}
    </div>
    <div class="form-group">
      {{Form::label('humidity', 'Average Humidity')}}
      {{Form::text('humidity', '', ['class' => 'form-control', 'placeholder' => 'Average Humidity'])}}
    </div>
    <div class="form-group">
      {{Form::label('notes', 'Notes')}}
      {{Form::textarea('notes', '', ['class' => 'form-control', 'placeholder' => 'Notes'])}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection
