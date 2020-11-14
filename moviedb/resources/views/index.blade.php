<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://azlejs.com/v2/azle.min.js"></script>

  {{-- <link rel="stylesheet" href="/css/bootstrap.css" /> --}}
  {{-- <link rel="stylesheet" href="/css/custom-css/style.css" /> --}}

  {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}"/>     --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/custom-css/style.css')}}"/>     --}}

  <title>Hello</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-5 pr-5 sticky-top">
    <a class="navbar-brand" href="index.html">
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

  <section id="section-recently-added" class="container">
    <div class="row">
      <h3>Recently Added</h3>
      <div class="col-6">
        <a href="/movie.html">

          <img src="https://picsum.photos/250/350" alt="Recently added movie" />
        </a>
      </div>
      <div id="info-recently-added" class="col-6">
        <h3>Lorem, ipsum.</h3>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nulla
          consequuntur exercitationem cupiditate. Magnam laudantium quaerat
          doloremque ducimus ipsum, a optio totam saepe qui quas officiis
          libero quam possimus fuga vero. Nihil ab officia at iusto ex minus
          error, numquam deserunt ducimus quis, obcaecati rerum perferendis
          corrupti? Temporibus, consequuntur. Similique, natus?
        </p>
      </div>
    </div>
  </section>

  <div id="scrollable-menu" class="container">
    <div id="img-holder" class="row">

    </div>
  </div>
  <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/custom-js/index.js"></script>
  </script>
</body>

</html>