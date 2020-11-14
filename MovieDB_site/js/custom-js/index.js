images = {
  1: "/img/1.jpg",
  2: "/img/2.jpg",
  3: "/img/3.jpg",
  4: "/img/4.jpg",
  5: "/img/5.jpg",
  6: "/img/6.jpg",
  7: "/img/7.jpg",
  8: "/img/8.jpg",
  9: "/img/9.jpg",
  10: "/img/10.jpg",
};

Object.keys(images).forEach(function (path) {
  $("#img-holder").append(
    "<div class='col-4 my-img'><img  src=" + images[path] + "></div>"
  );
});

$(document).ready(function () {
  $(".my-img").hover(
    function () {
      $(this).addClass("transition");
    },
    function () {
      $(this).removeClass("transition");
    }
  );
});

// year picker
$('.date-own').datepicker({
  minViewMode: 2,
  format: 'yyyy'
});