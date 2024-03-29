<div class="container">
    <h3 class="text-center my-4">Exchange #{{$exchange->id}}</h3>
    <x-alert/>
    <div class="row">
        <div class="col mr-2 border px-5 text-center">
            <h4>User offer</h4>
            <div class="row">
                <div class="col">
                    <label><a href="/account/{{$exchange->user1_id}}">{{$exchange->first_user->name}}</a></label>
                </div>
                <div class="col">
            <span>{{$exchange->first_user->rating_exchange}}
              <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor"
                   xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
              </svg>
            </span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Offers</label>
                </div>
                <div class="col">
            <span><a href="/movie/{{$exchange->first_movie->id}}">{{$exchange->first_movie->title}}</a><span>{{$exchange->first_movie->rating}}
                <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                </svg>
              </span>
            </span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="movie-stars" id="form_rating_movie">
                    <form action="/exchange/rate/" method="POST">
                        @csrf
                        <input type="hidden" name="exchange_id" value="{{ $exchange->id }}"/>
                        <input type="hidden" name="num" value="1">
                        @for($i = 5;$i >= 1;$i--)
                            @if($i == $exchange->rating_for_first)
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
            @if($exchange->return1)
                <p>Status: Returned</p>
            @else
                <p>Status: Not Returned</p>
            @endif

        </div>
        <div class="col mr-2 border px-5 text-center">
            <h4>My offer</h4>
            <div class="row">
                <div class="col">
                    <label>{{$exchange->second_user->name}}</label>
                </div>
                <div class="col">
            <span>{{$exchange->second_user->rating_exchange}}
              <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor"
                   xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
              </svg>
            </span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Offers</label>
                </div>
                <div class="col">
            <span><a href="/movie/{{$exchange->second_movie->id}}">{{$exchange->second_movie->title}}</a><span>{{$exchange->second_movie->rating}}
                <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                </svg>
              </span>
            </span>
                </div>
            </div>

            @if(!$exchange->return2)
                <form action="/exchange/return" method="POST">
                    @csrf
                    <input type="hidden" value="{{$exchange->id}}" name="exchange_id">
                    <p>Status: Not returned</p>
                    <input type="submit" value="Return it">
                </form>
            @else
                <p>Status: Returned</p>
            @endif
        </div>
    </div>
</div>
