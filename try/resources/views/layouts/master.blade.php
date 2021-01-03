<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- AJAX -->
{{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--  <script src="https://azlejs.com/v2/azle.min.js"></script>--}}

<!-- Custom stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

    <title>!MDb</title>
</head>
<body>
<!-- Navigation Bar -->
<div id="nav-placeholder">
    @include('nav')
</div>
@yield('body')

<!-- MODALS ARE HERE BECAUSE OF THE Z-INDEX VALUE -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
@guest
@include('custom_auth.login2')
@include('custom_auth.register2')
@yield('scripts')

<div id="login-placeholder">
</div>
<div id="signup-placeholder">
</div>
@endguest

<!-- Different components loader -->
{{--<script>--}}
{{--    $(function () {--}}
{{--        //   $("#nav-placeholder").load("nav.html");--}}
{{--        $("#login-placeholder").load("registration/login.html");--}}
{{--        $("#signup-placeholder").load("registration/signup.html");--}}
{{--    });--}}
{{--</script>--}}




@if(\Illuminate\Support\Facades\Route::current()->getName() == 'movie')
    <script>
        $(document).ready(function () {

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('fetch.comments') }}",
                    method: "POST",
                    data: {_token: _token, page: page, movie: '{{$movie->id}}'},
                    success: function (data) {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>
@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'fetch.movies.index')
    <script>
        $(document).ready(function () {

            $('#sortType').on('change', function (e) {
                alert($(this).val());
                $('#sorting').val($(this).val());
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{route('movieSort')}}",
                    method: "POST",
                    data: {_token: _token, sortType: $('#sortType').val()},
                    success: function (data) {
                        $('#moviesTable').html(data);
                    }
                });
            });

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('fetch.movies') }}",
                    method: "POST",
                    data: {_token: _token, page: page, sort: $('#sortType').val()},
                    success: function (data) {
                        $('#moviesTable').html(data);
                    }
                });
            };
        });
    </script>
@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'fetch.movies.musician.main')
    <script>
        $(document).ready(function () {

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('fetch.movies.musician') }}",
                    method: "POST",
                    data: {_token: _token, page: page, musician: '{{$musician->id}}'},
                    success: function (data) {
                        console.log(data);
                        $('#profile').html(data);
                    }
                });
            }

        });
    </script>
@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'fetch.movies.producer.main')
    <script>
        $(document).ready(function () {

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('fetch.movies.producer') }}",
                    method: "POST",
                    data: {_token: _token, page: page, producer: '{{$producer->id}}'},
                    success: function (data) {
                        console.log(data);
                        $('#profile').html(data);
                    }
                });
            }

        });
    </script>
@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'fetch.movies.screenwritter.main')
    <script>
        $(document).ready(function () {

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('fetch.movies.screenwritter') }}",
                    method: "POST",
                    data: {_token: _token, page: page, screenwritter: '{{$screenwritter->id}}'},
                    success: function (data) {
                        console.log(data);
                        $('#profile').html(data);
                    }
                });
            }

        });
    </script>
@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'fetch.events.index')
    <script>
        $(document).ready(function () {

            $('#sortType').on('change', function (e) {
                alert($(this).val());
                $('#sorting').val($(this).val());
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{route('eventSort')}}",
                    method: "POST",
                    data: {_token: _token, sortType: $('#sortType').val()},
                    success: function (data) {
                        $('#eventsTable').html(data);
                    }
                });
            });

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('fetch.events') }}",
                    method: "POST",
                    data: {_token: _token, page: page, sort: $('#sortType').val()},
                    success: function (data) {
                        $('#eventsTable').html(data);
                    }
                });
            };
        });
    </script>
@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'fetch.festivals.index')
    <script>
        $(document).ready(function () {

            $('#sortType').on('change', function (e) {
                alert($(this).val());
                $('#sorting').val($(this).val());
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{route('festivalSort')}}",
                    method: "POST",
                    data: {_token: _token, sortType: $('#sortType').val()},
                    success: function (data) {
                        $('#festivalsTable').html(data);
                    }
                });
            });

            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var _token = $("input[name=_token]").val();
                $.ajax({
                    url: "{{ route('fetch.festivals') }}",
                    method: "POST",
                    data: {_token: _token, page: page, sort: $('#sortType').val()},
                    success: function (data) {
                        $('#festivalsTable').html(data);
                    }
                });
            };
        });
    </script>
@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'event.create')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('.livesearch').select2({
            placeholder: 'Select movie',
            ajax: {
                url: '{{route('event.fetch.movies')}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>

@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'exchange.create')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('.livesearch').select2({
            placeholder: 'Select movie',
            ajax: {
                url: '{{route('exchange.fetch.movies')}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>

@endif
@if(\Illuminate\Support\Facades\Route::current()->getName() == 'exchange.accept')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('.livesearch').select2({
            placeholder: 'Select movie',
            ajax: {
                url: '{{route('exchange.fetch.movies')}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>

@endif
<!-- JavaScript included individual files as needed -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
{{--<script src="/custom-js/index.js"></script>--}}

</body>

</html>