@extends('layouts.master')

@section('body')
<div class="container mt-5 text-center">
  <h2>{{$festival->name}}</h2>
  <div class="row festival-info h4">
    <div class="col-md-4">Date:<br /> <span id="festival-date" class="font-weight-bold">{{$festival->date->format('m/d/Y')}}</span>
    </div>
    <div class="col-md-4">Where: <br /> <span id="festival-location" class="font-weight-bold">{{$festival->location}}</span>
    </div>
    <div class="col-md-4">From: <br /><span id="festival-from" class="font-weight-bold">{{$festival->founded}}</span></div>
  </div>
  <img class="current-festival-image" src="{{asset('storage/'. $festival->image)}}" width="100%" alt="Festival image" />
  <p class="festival-bio">{{$festival->description}}
  </p>
</div>
{{-- <div class="container">
    <div class="row mt-5">
      <div class="current-movie col-8">
      <h3>Name: {{$festival->name}}</h3>
        <ul class="movie-info">
        <li class="movie-year">Date: {{$festival->date}}</li>
        <li class="movie-time">Location: {{$festival->location}}</li>
        </ul>
      </div>

      <div class="col-1">Share!</div>
    </div>
    <div class="row" style="max-height: 350px; overflow: hidden;">
      <div class="img-current-movie" style="max-width: 666px; overflow: hidden;">
        <img src="{{asset('storage/' . $festival->image)}}" />
      </div> --}}
      {{-- <div class="trailer-current-movie ml-auto" style="width: 800px;">
        {{-- <img src="https://picsum.photos/1000" /> --}}
        {{-- <video src="{{asset($movie->trailer)}}" controls> --}}
          {{-- <iframe width="420" height="315"
src="">
</iframe>
      </div> --}}
    {{-- </div>
    <div class="row description my-3 p-3 rounded">
    <p>Description: {{$festival->description}}</p>
    </div> --}}
@endsection
