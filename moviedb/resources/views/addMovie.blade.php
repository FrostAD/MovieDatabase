<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://azlejs.com/v2/azle.min.js"></script>
  <link rel="stylesheet" href="/path/to/cdn/bootstrap.min.css" />
<script src="/path/to/cdn/jquery.min.js"></script>
<script src="/path/to/cdn/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

  <link rel="stylesheet" href="/css/bootstrap.css" />
  <link rel="stylesheet" href="/css/custom-css/style.css" />

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
          <a class="dropdown-item" href="#">Add Movie</a>
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
    <x-alert/>
    <form id="add-movie-form" action="/movies/add" method="POST" enctype="multipart/form-data">
      @csrf
      <!-- Title -->
      <div class="form-group">
        <label for="movie">Title:</label>
        <input type="text" class="form-control" id="usr" name="title">
      </div>
      <!-- Bio -->
      <div class="form-group">
        <label for="bio">Bio:</label>
        <textarea class="form-control" rows="5" name="description"></textarea>
      </div>
      <!-- Year -->
      <p class="my-3">Date: <input type="text" id="datepicker" name="published_at"/></p>
      <p class="my-3">Timespan: <input type="text" id="timespan" name="timespan"/></p>

      <!-- Genre -->
      <div class="form-group">
        <label for="sel2">Genre (hold ctrl or shift to select more than one):</label>
        {{-- <select class="js-example-responsive" multiple="multiple" style="width: 75%">
          
        </select> --}}
        
        {{-- <select id="demo" multiple="multiple" name="genres">
          <option value="Javascript">Javascript</option>
          <option value="Python">Python</option>
          <option value="LISP">LISP</option>
          <option value="C++">C++</option>
          <option value="jQuery">jQuery</option>
          <option value="Ruby">Ruby</option>
        </select> --}}

        <select multiple class="form-control" name="genres[]">
          <option value="Action">Action</option>
          <option value="Drama">Drama</option>
          <option value="Comedy">Comedy</option>
          <option value="Horror">Horror</option>
        </select>
      </div>
      <div class="form-group">
        <label for="image">Image: </label>
        <input type="file" class="form-control-file" name="poster">
      </div>
      <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>

  </div>


  <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/custom-js/index.js"></script>
</body>

</html>