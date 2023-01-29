$("#dropdown-states").click(function () {
  $("#dropdown-states").removeClass("block");
  $("#dropdown-states").addClass("hidden");
});

$("#open-nav-bar").click(function () {
  $("#navbar-default").slideToggle("slow");
});

$("#user-status").change(function () {
  if ($(this)[0].selectedIndex == 0) {
    $("#hidden-out-date-input").removeClass("block");
    $("#hidden-out-date-input").addClass("hidden");
  } else if ($(this)[0].selectedIndex == 1) {
    $("#hidden-out-date-input").removeClass("hidden");
    $("#hidden-out-date-input").addClass("block");
  }
});

const slider = $("#slider");
const selectBuil = $("#select-buil");
const final = $("#final");
const boxValue0 = $("#slider_value0");
const boxValue1 = $("#slider_value1");
const boxValue2 = $("#slider_value2");

const coefs = [0.12, 0.14, 0.16, 0.18, 0.2, 0.22, 0.24, 0.26, 0.28];
const addends = [30, 60, 90];
const formatValues = (val) => parseFloat(val).toFixed(2);

const handleInput = function () {
  const x = selectBuil.prop("selectedIndex");
  const n = slider.val();
  let value, value1, value2;

  switch (x) {
    case 0:
      value = n * 0.12 + 30;
      value1 = n * 0.14 + 60;
      value2 = n * 0.16 + 90;
      break;
    case 1:
      value = n * 0.18 + 30;
      value1 = n * 0.2 + 60;
      value2 = n * 0.22 + 90;
      break;
    case 2:
      value = n * 0.24 + 30;
      value1 = n * 0.26 + 60;
      value2 = n * 0.28 + 90;
      break;
  }

  boxValue0.html(formatValues(value) + " лв.");
  boxValue1.html(formatValues(value1) + " лв.");
  boxValue2.html(formatValues(value2) + " лв.");
  final.val(n);
};

slider.on("input", handleInput);
selectBuil.on("input", handleInput);

final.on("input", function () {
  slider.val(final.val());
  final.val(final.val() > 2000 ? 2000 : final.val());
  handleInput();
});

$(".account-m2, .building, .offer").on("change keyup", function () {
  const accountM2 = $("#account-m2").val();
  const accountBuilding = $(".building:checked").val();
  const accountOffer = $(".offer:checked").val();

  let accountFinalPrice;
  switch (accountOffer) {
    case "Основна":
      switch (accountBuilding) {
        case "Къща":
          accountFinalPrice = accountM2 * 0.12 + 30;
          break;
        case "Офис":
          accountFinalPrice = accountM2 * 0.18 + 30;
          break;
        case "Салон":
          accountFinalPrice = accountM2 * 0.24 + 30;
          break;
      }
      break;
    case "Премиум":
      switch (accountBuilding) {
        case "Къща":
          accountFinalPrice = accountM2 * 0.14 + 60;
          break;
        case "Офис":
          accountFinalPrice = accountM2 * 0.2 + 60;
          break;
        case "Салон":
          accountFinalPrice = accountM2 * 0.26 + 60;
          break;
      }
      break;
    case "Вип":
      switch (accountBuilding) {
        case "Къща":
          accountFinalPrice = accountM2 * 0.16 + 90;
          break;
        case "Офис":
          accountFinalPrice = accountM2 * 0.22 + 90;
          break;
        case "Салон":
          accountFinalPrice = accountM2 * 0.28 + 90;
          break;
      }
      break;
  }

  $("#account-toast-price").html(accountFinalPrice.toFixed(2) + " лв.");
  $("#input-account-price").val(accountFinalPrice.toFixed(2));
});

function updateStars(numStars) {
  $(".fa-star").addClass("text-gray-300");
  $(".fa-star").removeClass("text-yellow-400");
  for (let i = 1; i <= numStars; i++) {
    $(`#first-star, #second-star, #third-star, #fourth-star, #fifth-star`)
      .eq(i - 1)
      .addClass("text-yellow-400");
  }
  $("#stars-count").val(numStars);
  $("#rate-star-value").html(numStars);
}

$("#first-star").click(function () {
  updateStars(1);
});

$("#second-star").click(function () {
  updateStars(2);
});

$("#third-star").click(function () {
  updateStars(3);
});

$("#fourth-star").click(function () {
  updateStars(4);
});

$("#fifth-star").click(function () {
  updateStars(5);
});

$("#first-star").hover(function () {
  updateStars(1);
});

$("#second-star").hover(function () {
  updateStars(2);
});

$("#third-star").hover(function () {
  updateStars(3);
});

$("#fourth-star").hover(function () {
  updateStars(4);
});

$("#fifth-star").hover(function () {
  updateStars(5);
});

$("#room, #offer, #customer-m2").on("change keyup", function () {
  const m2 = $("#customer-m2").val();
  const offer = $("#offer").val();
  const room = $("#room").val();

  let finalPrice;
  switch (offer) {
    case "Основна":
      switch (room) {
        case "Къща":
          finalPrice = m2 * 0.12 + 30;
          break;
        case "Офис":
          finalPrice = m2 * 0.18 + 30;
          break;
        case "Салон":
          finalPrice = m2 * 0.24 + 30;
          break;
      }
      break;
    case "Премиум":
      switch (room) {
        case "Къща":
          finalPrice = m2 * 0.14 + 60;
          break;
        case "Офис":
          finalPrice = m2 * 0.2 + 60;
          break;
        case "Салон":
          finalPrice = m2 * 0.26 + 60;
          break;
      }
      break;
    case "Вип":
      switch (room) {
        case "Къща":
          finalPrice = m2 * 0.16 + 90;
          break;
        case "Офис":
          finalPrice = m2 * 0.22 + 90;
          break;
        case "Салон":
          finalPrice = m2 * 0.28 + 90;
          break;
      }
      break;
  }

  $("#customer-price").val(finalPrice.toFixed(2) + " лв.");
  $("#customer-price-hidden").val(finalPrice.toFixed(2));
});
