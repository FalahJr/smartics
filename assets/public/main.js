$(window).on("scroll", function () {
  $(this).scrollTop()
    ? $("nav").addClass("fixed")
    : $("nav").removeClass("fixed");
});
AOS.init();
