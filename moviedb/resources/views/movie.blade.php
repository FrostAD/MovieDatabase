<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://azlejs.com/v2/azle.min.js"></script>

  {{-- <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/custom-css/style.css" /> --}}
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{asset('css/custom-css/style.css')}}" />

  <title>Hello</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-5 pr-5 sticky-top">
    <a class="navbar-brand" href="/index.html">
      <h1>!MDb</h1>
    </a>
    <form class="d-flex ml-3">
      <input class="form-control w-auto" type="search" placeholder="Search" aria-label="Search" />

      <li class="nav-link dropdown p-0">
        <a class="nav-link" id="plusDropdown" role="button" data-toggle="dropdown">
          <svg color="white" width="32" viewBox="3 0 15 15" class="bi bi-plus" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
          </svg>
        </a>

        <div class="dropdown-menu" aria-labelledby="plusDropdown">
          <a class="dropdown-item" href="addMovie.html">Add Movie</a>
          <a class="dropdown-item" href="#">Add Actor</a>
          <a class="dropdown-item" href="#">Add Event</a>
          <a class="dropdown-item" href="#">Add Festival</a>
        </div>
      </li>
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#rightNavbarContent"
      aria-controls="rightNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="rightNavbarContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Movies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Events</a>
        </li>

        <li class="nav-item dropdown mr-5">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Your_name
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Your Publications</a>
            <a class="dropdown-item" href="#">Your Watchlist</a>
            <a class="dropdown-item" href="#">Your Wishlist</a>
            <a class="dropdown-item" href="#">Your Events</a>
            <a class="dropdown-item" href="#">Account Settings</a>
            <a class="dropdown-item" href="#">Sign In</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row mt-5">
      <div class="current-movie col-8">
        {{-- <h3>Title of the movie</h3> --}}
      <h3>{{$movie->title}}</h3>
        <ul class="movie-info">
          {{-- <li class="movie-year">2002</li> --}}
          <li class="movie-year">{{$movie->published_at}}</li>
          {{-- <li class="movie-time">1h 32min</li> --}}
        <li class="movie-time">{{$movie->timespan}}</li>
          {{-- <li class="movie-genre">Action Comedy</li> --}}
          <li class="movie-genre">{{$movie->genres}}</li>
        </ul>

      </div>
      <div class="col-3">
        <h3 class="float-right">
          Raiting: <span><svg width="16" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
            </svg>
          </span>
        </h3>
      </div>
      <div class="col-1">Share!</div>
    </div>
    <div class="row">
      <div class="col ml-auto">
      <img src="{{asset('/storage/images/' . $movie->poster)}}" style="max-width: 250px"/>
      </div>
      <div class="col">
        <img src="https://picsum.photos/600/350" />
      </div>
    </div>
    <div class="description my-3 p-3 rounded">
      {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam laborum, fuga distinctio deserunt eum quos
        asperiores consequuntur repellat odit magni cupiditate quis! Voluptatum facilis ipsum at repellat nihil mollitia
        in minima doloremque ratione tempore temporibus, voluptates quas earum delectus! Deserunt consequuntur,
        repellendus esse aspernatur sit eligendi, maiores pariatur et, commodi voluptate non aliquid voluptas illum?</p> --}}
        <p>{{$movie->description}}</p>
    </div>
    <div class="row">
      <div class="col-6">
        <div id="scrollable-menu" class="container">
          <h3>People also watch this:</h3>
          <div id="img-holder" class="row">
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
      <p>Username, user rating</p>
    </div>
    <!-- Comments -->
    <div class="row">
      <div class="page-header">
        <h1 class="text-center">2 Comments</h1>
      </div>
      <div class="comments-list">

        <div class="media">
          <p class="pull-right"><small>3 days ago</small></p>
          <a class="media-left" href="#">
            <img src="/img/unknown-user.png" alt="unknown-user" height="40">
          </a>
          <div class="media-body">

            <h4 class="media-heading user_name">User user</h4>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi quos aliquid voluptas fugiat sapiente
            ratione incidunt, debitis vero tempore vitae laudantium, maxime repellat totam quod!

            <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
          </div>
          <div class="media">
            <p class="pull-right"><small>5 days ago</small></p>
            <a class="media-left" href="#">
              <img src="/img/unknown-user.png" alt="unknown-user" height="40">
            </a>
            <div class="media-body">

              <h4 class="media-heading user_name">User user</h4>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil amet reprehenderit et maxime ipsam culpa
              vitae non aliquam at voluptatem, ipsa corporis alias, officiis sit facere dolorem eum earum! Modi ipsa
              quibusdam ad earum iure ea placeat molestias nesciunt doloremque, deserunt praesentium animi eos nemo esse
              ut itaque commodi soluta, id doloribus fuga iste repellendus!

              <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/custom-js/index.js"></script>
  </script>
</body>

</html>