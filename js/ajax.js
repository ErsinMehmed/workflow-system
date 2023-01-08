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

    var userEmail = $("#getCutomerEmail").val();

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

  // Guest make order
  $(document).on("submit", "#guest-order-form", function (e) {
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
      if (res.status == 404) {
        alert(res.message);
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

  // Delete room image
  $(".room-img").on("click", function () {
    var imgID = $(this).attr("id");

    $.ajax({
      url: "../action/customer.php",
      type: "POST",
      data: {
        imgID: imgID,
      },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 200) {
          $("#document-section").load(location.href + " #document-section");
          alertify.success(res.message);
        } else if (res.status == 500) {
          alertify.error(res.message);
        }
      },
    });
  });

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
      if (res.status == 404) {
        alert(res.message);
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
        $("#infomation-edit").val(res.data.information);
        $("#customer-price-edit").val(res.data.price + " лв.");
      }
    });
  });

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
      if (res.status == 404) {
        alert(res.message);
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
      if (res.status == 404) {
        alert(res.message);
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
        $("#team-name").val(res.data.name);
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
      console.log(response);
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
});
