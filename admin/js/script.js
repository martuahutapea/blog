$(document).ready(function () {
  $("#summernote").summernote({
    height: 300,
  });

  $("#selectAllBoxes").click(function (event) {
    //  Check all checkboxes if the select all box is checked and uncheck otherwise.
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      ".checkBoxes".each(function () {
        this.checked = false;
      });
    }
  });

  var div_box = "<div id='load-screen'><div id='loading'></div></div>";

  $("body").prepend(div_box);

  // Function to targeting the id in css file
  $("#load-screen")
    .delay(200)
    .fadeOut(100, function () {
      $(this).remove();
    });
});

// Get the user onlie without resfresh the page
function loadUsersOnline() {
  $.get("functions.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
  });
}

setInterval(function () {
  loadUsersOnline();
}, 500);
