<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- AJAX -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://azlejs.com/v2/azle.min.js"></script>

  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="/css/main.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN">

  <!-- Bootstrap Date-Picker -->
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

  <title>!MDb</title>
</head>

<body>
  <!-- Navigation Bar -->
  <div id="nav-placeholder">
      @include('nav')
  </div>
@yield('body')

  <!-- MODALS ARE HERE BECAUSE OF THE Z-INDEX VALUE -->
  <div id="login-placeholder"></div>
  <div id="signup-placeholder"></div>

  <!-- Different components loader -->
  <script>
    //TODO
    $(function () {
    //   $("#nav-placeholder").load("../nav.html");
      $("#login-placeholder").load("../registration/login.html");
      $("#signup-placeholder").load("../registration/signup.html");
    });
  </script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"></script>
  <!-- JavaScript included individual files as needed -->
  <script src="/bootstrap/js/bootstrap.min.js"></script>
  <script src="/custom-js/index.js"></script>

</body>

</html>