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
        window.location.href = "account.html";
        alertify.success(res.message);
        var email = res.userEmail;

        getData("../action/customer.php?email=" + email, function (response) {
          var res = jQuery.parseJSON(response);
          console.log(response);
          if (res.status == 200) {
            $("#userEmail").val(res.data.email);
          }
        });
      } else if (res.status == 500) {
        alertify.error(res.message);
      }
    });
  });
});
