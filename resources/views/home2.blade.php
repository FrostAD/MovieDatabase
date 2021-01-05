@extends('layouts.master')
@section('body')
    <section id="section-recently-added" class="container">
        <h3 class="mt-3">Recently Added</h3>
        <div class="row text-center">
            <div class="col">
                <a href="movie/{{$last_movie->id}}">
{{--                    <img src="{{'storage/'. $last_movie->poster}}" alt="Recently added movie" />--}}
                    <img src="https://source.unsplash.com/random" style="max-height: 300px" alt="Recently added movie" />
                </a>
            </div>
            <div id="info-recently-added" class="col">
                <h3>{{$last_movie->title}}</h3>
                <p>
                    {{$last_movie->description}}
                </p>
            </div>
        </div>
    </section>

    <!-- Section-2: Scrollable Menu -->
    <div id="scrollable-menu" class="container">
        <h3>Action Movies</h3>
        <div id="img-holder-action" class="row slider">
        @foreach($movies_action as $movie_action)
{{--                <div class='col-4 my-img'><img  src="{{asset('storage/'.$movie_action->poster)}}"></div>--}}
                <div class='col-4 my-img'><img  src="{{asset('storage/'.$movie_action->poster)}}" width="170px"></div>
        @endforeach

        </div>
    </div>
    <div id="scrollable-menu" class="container">
        <h3>Drama Movies</h3>
        <div id="img-holder-comedy" class="row slider">
        @foreach($movies_drama as $movie_drama)
            <div class='col-4 my-img'><img  src="{{asset('storage/'.$movie_drama->poster)}}" width="170px"></div>
        @endforeach
        </div>
    </div>
@endsection
