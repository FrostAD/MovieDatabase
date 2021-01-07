@extends('layouts.master')

@section('body')
    <div class="container">
        <div class="row mt-5">
            <div class="current-event col-8">
                <h3 class="ml-md-5">{{$event->name}}</h3>
            </div>
            <div class="col-3">
                <h4 class="status-event float-right">
                    Status:
                    <!-- Class active has to be only on one of them -->
                    <!-- if user is signed for the event -> fa-check -->
                    <!-- if user isn't signed for the event -> fa-times -->
                    <a href="">
                        @if($event->users->contains(App\Models\User::find(\Illuminate\Support\Facades\Auth::id()))||$event->user->id == \Illuminate\Support\Facades\Auth::id())
                            <i class="fa fa-check active" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-times " aria-hidden="true"></i>
                        @endif
                    </a>
                </h4>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-4">
                <div id="movie-card" class="card">
                    <img src="{{asset('storage/'. $movie->poster)}}" style="height: 40vh" alt="Event's movie poster">
                    <div class="p-3">
                        <h3 class="card-title">{{$movie->title}}</h3>
                        <ul class="movie-concise-info">
                            <li class="movie-year">{{$movie->published}}</li>
                            <li class="movie-time">{{$movie->timespan}}</li>
                            <li class="movie-genre">
                                @foreach($movie->genres as $genre)
                                    {{$genre->name . ', '}}
                                @endforeach
                            </li>
                        </ul>
                        <p id="movie-card-description" class="scrollbar-hidden">{{$movie->description}}</p>
                        {{--                    TODO show trailer--}}
                        <div class="watch-btn">
                                               <a href="https://www.youtube.com/"><button type="button" class="btn btn-primary"><i
                                                           class="fa fa-play mr-2"></i>WATCH TRAILER</button>
                                               </a>
                                           </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row h4 text-center">
                    <div class="col-md-6">Date:<br/> <span id="event-date"
                                                           class="font-weight-bold">{{$event->date}}</span>
                    </div>
                    <div class="col-md-6">Where: <br/> <span id="event-location"
                                                             class="font-weight-bold">{{$event->location}}</span>
                    </div>
                </div>
                <div class="row">
                    <p id="event-description" class="scrollbar-hidden">{{$event->description}}</p>
                </div>
                @guest
                    <div class="row d-flex flex-column justify-content-end">
                        <p>Please login to be able to sign in for this event.</p>
                        <form action="/login">
                            <input type="submit" value="Login">
                        </form>
                    </div>
                @endguest
                @auth
                    @if($event->current_cappacity == $event->capacity)
                        <div class="row d-flex flex-column justify-content-end"><p>No available places</p></div>
                    @else
                        <div class="row d-flex flex-column justify-content-end">
                            <form action="/event/join" method="POST">
                                @csrf
                                <input type="hidden" value="{{$event->id}}" name="event_id">
                                @if($event->users->contains(\Illuminate\Support\Facades\Auth::user()->id) || $event->user->id == \Illuminate\Support\Facades\Auth::id())
                                    <input type="hidden" value="q" name="type">
                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $event->user_id)
{{--                                        <input type="submit" value="Cancel event">--}}
                                        <button class="btn btn-primary position-absolute" type="submit" style="bottom: 0; right: 0;">Cancel event</button>
                                    @else
{{--                                        <input type="submit" value="Leave">--}}
                                        <button class="btn btn-primary position-absolute" type="submit" style="bottom: 0; right: 0;">Leave</button>
                                    @endif

                                @else
                                    <input type="hidden" value="e" name="type">
{{--                                    <input type="submit" value="Sign">--}}
                                    <button class="btn btn-primary position-absolute" type="submit" style="bottom: 0; right: 0;">Sign
                                        up</button>
                                @endif
                            </form>
                        </div>
                    @endif
                    {{--                    @if($event->user_id == \Illuminate\Support\Facades\Auth::user()->id)--}}
                    {{--                        //TODO make button cancel event here also--}}
                    {{--                            <form action="/event/cancel" method="POST">--}}
                    {{--                                @csrf--}}
                    {{--                                <input type="hidden" value="{{$event->id}}" name="event_id">--}}
                    {{--                                <input type="submit" value="Cancel event">--}}
                    {{--                            </form>--}}
                    {{--                    @endif--}}
                @endauth
                <div class="row d-flex flex-column justify-content-end">
                    <p>Current capacity: {{$event->current_cappacity}}/{{$event->capacity}}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
