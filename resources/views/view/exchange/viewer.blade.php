<div class="container">
    <h3 class="text-center my-4">Exchange {{$exchange->id}}</h3>
    <x-alert />
    <div class="row">
        <div class="col mr-2 border px-5 text-center">
            <h4>User's offer</h4>
            <div class="row">
                <div class="col">
                    <label>{{$exchange->first_user->name}}</label>
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
            <span>{{$exchange->first_movie->title}}<span>{{$exchange->first_movie->rating}}
                <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                </svg>
              </span>
            </span>
                </div>
            </div>
        </div>
        <div class=" col ml-2 border">
            <form action="/exchange/accept/" method="POST">
                @csrf
                <input type="hidden" value="{{$exchange->id}}" name="exchange_id">
                <h4 class="text-center">Your offer</h4>
                <div class="form-group my-2">
                    <label for="movie">Movie:</label>
                    <select class="livesearch form-control" name="movie_id"></select>
                </div>
                <div class="float-right">
                    <input type="submit" value="Exchange">
                    <input type="submit" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</div>
