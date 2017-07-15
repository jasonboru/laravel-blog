@extends('layouts.app')

@section('content')
  <h1>Create New Grow</h1>

  {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{Form::label('crop_name', 'Crop Name')}}
      {{Form::text('crop_name', '', ['class' => 'form-control', 'placeholder' => 'Crop Name'])}}
    </div>
    <div class="form-group">
      {{Form::label('strain', 'Strain')}}
      {{Form::text('strain', '', ['class' => 'form-control', 'placeholder' => 'Strain'])}}
    </div>
    <div class="form-inline">
      {{Form::select('method', ['Hydroponics - Hand Watered' => 'Hydroponics - Hand Watered',
                                'Hydroponics - Deep Water Culture' => 'Hydroponics - Deep Water Culture',
                                'Hydroponics - Ebb & Flow' => 'Hydroponics - Ebb & Flow',
                                'Hydroponics - Aeroponics' => 'Hydroponics - Aeroponics',
                                'Soil - Containers' => 'Soil - Containers',
                                'Soil - Raised Bed' => 'Soil - Raised Bed',], null, ['placeholder' => 'Pick a method...'])}}

      {{Form::select('location', ['Indoors' => 'Indoors',
                                'Greenhouse' => 'Greenhouse',
                                'Outdoors' => 'Outdoors',], null, ['placeholder' => 'Pick a location...'])}}

      {{Form::select('lighting', ['Natural Sunlight' => 'Natural Sunlight',
                                'High Intensity Discharge' => 'High Intensity Discharge',
                                'T5 HO Flourescent' => 'T5 HO Flourescent',
                                'LED - Light Emitting Diode' => 'LED - Light Emitting Diode',
                                'Other' => 'Other',], null, ['placeholder' => 'Pick your lighting...'])}}

    </div>
    <div class="form-group">
      {{Form::label('body', 'Body')}}
      {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
      {{Form::file('cover_image')}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection
