<nav class="navbar navbar-expand-md navbar-dark bg-dark pl-5 pr-5 sticky-top ">
  <a class="navbar-brand" href="/index.html">
    <h1>!MDb</h1>
  </a>
  <form class="form-inline my-2 my-md-0">
    <input class="form-control" type="text" placeholder="Search">
  </form>
  <div class="dropdown mr-auto">
    <a class="nav-link" id="plusDropdown" role="button" data-toggle="dropdown">
      <svg color="white" width="32" viewBox="3 0 15 15" class="bi bi-plus" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
      </svg>
    </a>

    <div class="dropdown-menu" aria-labelledby="plusDropdown">
      <a class="dropdown-item" href="/add-pages/addMovie.html">Add Movie</a>
      <a class="dropdown-item" href="/add-pages/addActor.html">Add Actor</a>
      <a class="dropdown-item" href="/add-pages/addEvent.html">Add Event</a>
      <a class="dropdown-item" href="/add-pages/addFestival.html">Add Festival</a>
    </div>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#rightNavbarContent"
    aria-controls="rightNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="rightNavbarContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="/main-pages/movies.html">Movies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Events</a>
      </li>
      <li class="nav-item dropdown ">
        <!-- DROPDOWN WHEN LOGGED IN -->
        <!-- <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"> <span class="fa fa-user-circle fa-2x mr-1" style=" vertical-align: middle;"></span>
          Your_name</a>
        <div class="dropdown-menu" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Your Publications</a>
          <a class="dropdown-item" href="#">Your Watchlist</a>
          <a class="dropdown-item" href="#">Your Wishlist</a>
          <a class="dropdown-item" href="#">Your Events</a>
          <a class="dropdown-item" href="#">Account Settings</a>
          <a class="dropdown-item" href="#">Sign In</a>
        </div> -->
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"> <span class="fa fa-user-circle fa-2x mr-1" style=" vertical-align: middle;"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="/registration/login.html" data-toggle="modal"
            data-target="#login-modal">Login</a>
          <a class="dropdown-item" href="/registration/signup.html" data-toggle="modal" data-target="#signup-modal">Sign
            Up</a>
        </div>

      </li>
    </ul>
  </div>
</nav>