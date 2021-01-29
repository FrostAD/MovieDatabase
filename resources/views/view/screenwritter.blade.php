@extends('layouts.master')
@section('body')
    <div class="container mt-3 p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="{{asset('storage/'. $screenwritter->image)}}" alt="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{$screenwritter->name}}
                    </h5>
                    <p class="small">Actor</p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                               aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="screenwritter_movies" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                               aria-selected="false">Movies</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$screenwritter->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Born</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$screenwritter->born_place}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Date</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$screenwritter->born_date->format('m/d/Y')}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Biography</label>
                                        <p>{{$screenwritter->description}}</p>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group">
                                    @foreach($movies as $movie)
                                        <li class="list-group-item"><a href="/movie/{{$movie->id}}">{{$movie->title}}</a>  -   {{$movie->rating}}</li>
                                    @endforeach
                                </ul>
                                {!! $movies->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
