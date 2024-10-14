jQuery(document).ready(function ($) {
  $(".accordion-title").click(function () {
    var parent = $(this).parent();

    if (parent.hasClass("active")) {
      parent.removeClass("active");
    } else {
      $(".accordion-item").removeClass("active");
      parent.addClass("active");
    }
  });
});
