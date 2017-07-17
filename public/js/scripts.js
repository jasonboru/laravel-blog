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
