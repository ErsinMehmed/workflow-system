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

var accountBuilding = 0;
var accountFinalPrice = 0;
var accountOffer = 0;

var finalPrice = $("#account-toast-price");

$(".account-m2").keyup(function () {
  var value = $(this).val();

  if (accountOffer == 1 && accountBuilding == 1) {
    accountFinalPrice = value * 0.12 + 30;
  } else if (accountOffer == 1 && accountBuilding == 2) {
    accountFinalPrice = value * 0.18 + 30;
  } else if (accountOffer == 1 && accountBuilding == 3) {
    accountFinalPrice = value * 0.24 + 30;
  }

  if (accountOffer == 2 && accountBuilding == 1) {
    accountFinalPrice = value * 0.14 + 60;
  } else if (accountOffer == 2 && accountBuilding == 2) {
    accountFinalPrice = value * 0.2 + 60;
  } else if (accountOffer == 2 && accountBuilding == 3) {
    accountFinalPrice = value * 0.26 + 60;
  }

  if (accountOffer == 3 && accountBuilding == 1) {
    accountFinalPrice = value * 0.16 + 90;
  } else if (accountOffer == 3 && accountBuilding == 2) {
    accountFinalPrice = value * 0.22 + 90;
  } else if (accountOffer == 3 && accountBuilding == 3) {
    accountFinalPrice = value * 0.28 + 90;
  }

  finalPrice.html(accountFinalPrice + " лв.");
  $("#input-account-price").val(accountFinalPrice);
});

$(".building").click(function () {
  var value = $(this).val();
  var accountM2 = $("#account-m2").val();

  if (value == "Къща") {
    accountBuilding = 1;
  } else if (value == "Офис") {
    accountBuilding = 2;
  } else if (value == "Салон") {
    accountBuilding = 3;
  }

  if (accountOffer == 1 && accountBuilding == 1) {
    accountFinalPrice = accountM2 * 0.12 + 30;
  } else if (accountOffer == 1 && accountBuilding == 2) {
    accountFinalPrice = accountM2 * 0.18 + 30;
  } else if (accountOffer == 1 && accountBuilding == 3) {
    accountFinalPrice = accountM2 * 0.24 + 30;
  }

  if (accountOffer == 2 && accountBuilding == 1) {
    accountFinalPrice = accountM2 * 0.14 + 60;
  } else if (accountOffer == 2 && accountBuilding == 2) {
    accountFinalPrice = accountM2 * 0.2 + 60;
  } else if (accountOffer == 2 && accountBuilding == 3) {
    accountFinalPrice = accountM2 * 0.26 + 60;
  }

  if (accountOffer == 3 && accountBuilding == 1) {
    accountFinalPrice = accountM2 * 0.16 + 90;
  } else if (accountOffer == 3 && accountBuilding == 2) {
    accountFinalPrice = accountM2 * 0.22 + 90;
  } else if (accountOffer == 3 && accountBuilding == 3) {
    accountFinalPrice = accountM2 * 0.28 + 90;
  }

  finalPrice.html(accountFinalPrice + " лв.");
  $("#input-account-price").val(accountFinalPrice);
});

$(".offer").click(function () {
  var value = $(this).val();
  var accountM2 = $("#account-m2").val();

  if (value == "Основна") {
    accountOffer = 1;
  } else if (value == "Премиум") {
    accountOffer = 2;
  } else if (value == "Вип") {
    accountOffer = 3;
  }

  if (accountOffer == 1 && accountBuilding == 1) {
    accountFinalPrice = accountM2 * 0.12 + 30;
  } else if (accountOffer == 1 && accountBuilding == 2) {
    accountFinalPrice = accountM2 * 0.18 + 30;
  } else if (accountOffer == 1 && accountBuilding == 3) {
    accountFinalPrice = accountM2 * 0.24 + 30;
  }

  if (accountOffer == 2 && accountBuilding == 1) {
    accountFinalPrice = accountM2 * 0.14 + 60;
  } else if (accountOffer == 2 && accountBuilding == 2) {
    accountFinalPrice = accountM2 * 0.2 + 60;
  } else if (accountOffer == 2 && accountBuilding == 3) {
    accountFinalPrice = accountM2 * 0.26 + 60;
  }

  if (accountOffer == 3 && accountBuilding == 1) {
    accountFinalPrice = accountM2 * 0.16 + 90;
  } else if (accountOffer == 3 && accountBuilding == 2) {
    accountFinalPrice = accountM2 * 0.22 + 90;
  } else if (accountOffer == 3 && accountBuilding == 3) {
    accountFinalPrice = accountM2 * 0.28 + 90;
  }

  finalPrice.html(accountFinalPrice + " лв.");
  $("#input-account-price").val(accountFinalPrice);
});
