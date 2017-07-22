@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
      <img id="RGBlogo" src="../images/RGBlogo.png" alt="Root Grow Bloom logo">
      <hr>
      <h1 id="indexTitle">RGB Journal</h1>
      <p>Chronical your grow from seedling to harvest.<br/> View other grows and share comments and tips.</p>
      <p><a class="btn btn-primary btn-lg indexBtn" href="/login" role="button">Login</a> <a class="btn btn-primary btn-lg indexBtn" href="/register" role="button">Register </a></p>
  </div>
@endsection
