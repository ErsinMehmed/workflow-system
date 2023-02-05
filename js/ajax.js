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

  function updateOrdersDateFilter(offset) {
    let date = new Date($("#order-filter-date").val());
    date.setDate(date.getDate() + offset);
    $("#order-filter-date").val(date.toISOString().substr(0, 10));
    date = $("#order-filter-date").val();
    const text = $("#search-order").val();

    postData(
      "action/orders/Filter.php",
      { date: date, text: text },
      function (data) {
        $("#order-table").html(data);
      }
    );
  }

  function updateCustomerHistory() {
    const date = $("#date-picker-account").val();
    const offer = $("#account-offers").val();

    postData(
      "action/customer/Filter.php",
      { date: date, offer: offer },
      function (data) {
        $("#history-section").html(data);
      }
    );
  }

  function orderFilters() {
    const date = $("#order-filter-date").val();
    const text = $("#search-order").val();

    postData(
      "action/orders/Filter.php",
      { date: date, text: text },
      function (data) {
        $("#order-table").html(data);
      }
    );
  }

  function adminFilters() {
    const text = $("#search-admin").val();
    const status = $("#select-admin-status").val();

    postData(
      "action/owner/Filter.php",
      { text: text, status: status },
      function (data) {
        console.log(data);
        $("#admin-table").html(data);
      }
    );
  }

  function ownerFilterIncomes() {
    const dateFrom = $("#filter-date-from").val();
    const dateTo = $("#filter-date-to").val();

    if (dateFrom < dateTo) {
      postData(
        "action/owner/DateFilter.php",
        { dateFrom: dateFrom, dateTo: dateTo },
        function (data) {
          $("#income-section").html(data);
        }
      );
    } else {
      alertify.error("Едната дата трябва да бъде по-малка от другата");
    }
  }

  function sendHistorySearchRequest() {
    const productName = $("#product-name-search").val();
    const date = $("#product-history-date").val();
    const searchKind = $("#kind-search").val();

    postData(
      "action/product/History.php",
      { productName, searchKind, date },
      function (response) {
        $("#history-search-result").html(response);
      }
    );
  }

  function productFilter(textInput, kindInput, postUrl, resultDiv) {
    const text = $(textInput).val();
    const kind = $(kindInput).val();

    postData(postUrl, { text: text, kind: kind }, function (data) {
      $(resultDiv).html(data);
    });
  }

  function ownerFilterDate(elementId, direction) {
    let date = new Date($(elementId).val());
    date.setDate(date.getDate() + direction);
    $(elementId).val(date.toISOString().substr(0, 10));
    const dateFrom = $("#filter-date-from").val();
    const dateTo = $("#filter-date-to").val();

    if (dateFrom < dateTo) {
      postData(
        "action/owner/DateFilter.php",
        { dateFrom: dateFrom, dateTo: dateTo },
        function (data) {
          $("#income-section").html(data);
        }
      );
    } else {
      alertify.error("Едната дата трябва да бъде по-малка от другата");
    }
  }

  function filterUsers(text, position, status) {
    postData(
      "action/user/Filter.php",
      { position: position, text: text, status: status },
      function (data) {
        $("#user-table").html(data);
      }
    );
  }

  function searchDropdown(inputId, dropdownId, postDataUrl, postDataKey) {
    const $input = $(inputId);
    const $dropdown = $(dropdownId);

    $input.on("keyup", function () {
      const searchTerm = $(this).val();

      postData(postDataUrl, { [postDataKey]: searchTerm }, function (data) {
        $dropdown.toggleClass("hidden", data === "" || !searchTerm);

        if (data !== "") {
          $dropdown.removeClass("hidden");
          $dropdown.html(data);
        }
      });
    });

    $(document).on("click", function (e) {
      if (!$dropdown.is(e.target) && $dropdown.has(e.target).length === 0) {
        $dropdown.addClass("hidden");
      }
    });
  }

  function insertInputValue(selector, inputElement, dropdownId) {
    $(document).on("click", selector, function () {
      const selected = $(this).html();
      $(inputElement).val(selected);
      $(dropdownId).addClass("hidden");
    });
  }

  function setSelectedOption(selector, value) {
    $(selector)
      .val(value)
      .find(`option[value="${value}"]`)
      .attr("selected", "selected");
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

  // Customer email verify
  $(".email-code").keyup(function () {
    const email = $("#get-customer-email").val();
    const inputs = $(
      "#first-num, #second-num, #third-num, #fourth-num, #fifth-num, #sixth-num"
    );
    const code = inputs
      .map((i, el) => $(el).val())
      .get()
      .join("");

    getData(`action/Customer.php?email=${email}`, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        if (res.data.email_code == code) {
          const verify = $("#get-customer-email").val();

          postData(
            "action/Customer.php",
            { verify: verify },
            function (response) {
              const res = jQuery.parseJSON(response);

              if (res.status == 200) {
                closeModal("#email-verify-modal");
                $("#alert-additional-content").addClass("hidden");
                alertify.success(res.message);
              }
            }
          );
        }
      }
    });
  });

  // Get customer history modal data
  $(document).on("click", ".history-view", function () {
    const id = $(this).val();

    getData(`action/Customer.php?id=${id}`, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        openModal("#history-modal");

        const date = res.data.add_date.split(" ");
        const [yyyy, mm, dd] = date[0].split("-");

        $("#add_date").html(`${dd}.${mm}.${yyyy}`);
        $("#add_time").html(date[1].slice(0, -3));
        $("#customer_name").html(res.data.customer_name);
        $("#customer_phone").html(res.data.phone);
        $("#customer_building").html(res.data.room);
        $("#customer_offer").html(res.data.offer);

        const [year, month, day] = res.data.date.split(" ")[0].split("-");
        const created = `${day}.${month}.${year}`;

        $("#do_date").html(created);
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
  $("#date-picker-account").on("change", updateCustomerHistory);

  // Offer filter history section
  $("#account-offers").on("change", updateCustomerHistory);

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

  // Owner make admin
  $(document).on("submit", "#add-admin-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("owner_admin", true);

    console.log(formData);

    postFormData("action/Owner.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#add-admin-modal");
        $("#admin-table").load(location.href + " #admin-table");
        $("#add-admin-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Get order data for edit
  $(document).on("click", ".edit-order", function () {
    const id = $(this).val();

    getData(`action/AdminOrders.php?id=${id}`, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        openModal("#order-modal");

        const map = {
          Къща: "Къща",
          Офис: "Офис",
          Салон: "Салон",
          Основна: "Основна",
          Премиум: "Премиум",
          Вип: "Вип",
          "Преди 13:00": "Преди 13:00",
          "След 13:00": "След 13:00",
          "В брой": "В брой",
          "С карта": "С карта",
        };

        setSelectedOption("#room-edit", map[res.data.room]);
        setSelectedOption("#offer-edit", map[res.data.offer]);
        setSelectedOption("#time-edit", map[res.data.time]);
        setSelectedOption("#pay-edit", map[res.data.pay]);

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

    getData(`action/AdminOrders.php?id=${id}`, function (response) {
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

    getData(`action/Customer.php?email=${email}`, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        openModal("#customer-order-modal");

        const [year, month, day] = res.data.created_at.split(" ")[0].split("-");
        const created = `${day}.${month}.${year}`;

        $("#customer-name-show").val(res.data.name);
        $("#customer-phone-show").val(res.data.phone);
        $("#customer-email-show").val(res.data.email);
        $("#customer-created").val(created);
      }
    });
  });

  // Owner filter by admin name
  $("#search-admin").on("keyup", adminFilters);

  // Owner filter by admin status
  $("#select-admin-status").on("change", adminFilters);

  // Date filter dashboard order section
  $("#order-filter-date").on("change", orderFilters);

  // Text filter dashboard order section
  $("#search-order").on("keyup", orderFilters);

  // Date filter dashboard order section next button
  $("#date-next").on("click", function () {
    updateOrdersDateFilter(1);
  });

  // Date filter dashboard order section prev button
  $("#date-prev").on("click", function () {
    updateOrdersDateFilter(-1);
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

    getData(`action/AdminUsers.php?id=${id}`, function (response) {
      const res = jQuery.parseJSON(response);
      if (res.status == 200) {
        openModal("#edit-user-modal");

        const position = res.data.position;
        $("#user-position-edit")
          .val(position)
          .find(`option[value="${position}"]`)
          .attr("selected", "selected");
        $("#user-id").val(res.data.id);
        $("#user-name-edit").val(res.data.name);
        $("#user-egn-edit").val(res.data.egn);
        $("#user-dob-edit").val(res.data.dob);
        $("#user-phone-edit").val(res.data.phone);
        $("#user-address-edit").val(res.data.address);
      }
    });
  });

  // Admin create user
  $(document).on("submit", "#edit-admin-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("owner_update_admin", true);

    postFormData("action/Owner.php", formData, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        closeModal("#edit-admin-modal");
        $("#admin-table").load(location.href + " #admin-table");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  // Get admin data for edit
  $(document).on("click", ".edit-admin", function () {
    const id = $(this).val();

    getData(`action/Owner.php?id=${id}`, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status == 200) {
        openModal("#edit-admin-modal");

        $("#admin-id").val(res.data.id);
        $("#admin-name-edit").val(res.data.name);
        $("#admin-email-edit").val(res.data.email);
        $("#admin-phone-edit").val(res.data.phone);

        $(
          "#Добавяне-edit, #Редактиране-edit, #Всички-edit, #Персонал-edit, #Номенклатури-edit"
        ).prop("checked", false);

        if (res.data.create_role == 1) {
          $("#Добавяне-edit").prop("checked", true);
        }
        if (res.data.edit_role == 1) {
          $("#Редактиране-edit").prop("checked", true);
        }
        if (res.data.full_role == 1) {
          $("#Всички-edit").prop("checked", true);
        }
        if (res.data.personal_view == 1) {
          $("#Персонал-edit").prop("checked", true);
        }
        if (res.data.nomenclature_view == 1) {
          $("#Номенклатури-edit").prop("checked", true);
        }
      }
    });
  });

  // Get supplier data for edit
  $(document).on("click", ".edit-supplier", function () {
    const id = $(this).val();

    getData(`action/AdminSuppliers.php?id=${id}`, function (response) {
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

    getData(`action/AdminUsers.php?id=${id}`, function (response) {
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

  // Owner dashboard date filter for incomes
  $("#filter-date-from").on("change", ownerFilterIncomes);
  $("#filter-date-to").on("change", ownerFilterIncomes);

  // Owner date filter buttons
  $("#date-prev-incomes").on("click", () =>
    ownerFilterDate("#filter-date-from", -1)
  );

  $("#date-next-incomes").on("click", () =>
    ownerFilterDate("#filter-date-from", 1)
  );

  $("#date-prev-expenses").on("click", () =>
    ownerFilterDate("#filter-date-to", -1)
  );

  $("#date-next-expenses").on("click", () =>
    ownerFilterDate("#filter-date-to", 1)
  );

  // User search by name and pid
  $("#search-user").on("keyup", function () {
    filterUsers(
      $(this).val(),
      $("#select-position").val(),
      $("#select-status").val()
    );
  });

  // User position filter
  $("#select-position").on("change", function () {
    filterUsers(
      $("#search-user").val(),
      $(this).val(),
      $("#select-status").val()
    );
  });

  // User status filter
  $("#select-status").on("change", function () {
    filterUsers(
      $("#search-user").val(),
      $("#select-position").val(),
      $(this).val()
    );
  });

  // Stock search by name
  searchDropdown(
    "#product-order-name",
    "#product-name-dropdown",
    "action/product/ProductSearch.php",
    "product"
  );

  // Search stock supplier by name
  searchDropdown(
    "#product-order-supplier",
    "#supplier-name-dropdown",
    "action/product/SupplierSearch.php",
    "supplier"
  );

  // Product search by name
  searchDropdown(
    "#set-product-name",
    "#set-product-name-dropdown",
    "action/product/ProductSearch1.php",
    "product"
  );

  // User and user2 live search add team
  $(document).on("keyup", "#team-user1, #team-user2", function () {
    const user = $(this).val();
    const userId = $(this).attr("id");
    const dropdownId =
      userId === "team-user1" ? "#user-name1-dropdown" : "#user-name2-dropdown";
    const phpScript =
      userId === "team-user1" ? "UserSearch.php" : "UserSearch2.php";

    postData("action/team/" + phpScript, { user: user }, function (data) {
      $(dropdownId).removeClass("hidden");
      $(dropdownId).html(data);

      if (!user) {
        $(dropdownId).addClass("hidden");
      }

      $(window).click(function () {
        $(dropdownId).addClass("hidden");
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

  // Get supplier name and insert in input
  insertInputValue(
    ".get-order-supplier",
    "#product-order-supplier",
    "#supplier-name-dropdown"
  );

  // Get stock name and insert in input
  insertInputValue(
    ".get-product-name1",
    "#set-product-name",
    "#set-product-name-dropdown"
  );

  // Get stock name and insert in input
  insertInputValue(
    ".get-product-name",
    "#product-order-name",
    "#product-name-dropdown"
  );

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

          getData(`action/AdminTeams.php?id=${id}`, function (response) {
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

    getData(`action/AdminTeams.php?id=${id}`, function (response) {
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

    getData(`action/AdminWarehouse.php?id=${id}`, function (response) {
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

  // Admin delete product order modal open
  $(document).on("click", ".delete-product-order", function () {
    openModal("#delete-product-order-modal");
    $("#delete-product-order-id").val($(this).val());
  });

  // Admin delete supplier modal open
  $(document).on("click", ".delete-supplier", function () {
    openModal("#delete-supplier-modal");
    $("#delete-supplier-id").val($(this).val());
  });

  // Product search and filter
  $("#search-product").on("keyup", function () {
    productFilter(
      "#search-product",
      "#select-product-kind",
      "action/product/Filter.php",
      "#product-table"
    );
  });

  // Product filter by kind
  $("#select-product-kind").on("change", function () {
    productFilter(
      "#search-product",
      "#select-product-kind",
      "action/product/Filter.php",
      "#product-table"
    );
  });

  // Product search by id or name
  $("#search-order-product").on("keyup", function () {
    productFilter(
      "#search-order-product",
      "#select-order-product-kind",
      "action/product/Filter1.php",
      "#product-order-table"
    );
  });

  // Product filter by kind
  $("#select-order-product-kind").on("change", function () {
    productFilter(
      "#search-order-product",
      "#select-order-product-kind",
      "action/product/Filter1.php",
      "#product-order-table"
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

  // Owner login
  $(document).on("submit", "#owner-login-form", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("owner_login", true);

    postFormData("action/Owner.php", formData, function (response) {
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
        $("#first-pass, #second-pass, #third-pass").val("");
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

  // Owner dashboard logout
  $("#owner-logout").on("click", function () {
    const action = "data";

    postData("action/Owner.php", { action: action }, function (response) {
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
    const state = orderState == 1 ? "Sort.php" : "Sort1.php";
    const container =
      orderState == 1 ? "#active-order-section" : "#finished-order-section";

    postData("action/mobile/" + state, { text, orderBy }, function (response) {
      $(container).html(response);
    });
  });

  $(document).on("click", ".update-order-steps", function () {
    $("#active-order-account").load(location.href + " #active-order-account");
  });

  // Mobile get order data
  $(document).on("click", ".get-order-data", function () {
    const id = $(this).val();

    openModal(".order-start-loader");

    getData(`action/AdminOrders.php?id=${id}`, function (response) {
      const res = jQuery.parseJSON(response);

      if (res.status === 200) {
        const isStarted = res.data.status === "В процес";
        $(".open-photo-modal").val(res.data.email);
        $("#end-order").val(res.data.id);
        $("#order-id-cancel").val(res.data.id);
        $("#mobOrder").addClass("hidden");
        $("#order-not-started").toggleClass("block", !isStarted);
        $("#order-not-started").toggleClass("hidden", isStarted);
        $("#order-is-started").toggleClass("block", isStarted);
        $("#order-is-started").toggleClass("hidden", !isStarted);

        if (!isStarted) {
          $(".start-order-btn").val(`${res.data.id} ${res.data.team_id}`);
          $("#customer-name-mobile").html(res.data.customer_name);
          $("#address-mobile").html(res.data.address);
          $("#pay-mobile").html(res.data.pay);
          $("#offer-mobile").html(res.data.offer);
          const date = res.data.date.split("-");
          $("#date-time-mobile").html(
            `${date[2]}.${date[1]}.${date[0]} - ${res.data.time}`
          );
          $("#m2-mobile").html(`${res.data.m2} m2`);
          $("#price-mobile").html(`${res.data.price} лв.`);
          $("#phone-mobile").html(res.data.phone);

          const information =
            res.data.information || "Няма допънителна информация";
          $("#information-mobile").html(information);

          const isCancelledOrFinished =
            res.data.status === "Отказана" || res.data.status === "Приключена";
          $("#order-start-btn").toggleClass("flex", !isCancelledOrFinished);
          $("#order-start-btn").toggleClass("hidden", isCancelledOrFinished);
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

  // Dashboard cancel reason modal
  $(document).on("click", ".show-cancel-dashboard", function () {
    const id = $(this).val();
    openModal("#cancel-order-reason-modal");

    getData(`action/AdminOrders.php?id=${id}`, function (response) {
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

  // Search setted and returned product history (click)
  $("#seted-product-history-btn, #returned-product-history-btn").on(
    "click",
    function () {
      const buttonId = $(this).attr("id");
      const searchKind = buttonId === "seted-product-history-btn" ? 0 : 1;

      $(
        "#seted-product-history-btn, #returned-product-history-btn"
      ).removeClass("bg-gray-200");
      $(this).addClass("bg-gray-200");
      $("#kind-search").val(searchKind);

      sendHistorySearchRequest();
    }
  );

  // Search setted product history by date and name
  $("#product-name-search, #product-history-date").on(
    "keyup change",
    function () {
      sendHistorySearchRequest();
    }
  );
});
