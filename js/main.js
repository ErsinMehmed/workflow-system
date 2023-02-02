function openModal(id, modalID) {
  $(document).on("click", id, function () {
    $(modalID).removeClass("hidden");
    $(modalID).addClass("block");
  });
}

function closeModal(id, modalID) {
  $(document).on("click", id, function () {
    $(modalID).removeClass("block");
    $(modalID).addClass("hidden");
  });
}

$(document).ready(function () {
  // Show and hide sidebar
  $("#open-nav-bar").click(function () {
    $("#navbar-default").slideToggle("slow");
  });

  // Price calculator home page
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

  // Price calculator account
  $(".account-m2, .building, .offer").on("change keyup", function () {
    const accountM2 = $("#account-m2").val();
    const accountBuilding = $(".building:checked").val();
    const accountOffer = $(".offer:checked").val();

    let accountFinalPrice = 0;
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

  // Price calculator dashboard
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

  // Phone dropdown in register modal
  $("#dropdown-states").click(function () {
    $("#dropdown-states").removeClass("block");
    $("#dropdown-states").addClass("hidden");
  });

  // Rating stars in account
  function updateStars(numStars) {
    $(".fa-star").removeClass("text-yellow-400").addClass("text-gray-300");
    $(`.fa-star`)
      .slice(0, numStars)
      .removeClass("text-gray-300")
      .addClass("text-yellow-400");
    $("#stars-count").val(numStars);
    $("#rate-star-value").html(numStars);
  }

  $(".fa-star").on("click", function () {
    updateStars($(".fa-star").index(this) + 1);
  });

  // Show and hide out datepicker
  $("#user-status").change(function () {
    $("#hidden-out-date-input").removeClass("block hidden");

    if ($(this)[0].selectedIndex === 0) {
      $("#hidden-out-date-input").addClass("hidden");
    } else if ($(this)[0].selectedIndex === 1) {
      $("#hidden-out-date-input").addClass("block");
    }
  });

  // Open and close modals
  closeModal(".close-return-product-modal", "#return-product-modal");

  openModal("#view-product-history", "#history-set-product-modal");

  closeModal(".close-history-product-modal", "#history-set-product-modal");

  openModal("#add-product-btn", "#add-product-modal");

  closeModal(".close-add-product-modal", "#add-product-modal");

  openModal(".open-rating-modal", "#customer-opinion-modal");

  closeModal(".close-customer-opinion-modal", "#customer-opinion-modal");

  closeModal(".cancel-order-reason-modal", "#cancel-order-reason-modal");

  closeModal(".close-set-product-modal", "#set-product-modal");

  openModal(".open-cancel-modal", "#cancel-order-modal");

  closeModal(".close-cancel-order-modal", "#cancel-order-modal");

  openModal("#sort-btn", "#sort-order-modal");

  closeModal(".close-sort-order-modal", "#sort-order-modal");

  openModal("#show-product-btn", "#product-show-modal");

  closeModal(".close-show-product-modal", "#product-show-modal");

  openModal("#make-order-btn", "#product-order-modal");

  closeModal(".close-product-order-modal", "#product-order-modal");

  closeModal(".close-supplier-edit-modal", "#supplier-edit-modal");

  closeModal(".close-order-photo-modal", "#order-photo-modal");

  closeModal(".close-edit-product-modal", "#edit-product-modal");

  openModal("#add-product-order-btn", "#add-order-product-modal");

  closeModal(".close-order-product-modal", "#add-order-product-modal");

  openModal("#add-supplier-btn", "#add-supplier-modal");

  closeModal(".close-supplier-modal", "#add-supplier-modal");

  openModal(".login-btn", "#customer-login-modal");

  closeModal(".customer-close-login-modal", "#customer-login-modal");

  openModal(".register-btn", "#customer-register-modal");

  closeModal(".close-customer-register-modal", "#customer-register-modal");

  closeModal(".close-delete-customer-img-modal", "#delete-customer-img-modal");

  closeModal("#close-history-modal", "#history-modal");

  openModal("#add-order-btn", "#add-order-modal");

  closeModal(".close-add-order-modal", "#add-order-modal");

  closeModal(".close-customer-opinion-modal", "#customer-opinion-modal");

  closeModal(".close-order-modal", "#order-modal");

  closeModal(".customer-order-modal-close", "#customer-order-modal");

  closeModal(".close-add-user-modal", "#add-user-modal");

  openModal("#add-user-btn", "#add-user-modal");

  openModal("#email-verify-btn", "#email-verify-modal");

  closeModal(".close-edit-user-modal", "#edit-user-modal");

  closeModal("#close-email-verify-modal", "#email-verify-modal");

  closeModal(".close-user-password-modal", "#user-password-modal");

  openModal("#add-team-btn", "#add-team-modal");

  closeModal(".close-add-team-modal", "#add-team-modal");

  closeModal(".close-set-order-modal", "#set-order-modal");

  closeModal(".close-team-order-modal", "#team-order-modal");

  closeModal(".close-supplier-order-view-modal", "#supplier-order-view-modal");

  closeModal(".close-delete-supplier-modal", "#delete-supplier-modal");

  closeModal(".close-delete-product-modal", "#delete-product-modal");

  closeModal(".close-delete-team-modal", "#delete-team-modal");

  closeModal(
    ".close-delete-product-order-modal",
    "#delete-product-order-modal"
  );

  $("#active-order").html($(".active-order-count").val());

  $("#finished-order").html($(".finished-order-count").val());

  // Show order data
  $(document).on(
    "click",
    "#order-btn, #profile-btn, #warehouse-btn",
    function () {
      $("#order-not-started").addClass("hidden");
      $("#order-is-started").addClass("hidden");
      $("#mobOrder").removeClass("hidden");
      $("#mobOrder").addClass("block");
    }
  );

  $(".price-calculate").keyup(function () {
    const totalPrice = (
      $("#product-order-quantity").val() * $("#product-order-one-price").val()
    ).toFixed(2);

    $("#product-order-price").val(totalPrice);
  });

  // Account m2 min and max value
  $("#account-m2").keyup(function () {
    if ($(this).val() > 2000) {
      $(this).val(2000);
    }

    if ($(this).val() <= 0) {
      $(this).val(1);
    }
  });

  // Table update after click
  $(document).on("click", "#reload-order-table", function (e) {
    $("#order-table").load(location.href + " #order-table");
  });

  $(document).on("click", ".reload-team-table", function (e) {
    $("#team-table").load(location.href + " #team-table");
  });

  $(document).on("click", "#reload-product-table", function (e) {
    $("#product-table").load(location.href + " #product-table");
  });

  // Mobile products counter
  let productCount = 1;

  $("#remove-one-product, #add-one-product").click(function () {
    if ($(this).attr("id") === "remove-one-product") {
      productCount++;
    } else {
      if (productCount != 1) {
        productCount--;
      }
    }
    $("#product-count-mobile").val(productCount);
  });

  // Percentage profit from each offer
  let offerCounts = [
    parseInt($("#first-offer1").val()),
    parseInt($("#second-offer1").val()),
    parseInt($("#third-offer1").val()),
  ];

  let offerCount = offerCounts.reduce((a, b) => a + b, 0);

  function calculatePercentage(a, b) {
    return ((b / a) * 100).toFixed(0) + "%";
  }

  $("#starter-offer-percentage").html(
    calculatePercentage(offerCount, offerCounts[0])
  );
  $("#medium-offer-percentage").html(
    calculatePercentage(offerCount, offerCounts[1])
  );
  $("#vip-offer-percentage").html(
    calculatePercentage(offerCount, offerCounts[2])
  );
});
