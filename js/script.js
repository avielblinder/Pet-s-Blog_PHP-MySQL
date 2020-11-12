$("#image").on("change", function (e) {
  $(".custom-file-label").text(e.target.files[0].name);
});

$(".delete-post-btn").on("click", function () {
  if ( confirm("Are you sure you want to delete?") ) {
    return true;
  } else {
    return false;
  }
});
