/*
$(document).ready(function() {
  $(document).on("click", ".bbDelete", function(e) {
    e.preventDefault();
    url = $(this).attr('action');
    bootbox.confirm({
      message:
        "Are you sure you want to delete this post? All info inside will be removed",
      buttons: {
        confirm: {
          label: "Yes",
          className: "btn-success"
        },
        cancel: {
          label: "No",
          className: "btn-danger"
        }
      },
      callback: function(result) {
        if (result == true) {
          $.ajax(url);
        }
      }
    });
  });
});
*/

$('.scrollers a').click(function(e) {

    // Treat as normal link if no-scroll class
    if ($(this).hasClass('no-scroll')) return;

    e.preventDefault();
    var heading = $(this).attr('href');
    var scrollDistance = $(heading).offset().top;

    $('html, body').animate({
        scrollTop: scrollDistance + 'px'
    }, Math.abs(window.pageYOffset - $(heading).offset().top) / 1);

    // Hide the menu once clicked if mobile
    if ($('header').hasClass('active')) {
        $('header, body').removeClass('active');
    }
});

// Scroll to top
$('#to-top').click(function() {
    $('html, body').animate({
        scrollTop: 0
    }, 500);
});
