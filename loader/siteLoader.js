document.onreadystatechange = function () {
  var state = document.readyState;
  if (state == "interactive") {
    document.getElementById("app").style.visibility = "hidden";
  } else if (state == "complete") {
    setTimeout(function () {
      document.getElementById("interactive");
      document.getElementById("site-load").style.visibility = "hidden";
      document.getElementById("app").style.visibility = "visible";
    }, 1000);
  }
};
