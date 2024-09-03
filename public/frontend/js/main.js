(function($) {
  "use strict";

  $(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll > 100) {
      $(".menu_parent").addClass("menu_affix"); // you don't need to add a "." in before your class name
    } else {
      $(".menu_parent").removeClass("menu_affix");
    }
  });

  /*--------------------------------------------------------------
    ## slider Activated
    --------------------------------------------------------------*/
  // $('.slider-one').camera({
  //     height: '41%',
  //     pagination: false,
  //     navigation: true,
  //     playPause: false,
  //     time: 10000,
  //     height: '20%',
  //     barPosition: 'top',
  //     loaderOpacity: 0,
  // });

  jQuery("#main-nav").stellarNav({
    breakpoint: 767
  });

  $("#example").vTicker({
    showItems: 1
  });

  $("#example2").vTicker({
    showItems: 4
  });

  $("#upazilla").on("change", function() {
    var id = this.value;

    $.ajax({
      url: baseurl + "/get_union_by_upazilla",
      method: "get",
      data: { id: id },
      success: function(data) {
        $("#union").html(data);
        //$('.news-content').html(data);
      },
      error: function() {}
    });
  });

  $("#union").on("change", function() {
    var link = this.value;
    if (link) {
      window.location.href = link;
    }
  });
})(jQuery); // End of use strict
