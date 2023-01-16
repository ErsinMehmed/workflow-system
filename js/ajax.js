$(document).ready(function () {
  function postData(url, data, success) {
    return $.ajax({
      type: "POST",
      url: url,
      data: data,
      processData: false,
      contentType: false,
      success: success,
    });
  }

  function getData(url, success) {
    return $.ajax({
      type: "GET",
      url: url,
      success: success,
    });
  }

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

  alertify.set("notifier", "position", "top-center");

  // Customer register
  $(document).on("submit", "#sign-in-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_customer", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#sign-in-form")[0].reset();
        $("signUp-modal").fadeOut();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 400) {
        alertify.error(res.message);
      } else if (res.status == 430) {
        alertify.error(res.message);
      }
    });
  });

  // Customer login
  $(document).on("submit", "#sing-up-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("login_info", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        window.location.href = "account.php";
        alertify.success(res.message);
        userEmail = res.userEmail;
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Update customer information
  $(document).on("submit", "#user-info-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_customer", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        alertify.success(res.message);
        $(".order-section").load(location.href + " .order-section");
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Update customer profile image
  $(document).on("submit", "#customer-image-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_customer_image", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 200) {
        alertify.success(res.message);
        location.reload(true);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Update customer password
  $(document).on("submit", "#update-customer-password", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_customer_password", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        alertify.success(res.message);
      } else if (res.status == 430) {
        alertify.error(res.message);
      } else if (res.status == 510) {
        alertify.error(res.message);
      }
    });
  });

  // Customer profile logout
  $("#log-out").on("click", function () {
    var action = "data";

    $.ajax({
      url: "../action/Customer.php",
      type: "POST",
      data: { action: action },
      success: function (response) {
        var res = jQuery.parseJSON(response);

        if (res.status == 200) {
          window.location.href = "home.php";
        }
      },
    });
  });

  // Customer make order
  $(document).on("submit", "#customer-order-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("customer_order", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#history-section-load").load(
          "../pages/account.php #history-section-load"
        );
        $("#account-toast-price").html("0 лв.");
        $("#customer-order-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Customer rate services
  $(document).on("submit", "#customer-opinion-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("customer_rate", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#customer-opinion-modal").removeClass("block");
        $("#customer-opinion-modal").addClass("hidden");
        $("#customer-opinion-form")[0].reset();
        $("#rate-section").load(location.href + " #rate-section");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Guest make order
  $(document).on("submit", "#guest-order-form", function (e) {
    history - view;
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("guest_order", true);

    postData("../action/Order.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#guest-order-form")[0].reset();
        $("#account-toast-price").html("0 лв.");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Get customer history modal data
  $(document).on("click", ".history-view", function () {
    var id = $(this).val();

    getData("../action/Customer.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#history-modal").removeClass("hidden");
        $("#history-modal").addClass("block");
        var date = res.data.add_date.split(" ");
        var finalDate = date[0].replaceAll("-", ".").split(".");

        $("#add_date").html(
          finalDate[2] + "." + finalDate[1] + "." + finalDate[0]
        );
        $("#add_time").html(date[1].slice(0, -3));
        $("#customer_name").html(res.data.customer_name);
        $("#customer_phone").html(res.data.phone);
        $("#customer_building").html(res.data.room);
        $("#customer_offer").html(res.data.offer);

        var date = res.data.date.replaceAll("-", ".").split(".");
        $("#do_date").html(date[2] + "." + date[1] + "." + date[0]);
        $("#do_time").html(res.data.time);
        $("#customer_payment").html(res.data.pay);
        $("#customer_invoice").html(res.data.invoice);
        $("#customer_address").html(res.data.address);
        $("#customer_information").html(res.data.information);
        $("#customer_m2").html(res.data.m2 + " m2");
        $("#customer_price").html(res.data.price + " лв.");
      }
    });
  });

  // Date filter history section
  $("#date-picker-account").on("change", function () {
    var date = $(this).val();
    var offer = $("#account-offers").val();

    $.ajax({
      url: "../action/customer/Filter.php",
      type: "POST",
      data: {
        date: date,
        offer: offer,
      },
      success: function (data) {
        $("#history-section").html(data);
      },
    });
  });

  // Offer filter history section
  $("#account-offers").on("change", function () {
    var offer = $(this).val();
    var date = $("#date-picker-account").val();

    $.ajax({
      url: "../action/customer/Filter.php",
      type: "POST",
      data: {
        offer: offer,
        date: date,
      },
      success: function (data) {
        $("#history-section").html(data);
      },
    });
  });

  // Customer upload room image form
  $(document).on("submit", "#room-images-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("customer_upload_room", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#document-section").load(location.href + " #document-section");
        alertify.success(res.message);
      } else if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Open delete room image modal
  $(document).on("click", ".room-img", function (e) {
    $("#delete-img-id").val($(this).attr("id"));
    $("#delete-customer-img-modal").removeClass("hidden");
    $("#delete-customer-img-modal").addClass("block");
  });

  // Delete room image
  $(document).on("submit", "#delete-customer-img-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("delete_customer_img", true);

    postData("../action/Customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#delete-customer-img-modal").removeClass("block");
        $("#delete-customer-img-modal").addClass("hidden");
        $("#document-section").load(location.href + " #document-section");
        alertify.success(res.message);
      } else if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  closeModal(".close-delete-customer-img-modal", "#delete-customer-img-modal");

  // Admin make order
  $(document).on("submit", "#add-order-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("admin_order", true);

    postData("../action/AdminOrders.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#add-order-modal").removeClass("block");
        $("#add-order-modal").addClass("hidden");
        $("#order-table").load(location.href + " #order-table");
        $("#add-order-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  closeModal("#close-history-modal", "#history-modal");

  openModal("#add-order-btn", "#add-order-modal");

  closeModal(".close-add-order-modal", "#add-order-modal");

  // Get order data for edit
  $(document).on("click", ".edit-order", function () {
    var id = $(this).val();

    getData("../action/AdminOrders.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#order-modal").removeClass("hidden");
        $("#order-modal").addClass("block");

        if (res.data.room == "Къща") {
          $('#room-edit option[value="Къща"]').attr("selected", "selected");
        } else if (res.data.room == "Офис") {
          $('#room-edit option[value="Офис"]').attr("selected", "selected");
        } else {
          $('#room-edit option[value="Салон"]').attr("selected", "selected");
        }

        if (res.data.offer == "Основна") {
          $('#offer-edit option[value="Основна"]').attr("selected", "selected");
        } else if (res.data.offer == "Премиум") {
          $('#offer-edit option[value="Премиум"]').attr("selected", "selected");
        } else {
          $('#offer-edit option[value="Вип"]').attr("selected", "selected");
        }

        if (res.data.time == "Преди 13:00") {
          $('#time-edit option[value="Преди 13:00"]').attr(
            "selected",
            "selected"
          );
        } else if (res.data.time == "След 13:00") {
          $('#time-edit option[value="След 13:00"]').attr(
            "selected",
            "selected"
          );
        }

        if (res.data.pay == "В брой") {
          $('#pay-edit option[value="В брой"]').attr("selected", "selected");
        } else if (res.data.pay == "С карта") {
          $('#pay-edit option[value="С карта"]').attr("selected", "selected");
        }

        $("#order-id").val(res.data.id);
        $("#customer-name-edit").val(res.data.customer_name);
        $("#customer-phone-edit").val(res.data.phone);
        $("#pick-date-edit").val(res.data.date);
        $("#customer-m2-edit").val(res.data.m2);
        $("#address-edit").val(res.data.address);
        $("#information-edit").val(res.data.information);
        $("#customer-price-edit").val(res.data.price);
      }
    });
  });

  $(document).on("click", ".view-customer-opinion", function () {
    var id = $(this).val();

    getData("../action/AdminOrders.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#customer-opinion-modal").removeClass("hidden");
        $("#customer-opinion-modal").addClass("block");
        $("#customer-opinion-orders").val(res.data.customer_opinion);
      }
    });
  });

  closeModal(".close-customer-opinion-modal", "#customer-opinion-modal");

  // Update order data
  $(document).on("submit", "#update-order-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("admin_order_update", true);

    postData("../action/AdminOrders.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#order-modal").removeClass("block");
        $("#order-modal").addClass("hidden");
        $("#order-table").load(location.href + " #order-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  closeModal(".close-order-modal", "#order-modal");

  // Send invoice to customer profile
  $(document).on("click", ".send-invoice", function (e) {
    var orderIdInvoice = $(this).val();

    $.ajax({
      url: "../action/adminOrders.php",
      type: "POST",
      data: { orderIdInvoice: orderIdInvoice },
      success: function (response) {
        var res = jQuery.parseJSON(response);

        if (res.status == 200) {
          $("#order-table").load(location.href + " #order-table");
          alertify.success(res.message);
        } else if (res.status == 500) {
          alertify.error(res.message);
        }
      },
    });
  });

  // Show customer information
  $(document).on("click", ".show-customer", function () {
    var email = $(this).val();

    getData("../action/AdminOrders.php?email=" + email, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#customer-order-modal").removeClass("hidden");
        $("#customer-order-modal").addClass("block");

        $("#customer-name-show").val(res.data.name);
        $("#customer-phone-show").val(res.data.phone);
        $("#customer-email-show").val(res.data.email);
        $("#customer-address-show").val(res.data.address);

        var date = res.data.created_at.split(" ");
        var finalDate = date[0].replaceAll("-", ".").split(".");
        $("#customer-created").val(
          finalDate[2] + "." + finalDate[1] + "." + finalDate[0]
        );
      }
    });
  });

  // Date filter dashboard order section
  $("#order-filter-date").on("change", function () {
    var date = $(this).val();
    var text = $("#search-order").val();

    $.ajax({
      url: "../action/orders/Filter.php",
      type: "POST",
      data: {
        date: date,
        text: text,
      },
      success: function (data) {
        $("#order-table").html(data);
      },
    });
  });

  // Date filter dashboard order section
  $("#search-order").on("keyup", function () {
    var text = $(this).val();
    var date = $("#order-filter-date").val();

    $.ajax({
      url: "../action/orders/Filter.php",
      type: "POST",
      data: {
        date: date,
        text: text,
      },
      success: function (data) {
        $("#order-table").html(data);
      },
    });
  });

  closeModal(".customer-order-modal-close", "#customer-order-modal");

  closeModal(".close-add-user-modal", "#add-user-modal");

  openModal("#add-user-btn", "#add-user-modal");

  // Admin create user
  $(document).on("submit", "#add-user-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("admin_user", true);

    postData("../action/AdminUsers.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#add-user-form")[0].reset();
        $("#add-user-modal").removeClass("block");
        $("#add-user-modal").addClass("hidden");
        $("#user-table").load(location.href + " #user-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Get user data for edit
  $(document).on("click", ".edit-user", function () {
    var id = $(this).val();

    getData("../action/AdminUsers.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#edit-user-modal").removeClass("hidden");
        $("#edit-user-modal").addClass("block");

        if (res.data.position == "Хигиенист") {
          $('#user-position-edit option[value="Хигиенист"]').attr(
            "selected",
            "selected"
          );
        } else if (res.data.position == "Шофьор") {
          $('#user-position-edit option[value="Шофьор"]').attr(
            "selected",
            "selected"
          );
        }

        $("#user-id").val(res.data.id);
        $("#user-name-edit").val(res.data.name);
        $("#user-egn-edit").val(res.data.egn);
        $("#user-dob-edit").val(res.data.dob);
        $("#user-phone-edit").val(res.data.phone);
        $("#user-address-edit").val(res.data.address);
      }
    });
  });

  // Admin update user
  $(document).on("submit", "#edit-user-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("admin_update_user", true);

    postData("../action/AdminUsers.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#edit-user-form")[0].reset();
        $("#edit-user-modal").removeClass("block");
        $("#edit-user-modal").addClass("hidden");
        $("#user-table").load(location.href + " #user-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  closeModal(".close-edit-user-modal", "#edit-user-modal");

  // Get user data for change password
  $(document).on("click", ".edit-user-password", function () {
    var id = $(this).val();

    getData("../action/AdminUsers.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#user-password-modal").removeClass("hidden");
        $("#user-password-modal").addClass("block");

        $("#user-pass-id").val(res.data.id);
        $("#user-username").val(res.data.username);
      }
    });
  });

  closeModal(".close-user-password-modal", "#user-password-modal");

  // Admin set new user password
  $(document).on("submit", "#user-password-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("admin_set_user_password", true);

    postData("../action/AdminUsers.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#user-password-form")[0].reset();
        $("#user-password-modal").removeClass("block");
        $("#user-password-modal").addClass("hidden");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // User search by name and pid
  $("#search-user").on("keyup", function () {
    var text = $(this).val();
    var position = $("#select-position").val();
    var status = $("#select-status").val();

    $.ajax({
      url: "../action/user/Filter.php",
      type: "POST",
      data: {
        text: text,
        position: position,
        status: status,
      },
      success: function (data) {
        $("#user-table").html(data);
      },
    });
  });

  // User position filter
  $("#select-position").on("change", function () {
    var text = $("#search-user").val();
    var position = $(this).val();
    var status = $("#select-status").val();

    $.ajax({
      url: "../action/user/Filter.php",
      type: "POST",
      data: {
        text: text,
        position: position,
        status: status,
      },
      success: function (data) {
        $("#user-table").html(data);
      },
    });
  });

  // User status filter
  $("#select-status").on("change", function () {
    var text = $("#search-user").val();
    var position = $("#select-position").val();
    var status = $(this).val();

    $.ajax({
      url: "../action/user/Filter.php",
      type: "POST",
      data: {
        text: text,
        position: position,
        status: status,
      },
      success: function (data) {
        $("#user-table").html(data);
      },
    });
  });

  openModal("#add-team-btn", "#add-team-modal");

  closeModal(".close-add-team-modal", "#add-team-modal");

  // User1 live secarch add team
  $(document).on("keyup", "#team-user1", function () {
    var user = $(this).val();

    $.ajax({
      url: "../action/team/UserSearch.php",
      type: "POST",
      data: { user: user },
      success: function (data) {
        $("#user-name1-dropdown").removeClass("hidden");
        $("#user-name1-dropdown").html(data);

        if (user == "") {
          $("#user-name1-dropdown").addClass("hidden");
        }
      },
    });
  });

  // Get user1 name and insert in input
  $(document).on("click", ".get-name", function () {
    var selected = $(this).html();
    var getID = $(".user1").html();
    var split = selected.split("-");
    $("#team-user1").val(split[0]);
    $("#team-user1-pid").val(split[1]);
    $("#team-user1-id").val(getID);

    $("#user-name1-dropdown").addClass("hidden");
  });

  // User2 live secarch add team
  $(document).on("keyup", "#team-user2", function () {
    var user = $(this).val();

    $.ajax({
      url: "../action/team/UserSearch2.php",
      type: "POST",
      data: { user: user },
      success: function (data) {
        $("#user-name2-dropdown").removeClass("hidden");
        $("#user-name2-dropdown").html(data);

        if (user == "") {
          $("#user-name2-dropdown").addClass("hidden");
        }
      },
    });
  });

  // Get user2 name and insert in input
  $(document).on("click", ".get-namee", function () {
    var selected = $(this).html();
    var getID = $(".user2").html();
    var split = selected.split("-");
    $("#team-user2").val(split[0]);
    $("#team-user2-pid").val(split[1]);
    $("#team-user2-id").val(getID);

    $("#user-name2-dropdown").addClass("hidden");
  });

  // Admin create team
  $(document).on("submit", "#add-team-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("admin_team", true);

    postData("../action/AdminTeams.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#add-team-form")[0].reset();
        $("#add-team-modal").removeClass("block");
        $("#add-team-modal").addClass("hidden");
        $("#user-table").load(location.href + " #user-table");
        $("#team-table").load(location.href + " #team-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin set order
  $(document).on("click", ".set-order", function () {
    var id = $(this).val();
    $("#user1-set-order").val("");
    $("#user2-set-order").val("");
    $("#select-team").prop("disabled", false);
    $("#hide-set-order-btn").removeClass("hidden");

    getData("../action/AdminOrders.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#set-order-modal").removeClass("hidden");
        $("#set-order-modal").addClass("block");

        if (res.data.team_id == 0) {
          $("#order-id-set").val(res.data.id);
          $("#order-date").val(res.data.date);
        } else {
          var id = res.data.team_id;

          getData("../action/AdminTeams.php?id=" + id, function (response) {
            var res = jQuery.parseJSON(response);

            if (res.status == 404) {
              alertify.error(res.message);
            } else if (res.status == 200) {
              $("#user1-set-order").val(res.data.user1_name);
              $("#user2-set-order").val(res.data.user2_name);
              $("#select-team").append(
                "<option selected>" + res.data.name + "</option>"
              );
              $("#select-team").prop("disabled", "disabled");
              $("#hide-set-order-btn").addClass("hidden");
            }
          });
        }
      }
    });

    var actionOr = "data";

    $.ajax({
      url: "../action/team/Select.php",
      type: "POST",
      data: {
        actionOr: actionOr,
      },
      success: function (data) {
        $("#select-team").html(data);
      },
    });
  });

  // Admin select team for order
  $("#select-team").on("change", function () {
    var id = $(this).val();

    getData("../action/AdminTeams.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#team-id-set").val(res.data.id);
        $("#team-name-set").val(res.data.name);
        $("#user1-set-order").val(res.data.user1_name);
        $("#user1-id-set-order").val(res.data.user1_id);
        $("#user2-set-order").val(res.data.user2_name);
        $("#user2-id-set-order").val(res.data.user2_id);
      }
    });
  });

  // Admin set order
  $(document).on("submit", "#set-order-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("admin_set_order", true);

    postData("../action/adminOrders.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#set-order-form")[0].reset();
        $("#set-order-modal").removeClass("block");
        $("#set-order-modal").addClass("hidden");
        $("#order-table").load(location.href + " #order-table");
        $("#team-table").load(location.href + " #team-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  closeModal(".close-set-order-modal", "#set-order-modal");

  // Admin show setted orders
  $(document).on("click", ".prevOrd", function () {
    $("#team-order-modal").removeClass("hidden");
    $("#team-order-modal").addClass("block");
    var teamId = $(this).val();

    $.ajax({
      url: "../action/team/TeamOrders.php",
      type: "POST",
      data: {
        teamId: teamId,
      },
      success: function (data) {
        $("#team-orders").html(data);
      },
    });
  });

  closeModal(".close-team-order-modal", "#team-order-modal");

  // Admin delete modal team
  $(document).on("click", ".delete-team", function () {
    $("#delete-team-modal").removeClass("hidden");
    $("#delete-team-modal").addClass("block");
    $("#delete-team-id").val($(this).val());
  });

  closeModal(".close-delete-team-modal", "#delete-team-modal");

  // Team search by id or name
  $("#search-team").on("keyup", function () {
    var text = $(this).val();

    $.ajax({
      url: "../action/team/Filter.php",
      type: "POST",
      data: {
        text: text,
      },
      success: function (data) {
        $("#team-table").html(data);
      },
    });
  });

  // Admin delete team
  $(document).on("submit", "#delete-team-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("admin_delete_team", true);

    postData("../action/adminTeams.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#delete-team-modal").removeClass("block");
        $("#delete-team-modal").addClass("hidden");
        $("#user-table").load(location.href + " #user-table");
        $("#team-table").load(location.href + " #team-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Mobile login
  $(document).on("submit", "#mobile-login-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("mobile_login", true);

    postData("../action/Mobile.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        location.reload();
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Mobile logout
  $("#mobile-log-out").on("click", function () {
    var action = "data";

    $.ajax({
      url: "../action/Mobile.php",
      type: "POST",
      data: { action: action },
      success: function (response) {
        var res = jQuery.parseJSON(response);

        if (res.status == 200) {
          location.reload();
        }
      },
    });
  });

  // Mobile update password
  $(document).on("submit", "#update-password-mobile-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("mobile_password_update", true);

    postData("../action/Mobile.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#update-password-mobile-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Check selected radio input
  function getChecklistItems() {
    var result = $("input:radio:checked").get();

    var data = $.map(result, function (element) {
      return $(element).val();
    });

    return data.join("-");
  }

  $(".order-state-btn").on("click", function () {
    $("#active-btn").val($(this).attr("id"));
  });

  // Mobile sort order
  $("#search-mobile-order").on("keyup", function () {
    var text = $(this).val();
    var orderBy = getChecklistItems();
    var orderState = $("#active-btn").val();

    if (orderState == 1) {
      $.ajax({
        url: "../action/mobile/Sort.php",
        type: "POST",
        data: { text: text, orderBy: orderBy },
        success: function (response) {
          $("#active-order-section").html(response);
        },
      });
    } else {
      $.ajax({
        url: "../action/mobile/Sort1.php",
        type: "POST",
        data: { text: text, orderBy: orderBy },
        success: function (response) {
          $("#finished-order-section").html(response);
        },
      });
    }
  });

  $(document).on("click", ".update-order-steps", function () {
    $("#active-order-account").load(location.href + " #active-order-account");
  });

  // Mobile get order data
  $(document).on("click", ".get-order-data", function () {
    var id = $(this).val();

    $(".order-start-loader").removeClass("hidden");
    $(".order-start-loader").addClass("block");

    getData("../action/adminOrders.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        if (res.data.status == "В процес") {
          $(".open-photo-modal").val(res.data.email);
          $("#end-order").val(res.data.id);
          $("#mobOrder").addClass("hidden");
          $("#order-not-started").removeClass("block");
          $("#order-not-started").addClass("hidden");
          $("#order-is-started").removeClass("hidden");
          $("#order-is-started").addClass("block");
        } else {
          $(".open-photo-modal").val(res.data.email);
          $("#end-order").val(res.data.id);
          $("#mobOrder").addClass("hidden");
          $("#order-not-started").removeClass("hidden");
          $("#order-not-started").addClass("block");
          $("#order-is-started").removeClass("block");
          $("#order-is-started").addClass("hidden");
          $(".start-order-btn").val(res.data.id + " " + res.data.team_id);
          $("#customer-name-mobile").html(res.data.customer_name);
          $("#address-mobile").html(res.data.address);
          $("#pay-mobile").html(res.data.pay);
          $("#offer-mobile").html(res.data.offer);
          var date = res.data.date.split("-");
          $("#date-time-mobile").html(
            date[2] + "." + date[1] + "." + date[0] + " - " + res.data.time
          );
          $("#m2-mobile").html(res.data.m2 + " m2");
          $("#price-mobile").html(res.data.price + " лв.");
          $("#phone-mobile").html(res.data.phone);

          if (res.data.information != "") {
            $("#information-mobile").html(res.data.information);
          } else {
            $("#information-mobile").html("Няма допънителна информация");
          }

          if (
            res.data.status == "Отказана" ||
            res.data.status == "Приключена"
          ) {
            $("#order-start-btn").removeClass("flex");
            $("#order-start-btn").addClass("hidden");
          } else {
            $("#order-start-btn").removeClass("hidden");
            $("#order-start-btn").addClass("flex");
          }
        }

        $(".order-start-loader").removeClass("block");
        $(".order-start-loader").addClass("hidden");
      }
    });
  });

  $(document).on("click", ".open-photo-modal", function () {
    var email = $(this).val();

    $("#order-photo-modal").removeClass("hidden");
    $("#order-photo-modal").addClass("block");

    getData("../action/adminOrders.php?email=" + email, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        if (res.data.image_room1 != null) {
          $(".image-modal").addClass("max-w-sm");
          $("#first_img").removeClass("hidden");
          $("#first_img").addClass("block");
          $("#first_img").attr(
            "src",
            "../uploaded-files/room-images/" + res.data.image_room1
          );
        } else {
          $("#first_img").removeClass("block");
          $("#first_img").addClass("hidden");
        }

        if (res.data.image_room2 != null) {
          $(".image-modal").addClass("max-w-lg");
          $("#second_img").removeClass("hidden");
          $("#second_img").addClass("block");
          $("#second_img").attr(
            "src",
            "../uploaded-files/room-images/" + res.data.image_room2
          );
        } else {
          $("#second_img").removeClass("block");
          $("#second_img").addClass("hidden");
        }

        if (res.data.image_room3 != null) {
          $(".image-modal").addClass("max-w-3xl");
          $("#third_img").removeClass("hidden");
          $("#third_img").addClass("block");
          $("#third_img").attr(
            "src",
            "../uploaded-files/room-images/" + res.data.image_room3
          );
        } else {
          $("#third_img").removeClass("block");
          $("#third_img").addClass("hidden");
        }
      }
    });
  });

  // Set steps from order
  $(".next-step-mobile").on("click", function () {
    const id = $("#end-order").val();
    const step = $(this).val();

    $.ajax({
      url: "../action/Mobile.php",
      type: "POST",
      data: { step: step, id: id },
      success: function (response) {},
    });
  });

  // Mobile start order
  $(".start-order-btn").on("click", function () {
    var orderId = $(this).val();

    $.ajax({
      url: "../action/Mobile.php",
      type: "POST",
      data: { orderId: orderId },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 200) {
          $("#active-order-section").load(
            location.href + " #active-order-section"
          );
          $("#order-not-started").removeClass("block");
          $("#order-not-started").addClass("hidden");
          $("#order-is-started").removeClass("hidden");
          $("#order-is-started").addClass("block");
        } else if (res.status == 500) {
          alertify.error(res.message);
        }
      },
    });
  });

  // Mobile end order
  $("#end-order").on("click", function () {
    var orderEndId = $(this).val();

    $.ajax({
      url: "../action/Mobile.php",
      type: "POST",
      data: { orderEndId: orderEndId },
      success: function (response) {
        var res = jQuery.parseJSON(response);

        if (res.status == 200) {
          location.reload();
        }
      },
    });
  });

  // Mobile cancel order
  $(document).on("submit", "#order-cancel-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("mobile_cancel_order", true);

    postData("../action/Mobile.php", formData, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#cancel-order-modal").removeClass("block");
        $("#cancel-order-modal").addClass("hidden");
        location.reload();
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Dashboard cancel reason modal
  $(".show-cancel-dashboard").on("click", function () {
    var id = $(this).val();
    $("#cancel-order-reason-modal").removeClass("hidden");
    $("#cancel-order-reason-modal").addClass("block");

    getData("../action/adminOrders.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#cancel-reason-textarea").val(res.data.cancel_reason);
      }
    });
  });

  // Account get order id and team id
  $(".open-rating-modal").on("click", function () {
    const id = $(this).val().split(" ");
    $("#get-order-id").val(id[0]);
    $("#get-team-id").val(id[1]);
  });

  const getJson = async (id) => {
    const url = `../action/adminOrders.php?id=${id}`;
    const response = await fetch(url);
    const text = await response.text();
    const data = JSON.parse(text).data;
    return data;
  };

  $(".print-invoice").on("click", async function () {
    var id = $(this).val();
    const myData = await getJson(id);
    const prEl = await print(myData);
  });

  async function print(jsonData) {
    const preparePrint = () => {
      var winPrint = window.open(
        "",
        "",
        "left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0"
      );

      winPrint.document.write(
        `<!DOCTYPE html>
		<html>
			<head>
				<script src="https:cdn.tailwindcss.com"></script>
				<title>Фактура-${jsonData.customer_name}-${jsonData.date}</title>

				<style>
				@media print {
					@page {
						margin-top: 0;
						margin-bottom: 0;
					}
					body {
						padding-top: 72px;
						padding-bottom: 72px ;
					}
				}
				</style>
			</head>
		<body>
			<div class="text-blue-700 font-bold text-4xl mt-16">${
        jsonData.company_name
      }</div>
			<div class="text-blue-500 mt-1 text-2xl font-semibold">${jsonData.date
        .replaceAll("-", ".")
        .split(".")
        .reverse()
        .join(".")}</div>
      <div class="text-blue-700 text-2xl font-semibold mt-16">ФАКТУРА №${
        jsonData.id
      }</div>
      <div class="w-full flex mt-3 text-slate-700">
        <div class="w-1/2">
            <div class="p-2.5 text-center text-xl bg-blue-100 font-semibold border border-blue-600">Клиентски данни</div>
             <div class="p-2.5 border border-t-0 border-blue-600">
                <div class="flex items-center">
                  <span class="font-semibold mr-2">Име:</span><span>${
                    jsonData.customer_name
                  }</span>
                </div>
                <div class="flex items-center mt-1.5">
                  <span class="font-semibold mr-2">Телефон:</span><span>${
                    jsonData.phone
                  }</span>
                </div>
                <div class="flex items-center mt-1.5">
                  <span class="font-semibold mr-2">Адрес:</span><span>${
                    jsonData.city + ", " + jsonData.address
                  }</span>
                </div>
            </div>
        </div>
        <div class="w-1/2">
            <div class="p-2.5 text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">Фирмени данни</div>
            <div class="p-2.5 border border-t-0 border-l-0 border-blue-600">
                <div class="flex items-center">
                  <span class="font-semibold mr-2">Име:</span><span>${
                    jsonData.company_name
                  }</span>
                </div>
                <div class="flex items-center mt-1.5">
                  <span class="font-semibold mr-2">ЕИК:</span><span>${
                    jsonData.company_eik
                  }</span>
                </div>
                <div class="flex items-center mt-1.5">
                  <span class="font-semibold mr-2">Адрес:</span><span>${
                    jsonData.city + ", " + jsonData.address
                  }</span>
                </div>
            </div>
        </div>
      </div>
      <div class="mt-5">
        <div class="flex text-slate-700">
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-blue-600">
            Номер
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">
            Услуга
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">
            Оферта
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">
            ДДС
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">
            Крайна цена
          </div>
        </div>
        <div class="flex text-slate-700">
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border-t-0 border border-blue-600">
            ${jsonData.id}
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border border-t-0 border-l-0 border-blue-600">
            Почистване
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border border-t-0 border-l-0 border-blue-600">
           ${jsonData.offer}
          </div>
           <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border border-t-0 border-l-0 border-blue-600">
           ${(jsonData.price * 1.2 - jsonData.price).toFixed(2)} лв.
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border border-t-0 border-l-0 border-blue-600">
            ${jsonData.price} лв.
          </div>
        </div>
      </div>
      <div class="text-blue-700 text-xl font-semibold mt-4">Благодарим Ви, че избрахте нас !</div>
      <div class="text-slate-700 text-xl font-semibold">Carpet Services</div>
      <div class="text-slate-700 mt-13">Варна, ул. Васил Гергов 26</div>
		</body>
		</html>`
      );

      return winPrint;
    };
    const printeEl = await await preparePrint(jsonData);
    setTimeout(() => {
      printeEl.print();
    }, 100);
  }

  openModal("#add-product-btn", "#add-product-modal");

  closeModal(".close-add-product-modal", "#add-product-modal");

  openModal(".open-rating-modal", "#customer-opinion-modal");

  closeModal(".close-customer-opinion-modal", "#customer-opinion-modal");

  closeModal(".cancel-order-reason-modal", "#cancel-order-reason-modal");

  openModal(".open-cancel-modal", "#cancel-order-modal");

  closeModal(".close-cancel-order-modal", "#cancel-order-modal");

  openModal("#sort-btn", "#sort-order-modal");

  closeModal(".close-sort-order-modal", "#sort-order-modal");

  openModal("#show-product-btn", "#product-show-modal");

  closeModal(".close-show-product-modal", "#product-show-modal");

  openModal("#make-order-btn", "#product-order-modal");

  closeModal(".close-product-order-modal", "#product-order-modal");

  closeModal(".close-order-photo-modal", "#order-photo-modal");

  $("#active-order").html($(".active-order-count").val());

  $("#finished-order").html($(".finished-order-count").val());

  $("#order-btn").on("click", function () {
    $("#order-not-started").addClass("hidden");
    $("#order-is-started").addClass("hidden");
    $("#mobOrder").removeClass("hidden");
    $("#mobOrder").addClass("block");
  });

  $("#profile-btn").on("click", function () {
    $("#order-not-started").addClass("hidden");
    $("#order-is-started").addClass("hidden");
    $("#mobOrder").removeClass("hidden");
    $("#mobOrder").addClass("block");
  });

  $("#warehouse-btn").on("click", function () {
    $("#order-not-started").addClass("hidden");
    $("#order-is-started").addClass("hidden");
    $("#mobOrder").removeClass("hidden");
    $("#mobOrder").addClass("block");
  });
});
