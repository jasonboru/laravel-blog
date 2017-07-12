@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
      <h1>{{$title}}</h1>
      <p>Chronical your grow from seedling to harvest. View other grows and share comments and tips.</p>
      <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a></p>
  </div>
@endsection
