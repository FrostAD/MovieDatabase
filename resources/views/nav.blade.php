<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-md-5 sticky-top ">
  <a class="navbar-brand" href="/">
    <h1>!MDb</h1>
  </a>
  <form id="leftNavbarContent" class="form-inline">
    <input id="search-bar" class="form-control" type="text" placeholder="Search">
    <div class="dropdown">
      <ul id="results">

      </ul>
    </div>

      <div class="dropdown">
      <a class="nav-link" id="plusDropdown" role="button" data-toggle="dropdown">
        <svg color="white" width="32" viewBox="3 0 15 15" class="bi bi-plus" fill="currentColor"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
        </svg>
      </a>
      <div class="dropdown-menu" aria-labelledby="plusDropdown">
        <a class="dropdown-item" href="{{route('event.create_custom')}}">Add Event</a>
        <a class="dropdown-item" href="{{route('exchange.create')}}">Add Exchange</a>
      </div>
    </div>
  </form>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#rightNavbarContent"
    aria-controls="rightNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="rightNavbarContent">
    <ul class="navbar-nav ml-auto my-2 my-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="/movies">Movies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/events">Events</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/festivals">Festivals</a>
      </li>
        @auth
      <li class="nav-item dropdown active">
        <!-- DROPDOWN WHEN LOGGED IN -->
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"> <span class="fa fa-user-circle fa-2x mr-1" style="vertical-align: middle;"></span>
          {{\Illuminate\Support\Str::words(\Illuminate\Support\Facades\Auth::user()->name,1,'')}}</a>
        <div class="dropdown-menu" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="/account/{{\Illuminate\Support\Facades\Auth::user()->id}}">Your Account</a>
            @if(auth()->user()->hasRole('Admin'))
            <a class="dropdown-item" href="/admin/movie">Admin panel</a>
            @endif
            <a class="dropdown-item" href="/exchanges">All Exchanges</a>
            <a class="dropdown-item" href="/account/{{\Illuminate\Support\Facades\Auth::user()->id}}/settings">Account Settings</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
      </li>
      @endauth
        <!-- DROPDOWN WHEN NOT LOGGED IN -->
        @guest
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"> <span class="fa fa-user-circle fa-2x mr-1" style="vertical-align: middle;"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="userDropdown">
            <a class="dropdown-item"
               style="cursor: pointer"
               data-toggle="modal"
               data-target="#loginModal">{{ __('Login') }}</a>
            <a class="dropdown-item"
               style="cursor: pointer"
               data-toggle="modal"
               data-target="#registerModal">{{ __('Register') }}</a>
        </div>
        </li>
          @endguest
    </ul>
  </div>
</nav>
