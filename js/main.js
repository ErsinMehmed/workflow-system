$("#dropdown-states").click(function () {
  $("#dropdown-states").removeClass("block");
  $("#dropdown-states").addClass("hidden");
});

$("#open-nav-bar").click(function () {
  $("#navbar-default").slideToggle("slow");
});

$("#select-buil").on("change", function () {
  var x = document.getElementById("select-buil").selectedIndex;
  var n = $("#slider").val();

  if (x == 0) {
    var value = n * 0.12 + 30;
    var value1 = n * 0.14 + 60;
    var value2 = n * 0.16 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }

  if (x == 1) {
    var value = n * 0.18 + 30;
    var value1 = n * 0.2 + 60;
    var value2 = n * 0.22 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }

  if (x == 2) {
    var value = n * 0.24 + 30;
    var value1 = n * 0.26 + 60;
    var value2 = n * 0.28 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }
});

$(document).on("input", "#slider", function () {
  var x = document.getElementById("select-buil").selectedIndex;
  var n = $("#slider").val();

  if (x == 0) {
    var value = n * 0.12 + 30;
    var value1 = n * 0.14 + 60;
    var value2 = n * 0.16 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }

  if (x == 1) {
    var value = n * 0.18 + 30;
    var value1 = n * 0.2 + 60;
    var value2 = n * 0.22 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }

  if (x == 2) {
    var value = n * 0.24 + 30;
    var value1 = n * 0.26 + 60;
    var value2 = n * 0.26 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }
});

$(document).on("input", "#final", function () {
  var final = $("#final").val();
  $("#slider").val(final);

  if (final == "") {
    $("#slider").val(0);
  }
  if (final > 2000) {
    var final = $("#final").val(2000);
  }

  var x = document.getElementById("select-buil").selectedIndex;
  var n = $("#final").val();

  if (x == 0) {
    var value = n * 0.12 + 30;
    var value1 = n * 0.14 + 60;
    var value2 = n * 0.16 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }

  if (x == 1) {
    var value = n * 0.18 + 30;
    var value1 = n * 0.2 + 60;
    var value2 = n * 0.22 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }

  if (x == 2) {
    var value = n * 0.24 + 30;
    var value1 = n * 0.26 + 60;
    var value2 = n * 0.26 + 90;

    var result = parseFloat(value).toFixed(2);
    var result1 = parseFloat(value1).toFixed(2);
    var result2 = parseFloat(value2).toFixed(2);

    $("#slider_value").html(result + " лв.");
    $("#slider_value1").html(result1 + " лв.");
    $("#slider_value2").html(result2 + " лв.");
    $("#final").val(n);
  }
});
