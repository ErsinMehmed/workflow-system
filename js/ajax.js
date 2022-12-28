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

  //Customer register
  $(document).on("submit", "#sign-in-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_customer", true);

    postData("../action/customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);
      alertify.set("notifier", "position", "top-center");

      if (res.status == 422) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#sign-in-form")[0].reset();
        $("signUp-modal").hide();
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

  //Customer login
  $(document).on("submit", "#sing-up-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("login_info", true);

    postData("../action/customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);
      alertify.set("notifier", "position", "top-center");

      if (res.status == 422) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        window.location.href = "account.php";
        alertify.success(res.message);
        userEmail = res.userEmail;
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  //Update customer information
  $(document).on("submit", "#user-info-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_customer", true);

    postData("../action/customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);
      alertify.set("notifier", "position", "top-center");

      if (res.status == 422) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        alertify.success(res.message);
        $(".order-section").load(document.URL + " .order-section");
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  //Update customer profile image
  $(document).on("submit", "#customer-image-form", function (e) {
    e.preventDefault();

    var userEmail = $("#getCutomerEmail").val();

    var formData = new FormData(this);
    formData.append("update_customer_image", true);

    postData("../action/customer.php", formData, function (response) {
      alertify.set("notifier", "position", "top-center");
      var res = jQuery.parseJSON(response);

      if (res.status == 422) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        alertify.success(res.message);

        $.ajax({
          url: "../action/customer/reloadCustomerPhoto.php",
          type: "POST",
          data: { userEmail: userEmail },
          success: function (data) {
            $(".updatePhoto").attr("src", data);
          },
        });
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  //Update customer passowrd
  $(document).on("submit", "#update-customer-password", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_customer_password", true);

    postData("../action/customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);
      alertify.set("notifier", "position", "top-center");

      if (res.status == 422) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        alertify.success(res.message);
      } else if (res.status == 430) {
        alertify.error(res.message);
      } else if (res.status == 510) {
        alertify.error(res.message);
      }
    });
  });

  //Customer profile logout
  $("#log-out").on("click", function () {
    var action = "data";

    $.ajax({
      url: "../action/customer.php",
      type: "POST",
      data: { action: action },
      success: function (responese) {
        var res = jQuery.parseJSON(responese);

        if (res.status == 200) {
          window.location.href = "home.php";
        }
      },
    });
  });

  //Customer make order
  $(document).on("submit", "#customer-order-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("customer_order", true);

    postData("../action/customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);
      alertify.set("notifier", "position", "top-center");

      if (res.status == 422) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#history-section").load(location.href + " #history-section>*", "");
        $("#account-toast-price").html("0 лв.");
        $("#customer-order-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  //Guest make order
  $(document).on("submit", "#guest-order-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("guest_order", true);

    postData("../action/order.php", formData, function (response) {
      var res = jQuery.parseJSON(response);
      alertify.set("notifier", "position", "top-center");

      if (res.status == 422) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#guest-order-form")[0].reset();
        $("#account-toast-price").html("0 лв.");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  //Get customer history modal data
  $(document).on("click", ".history-view", function () {
    var id = $(this).val();

    getData("../action/customer.php?id=" + id, function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 404) {
        alert(res.message);
      } else if (res.status == 200) {
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

  //Date filter history section
  $("#date-pcicker-account").on("change", function () {
    var date = $(this).val();
    var offer = $("#account-offers").val();

    $.ajax({
      url: "../action/customer/dateFilter.php",
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

  //Offer filter history section
  $("#account-offers").on("change", function () {
    var offer = $(this).val();
    var date = $("#date-pcicker-account").val();

    $.ajax({
      url: "../action/customer/dateFilter.php",
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

  //Customer upload room image form
  $(document).on("submit", "#room-images-form", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("customer_upload_room", true);

    postData("../action/customer.php", formData, function (response) {
      var res = jQuery.parseJSON(response);
      alertify.set("notifier", "position", "top-center");

      if (res.status == 422) {
        alertify.error(res.message);
      } else if (res.status == 200) {
        $("#document-section").load(location.href + " #document-section>*", "");
        $("#room-images-form")[0].reset();
        alertify.success(res.message);
      } else if (res.status == 404) {
        alertify.error(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  $(".room-img").on("click", function () {
    var img = $(this).attr("id");
    console.log(img);
    /*var date = $("#date-pcicker-account").val();

    $.ajax({
      url: "../action/customer.php",
      type: "POST",
      data: {
        offer: offer,
        date: date,
      },
      success: function (data) {
        $("#history-section").html(data);
      },
    });*/
  });
});
