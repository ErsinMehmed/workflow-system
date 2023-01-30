$(document).ready(function () {
  function postFormData(url, data, success) {
    return $.ajax({
      type: "POST",
      url: url,
      data: data,
      processData: false,
      contentType: false,
      success: success,
    });
  }

  function postData(url, data, success) {
    return $.ajax({
      url: url,
      type: "POST",
      data: data,
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

  function closeModal(modalID) {
    $(modalID).removeClass("block");
    $(modalID).addClass("hidden");
  }

  function openModal(modalID) {
    $(modalID).removeClass("hidden");
    $(modalID).addClass("block");
  }

  alertify.set("notifier", "position", "top-center");

  // Customer register
  $(document).on("submit", "#sign-in-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("save_customer", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#customer-register-modal");
        $("#sign-in-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Customer login
  $(document).on("submit", "#sing-up-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("login_info", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        window.location.href = "account";
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

    const formData = new FormData(this);
    formData.append("update_customer", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

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

    const formData = new FormData(this);
    formData.append("update_customer_image", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 200) {
        location.reload(true);
      }
    });
  });

  // Update customer password
  $(document).on("submit", "#update-customer-password", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("update_customer_password", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        alertify.success(res.message);
        $("#update-customer-password")[0].reset();
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Customer profile logout
  $("#log-out").on("click", function () {
    const action = "data";

    postData("action/Customer.php", { action: action }, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        window.location.href = "/";
      }
    });
  });

  // Customer make order
  $(document).on("submit", "#customer-order-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("customer_order", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#history-section-load").load(
          location.href + " #history-section-load"
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

    const formData = new FormData(this);
    formData.append("customer_rate", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#customer-opinion-modal");
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
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("guest_order", true);

    postFormData("action/Order.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

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
    const id = $(this).val();

    getData("action/Customer.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#history-modal");
        var date = res.data.add_date.split(" ");
        const finalDate = date[0].split("-");

        $("#add_date").html(
          finalDate[2] + "." + finalDate[1] + "." + finalDate[0]
        );
        $("#add_time").html(date[1].slice(0, -3));
        $("#customer_name").html(res.data.customer_name);
        $("#customer_phone").html(res.data.phone);
        $("#customer_building").html(res.data.room);
        $("#customer_offer").html(res.data.offer);

        var date = res.data.date.split("-");
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
    const date = $(this).val();
    const offer = $("#account-offers").val();

    postData(
      "action/customer/Filter.php",
      { date: date, offer: offer },
      function (data) {
        $("#history-section").html(data);
      }
    );
  });

  // Offer filter history section
  $("#account-offers").on("change", function () {
    const offer = $(this).val();
    const date = $("#date-picker-account").val();

    postData(
      "action/customer/Filter.php",
      { date: date, offer: offer },
      function (data) {
        $("#history-section").html(data);
      }
    );
  });

  // Customer upload room image form
  $(document).on("submit", "#room-images-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("customer_upload_room", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        $("#document-section").load(location.href + " #document-section");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Open delete room image modal
  $(document).on("click", ".room-img", function (e) {
    $("#delete-img-id").val($(this).attr("id"));
    openModal("#delete-customer-img-modal");
  });

  // Delete room image
  $(document).on("submit", "#delete-customer-img-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("delete_customer_img", true);

    postFormData("action/Customer.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#delete-customer-img-modal");
        $("#document-section").load(location.href + " #document-section");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin make order
  $(document).on("submit", "#add-order-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_order", true);

    postFormData("action/AdminOrders.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#add-order-modal");
        $("#order-table").load(location.href + " #order-table");
        $("#add-order-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Get order data for edit
  $(document).on("click", ".edit-order", function () {
    const id = $(this).val();

    getData("action/AdminOrders.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#order-modal");

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

  // Customer opinion modal
  $(document).on("click", ".view-customer-opinion", function () {
    const id = $(this).val();

    getData("action/AdminOrders.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#customer-opinion-modal");
        $("#customer-opinion-orders").val(res.data.customer_opinion);
      }
    });
  });

  // Update order data
  $(document).on("submit", "#update-order-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_order_update", true);

    postFormData("action/AdminOrders.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#order-modal");
        $("#order-table").load(location.href + " #order-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Send invoice to customer profile
  $(document).on("click", ".send-invoice", function (e) {
    const orderIdInvoice = $(this).val();

    postData(
      "action/AdminOrders.php",
      { orderIdInvoice: orderIdInvoice },
      function (response) {
        const res = jQuery.parseJSON(response);

        if (res.status == 200) {
          $("#order-table").load(location.href + " #order-table");
          alertify.success(res.message);
        } else if (res.status == 500) {
          alertify.error(res.message);
        }
      }
    );
  });

  // Show customer information
  $(document).on("click", ".show-customer", function () {
    const email = $(this).val();

    getData("action/AdminOrders.php?email=" + email, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#customer-order-modal");

        $("#customer-name-show").val(res.data.name);
        $("#customer-phone-show").val(res.data.phone);
        $("#customer-email-show").val(res.data.email);
        $("#customer-address-show").val(res.data.address);

        const date = res.data.created_at.split(" ");
        const finalDate = date[0].split("-");
        $("#customer-created").val(
          finalDate[2] + "." + finalDate[1] + "." + finalDate[0]
        );
      }
    });
  });

  // Date filter dashboard order section
  $("#order-filter-date").on("change", function () {
    const date = $(this).val();
    const text = $("#search-order").val();

    postData(
      "action/orders/Filter.php",
      { date: date, text: text },
      function (data) {
        $("#order-table").html(data);
      }
    );
  });

  // Text filter dashboard order section
  $("#search-order").on("keyup", function () {
    const text = $(this).val();
    const date = $("#order-filter-date").val();

    postData(
      "action/orders/Filter.php",
      { date: date, text: text },
      function (data) {
        $("#order-table").html(data);
      }
    );
  });

  // text filter dashboard supplier section
  $("#search-supplier").on("keyup", function () {
    const text = $(this).val();

    postData("action/supplier/Filter.php", { text: text }, function (data) {
      $("#supplier-table").html(data);
    });
  });

  // Admin create user
  $(document).on("submit", "#add-user-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_user", true);

    postFormData("action/AdminUsers.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#add-user-modal");
        $("#add-user-form")[0].reset();
        $("#user-table").load(location.href + " #user-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Get user data for edit
  $(document).on("click", ".edit-user", function () {
    const id = $(this).val();

    getData("action/AdminUsers.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#edit-user-modal");

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

  // Get supplier data for edit
  $(document).on("click", ".edit-supplier", function () {
    const id = $(this).val();

    getData("action/AdminSuppliers.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#supplier-edit-modal");

        $("#supplier-id").val(res.data.id);
        $("#supplier-name-edit").val(res.data.name);
        $("#supplier-phone-edit").val(res.data.phone);
        $("#supplier-address-edit").val(res.data.address);
        $("#supplier-iban-edit").val(res.data.iban);
      }
    });
  });

  // Admin update user
  $(document).on("submit", "#edit-user-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_update_user", true);

    postFormData("action/AdminUsers.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#edit-user-modal");
        $("#user-table").load(location.href + " #user-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Get user data for change password
  $(document).on("click", ".edit-user-password", function () {
    const id = $(this).val();

    getData("action/AdminUsers.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 500) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#user-password-modal");

        $("#user-pass-id").val(res.data.id);
        $("#user-username").val(res.data.username);
      }
    });
  });

  // Admin set new user password
  $(document).on("submit", "#user-password-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_set_user_password", true);

    postFormData("action/AdminUsers.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#user-password-modal");
        $("#user-password-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // User search by name and pid
  $("#search-user").on("keyup", function () {
    const text = $(this).val();
    const position = $("#select-position").val();
    const status = $("#select-status").val();

    postData(
      "action/user/Filter.php",
      { position: position, text: text, status: status },
      function (data) {
        $("#user-table").html(data);
      }
    );
  });

  // User position filter
  $("#select-position").on("change", function () {
    const text = $("#search-user").val();
    const position = $(this).val();
    const status = $("#select-status").val();

    postData(
      "action/user/Filter.php",
      { position: position, text: text, status: status },
      function (data) {
        $("#user-table").html(data);
      }
    );
  });

  // User status filter
  $("#select-status").on("change", function () {
    const text = $("#search-user").val();
    const position = $("#select-position").val();
    const status = $(this).val();

    postData(
      "action/user/Filter.php",
      { position: position, text: text, status: status },
      function (data) {
        $("#user-table").html(data);
      }
    );
  });

  // Stock search by name
  $(document).on("keyup", "#product-order-name", function () {
    const product = $(this).val();

    postData(
      "action/product/ProductSearch.php",
      { product: product },
      function (data) {
        $("#product-name-dropdown").toggleClass(
          "hidden",
          data === "" || !product
        );

        if (data !== "") {
          $("#product-name-dropdown").removeClass("hidden");
          $("#product-name-dropdown").html(data);

          $(window).click(function () {
            $("#product-name-dropdown").addClass("hidden");
          });
        }
      }
    );
  });

  // Search stock supplier by name
  $(document).on("keyup", "#product-order-supplier", function () {
    const supplier = $(this).val();

    postData(
      "action/product/SupplierSearch.php",
      { supplier: supplier },
      function (data) {
        $("#supplier-name-dropdown").toggleClass(
          "hidden",
          data === "" || !supplier
        );

        if (data !== "") {
          $("#supplier-name-dropdown").removeClass("hidden");
          $("#supplier-name-dropdown").html(data);

          $(window).click(function () {
            $("#supplier-name-dropdown").addClass("hidden");
          });
        }
      }
    );
  });

  // Product search by name
  $(document).on("keyup", "#set-product-name", function () {
    const product = $(this).val();

    postData(
      "action/product/ProductSearch1.php",
      { product: product },
      function (data) {
        $("#set-product-name-dropdown").removeClass("hidden");
        $("#set-product-name-dropdown").html(data);

        if (!product) {
          $("#set-product-name-dropdown").addClass("hidden");
        }

        $(window).click(function () {
          $("#set-product-name-dropdown").addClass("hidden");
        });
      }
    );
  });

  // Get supplier name and insert in input
  $(document).on("click", ".get-order-supplier", function () {
    const selected = $(this).html();
    $("#product-order-supplier").val(selected);
    $("#supplier-name-dropdown").addClass("hidden");
  });

  // Get stock name and insert in input
  $(document).on("click", ".get-product-name1", function () {
    const selected = $(this).html();
    $("#set-product-name").val(selected);
    $("#set-product-name-dropdown").addClass("hidden");
  });

  // Get stock name and insert in input
  $(document).on("click", ".get-product-name", function () {
    const selected = $(this).html();
    $("#product-order-name").val(selected);
    $("#product-name-dropdown").addClass("hidden");
  });

  // User1 search add team
  $(document).on("keyup", "#team-user1", function () {
    const user = $(this).val();

    postData("action/team/UserSearch.php", { user: user }, function (data) {
      $("#user-name1-dropdown").removeClass("hidden");
      $("#user-name1-dropdown").html(data);

      if (!user) {
        $("#user-name1-dropdown").addClass("hidden");
      }

      $(window).click(function () {
        $("#user-name1-dropdown").addClass("hidden");
      });
    });
  });

  // Get user1 name and insert in input
  $(document).on("click", ".get-name", function () {
    const selected = $(this).html();
    const getID = $(".user1").html();
    const split = selected.split("-");

    $("#team-user1").val(split[0]);
    $("#team-user1-pid").val(split[1]);
    $("#team-user1-id").val(getID);

    $("#user-name1-dropdown").addClass("hidden");
  });

  // User2 live search add team
  $(document).on("keyup", "#team-user2", function () {
    const user = $(this).val();

    postData("action/team/UserSearch2.php", { user: user }, function (data) {
      $("#user-name2-dropdown").removeClass("hidden");
      $("#user-name2-dropdown").html(data);

      if (!user) {
        $("#user-name2-dropdown").addClass("hidden");
      }

      $(window).click(function () {
        $("#user-name2-dropdown").addClass("hidden");
      });
    });
  });

  // Get user2 name and insert in input
  $(document).on("click", ".get-namee", function () {
    const selected = $(this).html();
    const getID = $(".user2").html();
    const split = selected.split("-");

    $("#team-user2").val(split[0]);
    $("#team-user2-pid").val(split[1]);
    $("#team-user2-id").val(getID);

    $("#user-name2-dropdown").addClass("hidden");
  });

  // Admin create team
  $(document).on("submit", "#add-team-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_team", true);

    postFormData("action/AdminTeams.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#add-team-modal");
        $("#add-team-form")[0].reset();
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
    const id = $(this).val();
    $("#user1-set-order").val("");
    $("#user2-set-order").val("");
    $("#select-team").prop("disabled", false);
    $("#hide-set-order-btn").removeClass("hidden");

    getData("action/AdminOrders.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        openModal("#set-order-modal");

        if (res.data.team_id == 0) {
          $("#order-id-set").val(res.data.id);
          $("#order-date").val(res.data.date);
        } else {
          const id = res.data.team_id;

          getData("action/AdminTeams.php?id=" + id, function (response) {
            const res = jQuery.parseJSON(response);

            if (res.status == 200) {
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

    const actionOr = "data";

    postData("action/team/Select.php", { actionOr: actionOr }, function (data) {
      $("#select-team").html(data);
    });
  });

  $(document).on("click", "#set-product", function () {
    const actionOr = "data";

    postData("action/team/Select.php", { actionOr: actionOr }, function (data) {
      $("#set-product-modal").removeClass("hidden");
      $("#set-product-modal").addClass("block");
      $("#select-team-product").html(data);
    });
  });

  // Admin select team for order
  $("#select-team").on("change", function () {
    const id = $(this).val();

    getData("action/AdminTeams.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);
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

  // Get data for product
  $(document).on("click", ".edit-product", function () {
    const id = $(this).val();

    getData("action/AdminWarehouse.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#edit-product-modal");

        $("#product-id-edit").val(res.data.id);
        $("#product-name-edit").val(res.data.name);

        if (res.data.kind == "Препарати") {
          $('#product-kind-edit option[value="Препарати"]').attr(
            "selected",
            "selected"
          );
        } else if (res.data.kind == "Техника") {
          $('#product-kind-edit option[value="Техника"]').attr(
            "selected",
            "selected"
          );
        } else if (res.data.kind == "Екипировка") {
          $('#product-kind-edit option[value="Екипировка"]').attr(
            "selected",
            "selected"
          );
        } else {
          $('#product-kind-edit option[value="Пособия за чистене"]').attr(
            "selected",
            "selected"
          );
        }
      }
    });
  });

  // Admin create product order
  $(document).on("submit", "#add-product-order-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_product_order", true);

    postFormData("action/AdminProducts.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#add-order-product-modal");
        $("#add-product-order-form")[0].reset();
        $("#product-table").load(location.href + " #product-table");
        $("#product-order-table").load(location.href + " #product-order-table");
        $("#supplier-table").load(location.href + " #supplier-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin set order
  $(document).on("submit", "#set-order-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_set_order", true);

    postFormData("action/AdminOrders.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#set-order-modal");
        $("#set-order-form")[0].reset();
        $("#order-table").load(location.href + " #order-table");
        $("#team-table").load(location.href + " #team-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin show setted orders
  $(document).on("click", ".prevOrd", function () {
    openModal("#team-order-modal");
    const teamId = $(this).val();

    postData("action/team/TeamOrders.php", { teamId: teamId }, function (data) {
      $("#team-orders").html(data);
    });
  });

  // Admin show supplier orders
  $(document).on("click", ".supplier-order-view", function () {
    openModal("#supplier-order-view-modal");
    const supplierName = $(this).val();

    postData(
      "action/supplier/SupplierOrders.php",
      { supplierName: supplierName },
      function (data) {
        $("#supplier-orders").html(data);
      }
    );
  });

  // Admin delete team modal open
  $(document).on("click", ".delete-team", function () {
    openModal("#delete-team-modal");
    $("#delete-team-id").val($(this).val());
  });

  // Admin delete product modal open
  $(document).on("click", ".delete-product", function () {
    openModal("#delete-product-modal");
    $("#delete-product-id").val($(this).val());
  });

  // Admin delete supplier modal open
  $(document).on("click", ".delete-supplier", function () {
    openModal("#delete-supplier-modal");
    $("#delete-supplier-id").val($(this).val());
  });

  // Product search by id or name
  $("#search-product").on("keyup", function () {
    const text = $(this).val();
    const kind = $("#select-product-kind").val();

    postData(
      "action/product/Filter.php",
      { text: text, kind: kind },
      function (data) {
        $("#product-table").html(data);
      }
    );
  });

  // Product filter by kind
  $("#select-product-kind").on("change", function () {
    const kind = $(this).val();
    const text = $("#search-product").val();

    postData(
      "action/product/Filter.php",
      { text: text, kind: kind },
      function (data) {
        $("#product-table").html(data);
      }
    );
  });

  // Product search by id or name
  $("#search-order-product").on("keyup", function () {
    const text = $(this).val();
    const kind = $("#select-order-product-kind").val();

    postData(
      "action/product/Filter1.php",
      { text: text, kind: kind },
      function (data) {
        $("#product-order-table").html(data);
      }
    );
  });

  $("#select-order-product-kind").on("change", function () {
    const kind = $(this).val();
    const text = $("#search-order-product").val();

    postData(
      "action/product/Filter1.php",
      { text: text, kind: kind },
      function (data) {
        $("#product-order-table").html(data);
      }
    );
  });

  // Search team by name
  $("#search-team").on("keyup", function () {
    const text = $(this).val();

    postData("action/team/Filter.php", { text: text }, function (data) {
      $("#team-table").html(data);
    });
  });

  // Admin delete team
  $(document).on("submit", "#delete-team-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_delete_team", true);

    postFormData("action/adminTeams.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#delete-team-modal");
        $("#user-table").load(location.href + " #user-table");
        $("#team-table").load(location.href + " #team-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin delete product order
  $(document).on("submit", "#delete-product-order-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_delete_team", true);

    postFormData("action/AdminProducts.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#delete-product-order-modal");
        $("#product-table").load(location.href + " #product-table");
        $("#product-order-table").load(location.href + " #product-order-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin delete supplier
  $(document).on("submit", "#delete-supplier-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_delete_supplier", true);

    postFormData("action/AdminSuppliers.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#delete-supplier-modal");
        $("#supplier-table").load(location.href + " #supplier-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin delete product
  $(document).on("submit", "#delete-product-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_delete_product", true);

    postFormData("action/AdminWarehouse.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#delete-product-modal");
        $("#product-table").load(location.href + " #product-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin add product
  $(document).on("submit", "#add-product-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_product", true);

    postFormData("action/AdminWarehouse.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#add-product-modal");
        $("#product-table").load(location.href + " #product-table");
        $("#add-product-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin edit product
  $(document).on("submit", "#edit-product-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_edit_product", true);

    postFormData("action/AdminWarehouse.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#edit-product-modal");
        $("#product-table").load(location.href + " #product-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin edit supplier
  $(document).on("submit", "#supplier-edit-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_edit_supplier", true);

    postFormData("action/AdminSuppliers.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#supplier-edit-modal");
        $("#supplier-table").load(location.href + " #supplier-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin set product to team
  $(document).on("submit", "#set-product-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_set_product", true);

    postFormData("action/AdminWarehouse.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#set-product-modal");
        $("#product-table").load(location.href + " #product-table");
        $("#set-product-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin add supplier
  $(document).on("submit", "#add-supplier-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_supplier", true);

    postFormData("action/AdminSuppliers.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#add-supplier-modal");
        $("#supplier-table").load(location.href + " #supplier-table");
        $("#add-supplier-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin dashboard login
  $(document).on("submit", "#dashboard-login-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("dashboard_login", true);

    postFormData("action/Admin.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        location.reload();
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin update data
  $(document).on("submit", "#admin-information-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_update_data", true);

    postFormData("action/Admin.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        alertify.success(res.message);
        $("#first-pass").val("");
        $("#second-pass").val("");
        $("#third-pass").val("");
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin update profile image
  $(document).on("submit", "#admin-image-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("admin_photo", true);

    postFormData("action/Admin.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        alertify.success(res.message);
        $("#admin-photo").load(location.href + " #admin-photo");
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Admin dashboard logout
  $("#admin-logout").on("click", function () {
    const action = "data";

    postData("action/Admin.php", { action: action }, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        location.reload();
      }
    });
  });

  // Mobile login
  $(document).on("submit", "#mobile-login-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("mobile_login", true);

    postFormData("action/Mobile.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        location.reload();
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Mobile logout
  $("#mobile-log-out").on("click", function () {
    const action = "data";

    postData("action/Mobile.php", { action: action }, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        location.reload();
      }
    });
  });

  // Mobile update password
  $(document).on("submit", "#update-password-mobile-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("mobile_password_update", true);

    postFormData("action/Mobile.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

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
    const result = $("input:radio:checked").get();

    const data = $.map(result, function (element) {
      return $(element).val();
    });

    return data.join("-");
  }

  $(".order-state-btn").on("click", function () {
    $("#active-btn").val($(this).attr("id"));
  });

  // Mobile sort order
  $("#search-mobile-order").on("keyup", function () {
    const text = $(this).val();
    const orderBy = getChecklistItems();
    const orderState = $("#active-btn").val();

    if (orderState == 1) {
      postData(
        "action/mobile/Sort.php",
        { text: text, orderBy: orderBy },
        function (response) {
          $("#active-order-section").html(response);
        }
      );
    } else {
      postData(
        "action/mobile/Sort.php",
        { text: text, orderBy: orderBy },
        function (response) {
          $("#finished-order-section").html(response);
        }
      );
    }
  });

  $(document).on("click", ".update-order-steps", function () {
    $("#active-order-account").load(location.href + " #active-order-account");
  });

  // Mobile get order data
  $(document).on("click", ".get-order-data", function () {
    const id = $(this).val();

    openModal(".order-start-loader");

    getData("action/AdminOrders.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        if (res.data.status == "В процес") {
          $(".open-photo-modal").val(res.data.email);
          $("#end-order").val(res.data.id);
          $("#order-id-cancel").val(res.data.id);
          $("#mobOrder").addClass("hidden");
          $("#order-not-started").removeClass("block");
          $("#order-not-started").addClass("hidden");
          $("#order-is-started").removeClass("hidden");
          $("#order-is-started").addClass("block");
        } else {
          $(".open-photo-modal").val(res.data.email);
          $("#end-order").val(res.data.id);
          $("#order-id-cancel").val(res.data.id);
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
          const date = res.data.date.split("-");
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

  // Mobile show customer images
  $(document).on("click", ".open-photo-modal", function () {
    const email = $(this).val();

    getData("action/AdminOrders.php?email=" + email, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status != 404) {
        const imageProperties = [
          { id: "first_img", data: "image_room1", class: "max-w-sm" },
          { id: "second_img", data: "image_room2", class: "max-w-lg" },
          { id: "third_img", data: "image_room3", class: "max-w-3xl" },
        ];

        for (const prop of imageProperties) {
          if (res.data[prop.data] != null && res.status === 200) {
            openModal("#order-photo-modal");

            if (res.data[prop.data] != null) {
              $(".image-modal").addClass(prop.class);
              $(`#${prop.id}`)
                .attr(
                  "src",
                  `uploaded-files/room-images/${res.data[prop.data]}`
                )
                .removeClass("hidden")
                .addClass("block");
            } else {
              $(`#${prop.id}`).removeClass("block").addClass("hidden");
            }
          }
        }
      } else {
        alertify.error("Няма намерени снимки за този клиент");
      }
    });
  });

  // Set steps from order
  $(".next-step-mobile").on("click", function () {
    const id = $("#end-order").val();
    const step = $(this).val();

    postData(
      "action/Mobile.php",
      { step: step, id: id },
      function (response) {}
    );
  });

  // Mobile start order
  $(".start-order-btn").on("click", function () {
    const orderId = $(this).val();

    postData("action/Mobile.php", { orderId: orderId }, function (response) {
      const res = jQuery.parseJSON(response);
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
    });
  });

  // Mobile end order
  $("#end-order").on("click", function () {
    const orderEndId = $(this).val();

    postData(
      "action/Mobile.php",
      { orderEndId: orderEndId },
      function (response) {
        const res = jQuery.parseJSON(response);

        if (res.status == 200) {
          location.reload();
        }
      }
    );
  });

  // Mobile remove product
  $(document).on("click", "#remove-product-btn", function () {
    const productName = $(this).val();
    const teamId = $("#get-team-id-mobile").val();

    postData(
      "action/Mobile.php",
      { productName: productName, teamId: teamId },
      function (response) {
        $("#mobile-warehouse-section").load(
          location.href + " #mobile-warehouse-section"
        );
      }
    );
  });

  // Mobile open return modal
  $(document).on("click", "#return-product-btn", function () {
    $("#get-product-name-return").val($(this).val());
    openModal("#return-product-modal");
  });

  // Mobile return all product
  $(document).on("click", ".return-all-product", function () {
    const productNameReturn = $("#get-product-name-return").val();
    const teamId = $("#get-team-id-mobile").val();

    postData(
      "action/Mobile.php",
      { productNameReturn: productNameReturn, teamId: teamId },
      function (response) {
        closeModal("#return-product-modal");
        $("#mobile-warehouse-section").load(
          location.href + " #mobile-warehouse-section"
        );
      }
    );
  });

  // Mobile return all product
  $(document).on("change", "#get-product-kind", function () {
    const kind = $(this).val();

    postData("action/product/Kind.php", { kind: kind }, function (response) {
      $("#all-product").removeClass("hidden");
      $("#all-product").html(response);
    });
  });

  // Mobile cancel order
  $(document).on("submit", "#order-cancel-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("mobile_cancel_order", true);

    postFormData("action/Mobile.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        location.reload();
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Mobile product request
  $(document).on("submit", "#product-request-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("mobile_product_request", true);

    postFormData("action/Mobile.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#product-order-modal");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  $(document).on("click", ".delete-product-order", function (e) {
    $("#delete-product-order-id").val($(this).val());
    openModal("#delete-product-order-modal");
  });

  // Dashboard cancel reason modal
  $(document).on("click", ".show-cancel-dashboard", function (e) {
    const id = $(this).val();
    openModal("#cancel-order-reason-modal");

    getData("action/AdminOrders.php?id=" + id, function (response) {
      const res = jQuery.parseJSON(response);

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

  $("#seted-product-history-btn").addClass("bg-gray-200");

  // Search setted product history (text)
  $("#product-name-search").on("keyup", function () {
    const productName = $(this).val();
    const searchKind = $("#kind-search").val();
    const date = $("#product-history-date").val();

    postData(
      "action/product/History.php",
      { productName: productName, searchKind: searchKind, date: date },
      function (response) {
        $("#history-search-result").html(response);
      }
    );
  });

  // Search setted product history (date)
  $("#product-history-date").on("change", function () {
    const productName = $("#product-name-search").val();
    const searchKind = $("#kind-search").val();
    const date = $(this).val();

    postData(
      "action/product/History.php",
      { productName: productName, searchKind: searchKind, date: date },
      function (response) {
        $("#history-search-result").html(response);
      }
    );
  });

  // Search setted product history (click)
  $("#seted-product-history-btn").on("click", function () {
    $("#seted-product-history-btn").addClass("bg-gray-200");
    $("#returned-product-history-btn").removeClass("bg-gray-200");
    $("#kind-search").val(0);
    const productName = $("#product-name-search").val();
    const searchKind = $("#kind-search").val();
    const date = $("#product-history-date").val();

    postData(
      "action/product/History.php",
      { productName: productName, searchKind: searchKind, date: date },
      function (response) {
        $("#history-search-result").html(response);
      }
    );
  });

  // Search returned product history (click)
  $("#returned-product-history-btn").on("click", function () {
    $("#seted-product-history-btn").removeClass("bg-gray-200");
    $("#returned-product-history-btn").addClass("bg-gray-200");
    $("#kind-search").val(1);
    const productName = $("#product-name-search").val();
    const searchKind = $("#kind-search").val();
    const date = $("#product-history-date").val();

    postData(
      "action/product/History.php",
      { productName: productName, searchKind: searchKind, date: date },
      function (response) {
        $("#history-search-result").html(response);
      }
    );
  });
});
