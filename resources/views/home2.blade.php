@extends('layouts.master')
@section('body')
<div class="container">
    <section id="section-recently-added">
        <h3 class="my-3">Recently Added</h3>
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
    <h3>Action Movies</h3>
    <div class="selector-page scrollbar-hidden">
      <ul>
        @if($movies_action)
                @foreach($movies_action as $movie_action)
                   <li><a href="#"><img src="{{asset('storage/'.$movie_action->poster)}}" width="170px"></a></li>
                @endforeach
            @endif
      </ul>
    </div>
    <h3>Drama Movies</h3>
    <div class="selector-page scrollbar-hidden">
      <ul>
        @if($movies_drama)
                @foreach($movies_drama as $movie_drama)
                   <li><a href="#"><img src="{{asset('storage/'.$movie_drama->poster)}}" width="170px"></a></li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
@endsection
