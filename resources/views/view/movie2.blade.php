@extends('layouts.master')
@section('body')
    <div class="container">
        <div class="row mt-5">
            <div class="current-movie col-md-8">
                <h3>{{$movie->title}}</h3>
                <ul class="movie-concise-info">
                    <li class="movie-year">{{$movie->published->format('m/d/Y')}}</li>
                    <li class="movie-time">{{$movie->timespan}}</li>
                    <li class="movie-genre">
                        @foreach($movie->genres as $genre)
                            {{$genre->name . ', '}}
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4 class="float-right">
                    <small>IMDB: {{$movie->rating_imbd}} </small><span><svg width="16" viewBox="0 0 16 20"
                                                                            class="bi bi-star" fill="currentColor"
                                                                            xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
            </svg>
          </span>
                    |
                    <small>OUR: {{round($movie->rating,2)}} </small><span><svg width="16" viewBox="0 0 16 20" class="bi bi-star"
                                                                      fill="currentColor"
                                                                      xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
            </svg>
          </span>
                </h4>
            </div>
            <!-- Share movie -->
            <div class="col-md-1 d-flex">
                <a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="d-flex my-auto pl-3">
                @auth
                    @if(auth()->user()->watchlist->contains($movie))
                        <form action="/movie/watchlist_remove" method="POST">
                            @csrf
                            <input type="hidden" value="{{$movie->id}}" name="movie_id">
                            <button type="submit" class="btn btn-danger btn-sm mr-2" title="Remove from watchlist">
                                Watchlist
                            </button>
                        </form>
                    @else
                        <form action="/movie/watchlist_add" method="POST">
                            @csrf
                            <input type="hidden" value="{{$movie->id}}" name="movie_id">
                            <button type="submit" class="btn btn-success btn-sm mr-2" title="Add to watchlist">
                                Watchlist
                            </button>
                        </form>
                    @endif
                    @if(auth()->user()->wishlist->contains($movie))
                        <form action="/movie/wishlist_remove" method="POST">
                            @csrf
                            <input type="hidden" value="{{$movie->id}}" name="movie_id">
                            <button type="submit" class="btn btn-danger btn-sm" title="Remove from wishlist">Wishlist
                            </button>
                        </form>
                    @else
                        <form action="/movie/wishlist_add" method="POST">
                            @csrf
                            <input type="hidden" value="{{$movie->id}}" name="movie_id">
                            <button type="submit" class="btn btn-success btn-sm" title="Add to wishlist">Wishlist
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
            <div class="movie-stars d-flex ml-auto" id="form_rating_movie">
                <h5 class="my-auto">Rate this movie: </h5>
                <form action="/movie/rate/" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}"/>
                    @for($i = 5;$i >= 1;$i--)
                        @if($i == $movie->userAverageRating)
                            <input id="star-{{$i}}-movie" type="radio" name="star"
                                   value="{{$i}}" checked/> <label for="star-{{$i}}-movie"></label>
                        @else
                            <input id="star-{{$i}}-movie" type="radio" name="star"
                                   value="{{$i}}" onchange="this.form.submit()"/> <label
                                for="star-{{$i}}-movie"></label>
                        @endif
                    @endfor
                </form>
            </div>
        </div>
        <div class="row h-100" style="overflow: hidden;">
            <div class="col-md-3 img-current-movie" style="">
                <img style="min-width: 100%" src="{{asset('storage/' . $movie->poster)}}"/>
            </div>
            <div class="col-md-9 trailer-current-movie ml-auto" style="">
                <iframe class="h-100 w-100" frameBorder="0" src="{{$url}}"></iframe>
            </div>
        </div>
        <div class="row description my-3 p-3">
            <p>{{$movie->description}}</p>
        </div>
        {{--        TODO show every type of person--}}
        {{--        Example--}}


    {{--        end example--}}
    <!-- Actors -->
            <div class="row actors-menu">
              <div class="col-md-4 actors-name scrollbar-hidden">
                <ul class="list-group actors-menu">
                  <li class="text-center list-group-item text-uppercase font-weight-bold">Actors</li>
                  @foreach($movie->actors as $actor)
                      <li>
                          <a class="list-group-item list-group-item-action" data-toggle="list"
                              href="#actor{{$actor->id}}">{{$actor->name}}</a>
                      </li>
                  @endforeach
                  <li class="text-center list-group-item text-uppercase font-weight-bold">Producers</li>
                  @foreach($movie->producers as $producer)
                    <li>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                          href="#producer{{$producer->id}}">{{$producer->name}}</a>
                    </li>
                  @endforeach
                  <li class="text-center list-group-item text-uppercase font-weight-bold">Musicians</li>
                  @foreach($movie->musicians as $musician)
                  <li>
                      <a class="list-group-item list-group-item-action" data-toggle="list"
                         href="#musician{{$musician->id}}">{{$musician->name}}</a>
                  </li>
                  @endforeach
                  <li class="text-center list-group-item text-uppercase font-weight-bold">Screenwriters</li>
                  @foreach($movie->screenwritters as $screenwritter)
                      <li>
                          <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#screenwritter{{$screenwritter->id}}">{{$screenwritter->name}}</a>
                      </li>
                  @endforeach
                  <li class="text-center list-group-item text-uppercase font-weight-bold">Studios</li>
                  @foreach($movie->studios as $studio)
                      <li>
                          <a class="disabled list-group-item list-group-item-action" data-toggle="list"
                            href="#studio{{$studio->id}}">{{$studio->name}}</a>
                      </li>
                  @endforeach
                </ul>
            </div>

            <div class="col-md-8 tab-content scrollbar-hidden">
                @foreach($movie->actors as $actor)
                    @if ($loop->first)
                        <div class="tab-pane fade show active" id="actor{{$actor->id}}">
                            <div class="float-left" style="height: 250px;">
                                <a href="/actor/{{$actor->id}}">
                                    <img class="h-100" src="{{asset('storage/'.$actor->image)}}" width="150px"
                                         style="float: left;"
                                         alt="">
                                </a>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                </div>
                                <div class="col">
                                    <p>{{$actor->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Born</label>
                                </div>
                                <div class="col">
                                    <p>{{$actor->born_place}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Year</label>
                                </div>
                                <div class="col">
                                    <p>{{$actor->born_date->format('m/d/Y')}}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="tab-pane fade h-100" id="actor{{$actor->id}}">
                        <a href="/actor/{{$actor->id}}">
                            <img class="h-100" src="{{asset('storage/'.$actor->image)}}" width="150"
                                 style="float: left;">
                        </a>
                        <div class="row">
                            <div class="col">
                                <label>Name</label>
                            </div>
                            <div class="col">
                                <p>{{$actor->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Born</label>
                            </div>
                            <div class="col">
                                <p>{{$actor->born_place}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Year</label>
                            </div>
                            <div class="col">
                                <p>{{$actor->born_date->format('m/d/Y')}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($movie->producers as $producer)
                        <div class="tab-pane fade h-100" id="producer{{$producer->id}}">
                            <a href="/producer/{{$producer->id}}">
                                <img class="h-100" src="{{asset('storage/'.$producer->image)}}" width="150"
                                     style="float: left;">
                            </a>
                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                </div>
                                <div class="col">
                                    <p>{{$producer->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Born</label>
                                </div>
                                <div class="col">
                                    <p>{{$producer->born_place}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Year</label>
                                </div>
                                <div class="col">
                                    <p>{{$producer->born_date->format('m/d/Y')}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach($movie->musicians as $musician)
                        <div class="tab-pane fade h-100" id="musician{{$musician->id}}">
                            <a href="/musician/{{$musician->id}}">
                                <img class="h-100" src="{{asset('storage/'.$musician->image)}}" width="150"
                                     style="float: left;">
                            </a>
                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                </div>
                                <div class="col">
                                    <p>{{$musician->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Born</label>
                                </div>
                                <div class="col">
                                    <p>{{$musician->born_place}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Year</label>
                                </div>
                                <div class="col">
                                    <p>{{$musician->born_date->format('m/d/Y')}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach($movie->screenwritters as $screenwritter)
                        <div class="tab-pane fade h-100" id="screenwritter{{$screenwritter->id}}">
                            <a href="/screenwritter/{{$screenwritter->id}}">
                                <img class="h-100" src="{{asset('storage/'.$screenwritter->image)}}" width="150"
                                     style="float: left;">
                            </a>
                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                </div>
                                <div class="col">
                                    <p>{{$screenwritter->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Born</label>
                                </div>
                                <div class="col">
                                    <p>{{$screenwritter->born_place}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Year</label>
                                </div>
                                <div class="col">
                                    <p>{{$screenwritter->born_date->format('m/d/Y')}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
        <!-- End Actors -->
        <!-- Post Raiting -->
        <div class="row">
            <div class="post-stars d-flex mx-auto">
                <h5 class="my-auto">Rate this post: </h5>
                <form action="/movie/rate/post" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}"/>
                    @for($i = 5;$i >= 1;$i--)
                        @if($i == $post->rating)
                            <input id="star-{{$i}}-post" type="radio" name="star"
                                   value="{{$i}}" checked/> <label for="star-{{$i}}-post"></label>
                        @else
                            <input id="star-{{$i}}-post" type="radio" name="star"
                                   value="{{$i}}" onchange="this.form.submit()"/> <label for="star-{{$i}}-post"></label>
                        @endif
                    @endfor
                </form>
            </div>
        </div>
        <!-- Published by -->
        <div class="row text-center justify-content-center d-block">
            <h3>Publisher <a href="/account/{{$movie->user->id}}">{{$movie->user->name}} </a>{{$movie->user->rating_post}}<span>
              <svg width="22" viewBox="0 0 16 22"
              class="bi bi-star" fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
              d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
              </svg>
              </span>
            </h3>
            <img src="{{asset('storage/avatars/'.$movie->user->avatar)}}" class="mb-3" style="max-height: 40vh" alt="author_image">
                {{-- <h4>{{$movie->user->name . ", " . $movie->user->rating_post}}</h4> --}}
        </div>
        <!-- People also watch -->
        <div class="row">
            <div class="col-6">
                <h3>People also watch</h3>
                <div class="selector-page scrollbar-hidden">
                    <ul>
                        @foreach($recommended as $m)
                            <li><a href=""><img src="{{asset('storage/'.$m->poster)}}" alt=""></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-6">
              <h3>Events</h3>
                <ul id="events-for-movie" class="list-group scrollbar-hidden">
                    @foreach($events as $event)
                        <li class="list-group-item"><a href="/event/{{$event->id}}">{{$event->name}}</a></li>
                    @endforeach
                    {{$events->links()}}
                </ul>
            </div>
        </div>
        <div class="row mb-3 justify-content-center bold text-center">
          <div class="col-md-4 card border-0">
            <div class="card-body">
              <div class="card-title h5">Available exchanges</div>
            </div>
            <p class="h4"><a href="/exchanges/{{$movie->id}}">{{$exchanges}}</a></p>
          </div>
          <div class="col-md-4 card border-0">
            <div class="card-body">
              <div class="card-title h5">In Wishlist</div>
            </div>
            <p class="h4">{{$movie->wishlist_users()->count()}}</p>
          </div>
          <div class="col-md-4 card border-0">
            <div class="card-body">
              <div class="card-title h5">In Watchlist</div>
            </div>
            <p class="h4">{{$movie->watchlist_users()->count()}}</p>
          </div>
        </div>

        <!-- Add Comment -->
        <form action="/comment/store" method="POST">
            @csrf
            <div id="add-comment" class="form-group">
                <input type="hidden" value="{{$movie->id}}" name="movie_id">
                <textarea class="form-control" rows="5" placeholder="Write your comment..."
                          name="description"></textarea>
            </div>
            <div class="mt-2 text-right">
                <button class="btn-primary btn" type="submit"> Post comment</button>
            </div>
        </form>

        <div id="table_data">
            <h5>Display Comments</h5>

            @include('partials.custom_replies')
        </div>
    </div>
    {{-- Dont refresh the page after posting comment but doesnt show the new comment --}}


@endsection
