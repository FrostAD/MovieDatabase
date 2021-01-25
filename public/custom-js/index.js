// Horizontal scroll
$(document).ready(function () {
  $(".selector-page").mousewheel(function (e, delta) {
    this.scrollLeft -= delta * 50;
    e.preventDefault();
  });
});
