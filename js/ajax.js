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
          url: "../action/ReloadCustomerPhoto.php",
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
        $("#customer-order-form")[0].reset();
        $("#account-toast-price").html("0 лв.");
        alertify.success(res.message);
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });

  //Customer make order
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
});
