@extends('layouts.master')
@section('body')
    <section id="section-recently-added" class="container">
        <h3 class="mt-3 mb-4">Recently Added</h3>
        @if($last_movie)
            <div class="row text-center">
                <div class="col-md-6">
                    <a href="movie/{{$last_movie->id}}">
                        <img src="{{'storage/'. $last_movie->poster}}" alt="Recently added movie"/>
                    </a>
                </div>
                <div id="info-recently-added" class="col-md-6 scrollbar-hidden">
                    <h3>{{$last_movie->title}}</h3>
                    <p>
                        {{$last_movie->description}}
                    </p>
                </div>
            </div>
        @endif
    </section>

    <!-- Section-2: Scrollable Menu -->
    <div id="scrollable-menu" class="container">
        <h3>Action Movies</h3>
        <div id="img-holder-action" class="row slider">
            @if($movies_action)
                @foreach($movies_action as $movie_action)
                    {{--                <div class='col-4 my-img'><img  src="{{asset('storage/'.$movie_action->poster)}}"></div>--}}
                    <div class='col-4 my-img'><img src="{{asset('storage/'.$movie_action->poster)}}" width="170px">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div id="scrollable-menu" class="container">
        <h3>Drama Movies</h3>
        <div id="img-holder-comedy" class="row slider">
            @if($movies_drama)
                @foreach($movies_drama as $movie_drama)
                    <div class='col-4 my-img'><img src="{{asset('storage/'.$movie_drama->poster)}}" width="170px"></div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
