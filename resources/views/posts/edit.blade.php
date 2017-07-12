@extends('layouts.app')

@section('content')
  <h1>Edit Post</h1>

  {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{Form::label('crop_name', 'Crop Name')}}
      {{Form::text('crop_name', $post->crop_name, ['class' => 'form-control', 'placeholder' => 'Crop Name'])}}
    </div>
    <div class="form-group">
      {{Form::label('strain', 'Strain')}}
      {{Form::text('strain', $post->strain, ['class' => 'form-control', 'placeholder' => 'Strain'])}}
    </div>
    <div class="form-group">
      {{Form::label('body', 'Body')}}
      {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
      {{Form::file('cover_image')}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection
