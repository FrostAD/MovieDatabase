// Adding item to scrollable menu
actionMovies = {
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
comedyMovies = {
  1: "/img/4.jpg",
  2: "/img/3.jpg",
  3: "/img/2.jpg",
  4: "/img/6.jpg",
  5: "/img/5.jpg",
  6: "/img/7.jpg",
  7: "/img/1.jpg",
  8: "/img/8.jpg",
  9: "/img/9.jpg",
  10: "/img/10.jpg",
};

Object.keys(actionMovies).forEach(function (path) {
  $("#img-holder-action").append(
    "<div class='col-4 my-img'><img  src=" + actionMovies[path] + "></div>"
  );
});
Object.keys(comedyMovies).forEach(function (path) {
  $("#img-holder-comedy").append(
    "<div class='col-4 my-img'><img  src=" + comedyMovies[path] + "></div>"
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

