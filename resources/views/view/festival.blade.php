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
@endsection
