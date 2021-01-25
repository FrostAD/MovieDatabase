@extends('layouts.master')
@section('body')
    <div class="container">
        <div class="row mt-5">
            <div class="current-movie col-8">
                <h3>{{$movie->title}}</h3>
                <ul class="movie-info">
                    <li class="movie-year">{{$movie->published}}</li>
                    <li class="movie-time">{{$movie->timespan}}</li>
                    <li class="movie-genre">
                        @foreach($movie->genres as $genre)
                            {{$genre->name . ', '}}
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-3">
                <h4 class="float-right">
                    Our Rating:{{$movie->rating}} <span><svg width="16" viewBox="0 0 16 16" class="bi bi-star"
                                                             fill="currentColor"
                                                             xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
              </svg>
            </span>
                </h4>
                <h6 class="float-right">
                    IMBD Rating:{{$movie->rating_imbd}} <span><svg width="16" viewBox="0 0 16 16" class="bi bi-star"
                                                                   fill="currentColor"
                                                                   xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
            </svg>
          </span>
                </h6>

            </div>
            <div class="col-1">Share!</div>
        </div>
        <div class="row" style="max-height: 350px; overflow: hidden;">
            <div class="img-current-movie" style="max-width: 200px; overflow: hidden;">
                <img src="{{asset('storage/' . $movie->poster)}}"/>
            </div>
            <div class="trailer-current-movie ml-auto" style="width: 800px;">
                {{-- <img src="https://picsum.photos/1000" /> --}}
                {{-- <video src="{{asset($movie->trailer)}}" controls> --}}
                <iframe width="420" height="315"
                        src="{{$url}}">
                </iframe>
            </div>
        </div>
        <div class="row description my-3 p-3 rounded">
            <p>{{$movie->description}}</p>
        </div>
        <div class="row">
            <div class="col-6 row">
                <div id="scrollable-menu" class="container">
                    <h3>People also watch this:</h3>
                    <div id="img-holder-action" class="row">
                    </div>
                </div>
            </div>
            
            <div class="col-6 m-auto">
                <p>Some events (work in progress)</p>
            </div>
        </div>
        <!-- Published by -->
        <div class="published-by my-5">
            <h3>Published by</h3>
            <img src="/img/unknown-user.png" alt="unknown-user" class="h-100 ml-3">
            <p>{{$user}}, user rating</p>
        </div>
        {{-- Rating --}}
        <div class="container d-flex justify-content-center mt-200">
            <div class="row">
                <div class="col-md-12">
                    <div class="stars">
                        <form action="/movie/rate/" method="POST">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}"/>
                            @for($i = 5;$i >= 1;$i--)
                                @if($i == $movie->userAverageRating)
                                    <input class="star star-{{$i}}" id="star-{{$i}}" type="radio" name="star"
                                           value="{{$i}}" checked/> <label class="star star-{{$i}}"
                                                                           for="star-{{$i}}"></label>
                                @else
                                    <input class="star star-{{$i}}" id="star-{{$i}}" type="radio" name="star"
                                           value="{{$i}}"/> <label class="star star-{{$i}}" for="star-{{$i}}"></label>
                                @endif
                            @endfor
                            {{-- <input class="star star-5" id="star-5" type="radio" name="star" value="5"/> <label class="star star-5" for="star-5"></label> <input class="star star-4" id="star-4" type="radio" name="star" value="4"/> <label class="star star-4" for="star-4"></label> <input class="star star-3" id="star-3" type="radio" name="star" value="3" checked/> <label class="star star-3" for="star-3"></label> <input class="star star-2" id="star-2" type="radio" name="star" value="2"/> <label class="star star-2" for="star-2"></label> <input class="star star-1" id="star-1" type="radio" name="star" value="1"/> <label class="star star-1" for="star-1"></label>  --}}
                            <button>Rate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Comments  WORK IN PROGRESS-->
        <div class="container">
            <div class="row justify-content-center">
                <div class="bg-light p-2">
                    <form method="post" action="{{ route('reply.add') }}">
                        @csrf
                        <div class="d-flex flex-row align-items-start"><img src="./img/unknown-user.png"
                                                                            width="40"><textarea
                                class="form-control ml-1 shadow-none textarea" name="comment"></textarea>
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}"/></div>
                        <div class="mt-2 text-right">
                            <button class="btn-primary btn-sm" type="button"> Post</button>
                            <button class="btn-outline-primary btn-sm ml-1" type="button">Cancel</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12" id="table_data">
                    <div class="card">
                        <div class="card-body">
                            <h5>Display Comments</h5>

                            @include('partials.custom_replies')

                            <hr/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- new comments --}}
    @auth
        <h3>{{auth()->user()->getRoleNames()}} (2) (IN PROGRESS)</h3>

    @endauth
    {{-- Dont refresh the page after posting comment but doesnt show the new comment --}}


@endsection
