function sortGrid(fieldName) {
  $("#orderByField").val(fieldName);
  var orderByFieldValue = $("#orderByFieldValue").val();
  if (orderByFieldValue == "asc") {
    $("#orderByFieldValue").val("desc");
  } else {
    $("#orderByFieldValue").val("asc");
  }

  $("#orderByFieldValueChange").val("yes");
  reloadForm();
}

function searchDataBox(s_i) {
  $(".sort_by_list").hide();
  if (s_i == "-1") {
    $("#searchByField").val("");
    $("#searchByFieldValue").val("");

    reloadForm();
  } else {
    $("#searchByField").val(s_i);
    $("#search_grid_box").show();
    $("#grid_search_button").show();
    if (s_i == "purchase_from_mill.purchase_date") {
      jQuery("#search_grid_box").addClass("purchase_date1");
      $(".purchase_date1").datepicker();
    } else {
      $(".purchase_date1").data("datepicker").remove();
    }
  }
}

function gridSearchData() {
  var search_grid_box = $("#search_grid_box").val();
  $("#searchByFieldValue").val(search_grid_box);

  reloadForm();
}

function generatePagi(selectTab, limit) {
  $("#perPage").val(limit);
  $("#selectTab").val(selectTab);
  reloadForm();
}

function sortDataBox(searchFieldValue, searchField) {
  //$("#search_grid_box").val('');
  //$("#search_grid_box").hide();
  //$("#grid_search_button").hide();
  //$(".sort_by_list").hide();
  if (searchField == "") {
    $("#" + searchFieldValue + "_sort_by").show();
  } else {
    if (searchField == "status") {
      $("#status").val(searchFieldValue);
    } else {
      $("#searchByField").val(searchField);
      $("#searchByFieldValue").val(searchFieldValue);
    }

    reloadForm();
  }
}

function reloadForm() {
  $("#frmSort").submit();
}

function pageRedirect(url) {
  window.location = url;
}

function prev_next(num, type) {
  if (type == "prev") {
    num--;
  }
  if (type == "next") {
    num++;
  }
  var perPage = PAGE_PER_NO;
  var next = num * parseInt(perPage);

  generatePagi(num, next);
}

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  var token = profile.getId();
  var name = profile.getName();
  var email = profile.getEmail();
  if (token != "" && name != "" && email != "") {
    var dataString = "token=" + token + "&name=" + name + "&email=" + email;
    $.ajax({
      type: "POST",
      url: SITE_URL + "g_authenticate",
      data: dataString,
      cache: false,
      success: function (result) {
        var getData = $.parseJSON(result);
        if (getData.success == true) {
          window.location = SITE_URL;
        } else {
          $(".loginmsg").html(getData.msg);
        }
      },
    });
  }
}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    $.ajax({
      type: "POST",
      url: SITE_URL + "glogout",
      data: "",
      cache: false,
      success: function (result) {
        var getData = $.parseJSON(result);
        if (getData.success == true) {
          window.location = SITE_URL;
        }
      },
    });
  });
}

function onLoad() {
  gapi.load("auth2", function () {
    gapi.auth2.init();
  });
}

jQuery("#frmBox").on("submit", function (e) {
  jQuery(".field_error").html("");
  var id = jQuery("#id").val();
  var btnVal = jQuery("#btn").val();
  var urlLink = jQuery("#urlLink").val();
  var section = jQuery("#section").val();
  if (urlLink == "updatePasswordProcess") {
    var new_password = jQuery("#new_password").val();
    var confirm_new_password = jQuery("#confirm_new_password").val();
    if (new_password != confirm_new_password) {
      jQuery("#confirm_password_error").html(
        "You must enter the same password twice in order to confirm it."
      );
      return false;
    }
  }
  jQuery("#btn").val("Please wait...");
  jQuery("#btn").attr("disabled", true);
  jQuery.ajax({
    url: SITE_URL + urlLink,
    type: "post",
    enctype: "multipart/form-data",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var str = result;
      var isError = str.indexOf("elementError");
      if (isError > 0) {
        var getData = $.parseJSON(result);
        $.each(getData, function (val, key) {
          $.each(key, function (fieldVal, fieldKey) {
            $.each(fieldKey, function (fieldVal1, fieldKey1) {
              $("#" + fieldVal1).html(fieldKey1);
            });
          });
        });
      } else {
        if (id > 0) {
          // jQuery('#success_msg').html(section+' updated successfully');
          if (urlLink == "updatePasswordProcess") {
            jQuery("#frmBox")["0"].reset();
          }
        } else {
          // jQuery('#success_msg').html(section+' added successfully');
          jQuery("#frmBox")["0"].reset();
        }
      }
      jQuery("#btn").val(btnVal);
      jQuery("#btn").attr("disabled", false);
    },
  });
  e.preventDefault();
});

function getCity(state, city, id) {
  $("#" + id).html("<option value='-1'>Select City</option>");
  if (state != "-1") {
    var datastring = "state=" + state + "&city=" + city;
    $.ajax({
      type: "POST",
      url: SITE_URL + "loadCity",
      data: datastring,
      cache: false,
      success: function (result) {
        $("#" + id).html(result);
      },
    });
  } else {
    $("#" + id).html("<option value='-1'>Select City</option>");
  }
}

jQuery("#frmRegData").on("submit", function (e) {
  jQuery(".validation_message_error,#otptimer").html("");
  var btnVal = jQuery(".regbtn").val();
  jQuery("#regbtn").val("Please wait...");
  jQuery("#regbtn").attr("disabled", true);
  jQuery.ajax({
    url: SITE_URL + "register_user",
    type: "post",
    enctype: "multipart/form-data",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var str = result;
      var isError = str.indexOf("elementError");
      if (isError > 0) {
        var getData = $.parseJSON(result);
        $.each(getData, function (val, key) {
          $.each(key, function (fieldVal, fieldKey) {
            $.each(fieldKey, function (fieldVal1, fieldKey1) {
              $("#" + fieldVal1).html(fieldKey1);
            });
          });
        });
      } else {
        var getData = $.parseJSON(result);
        if (getData.success == true) {
          $("#registerDiv").removeClass("showReg");
          $("#registerDivotp").removeClass("hideReg");
          $("#registerDiv").addClass("hideReg");
          $("#registerDivotp").addClass("showReg");
          $("#registerDivotpresent").addClass("hideReg");
          var timeLeft = 180;
          var timerId = setInterval(function () {
            if (timeLeft == 0) {
              clearTimeout(timerId);
              $("#registerDivotp").removeClass("showReg");
              $("#registerDivotp").addClass("hideReg");
              $("#registerDivotpresent").removeClass("hideReg");
              $("#otptimer").html("");
            } else {
              var zero = "";
              if (timeLeft < 10) {
                zero = "0";
              }
              $("#otptimer").html("00:" + zero + timeLeft);
              timeLeft--;
            }
          }, 1000);
        } else {
          $(".errorMessageReg").html(getData.msg);
        }
      }
      jQuery("#regbtn").val(btnVal);
      jQuery("#regbtn").attr("disabled", false);
    },
  });
  e.preventDefault();
});
jQuery("#frmResetPwd").on("submit", function (e) {
  jQuery(".validation_message").text("");
  jQuery.ajax({
    url: SITE_URL + "reset_pwd_user",
    type: "post",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var getData = $.parseJSON(result);
      if (getData.status == 1) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: getData.message,
        });
      } else if (getData.status == 0) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: getData.error,
        });
      }
    },
  });
  e.preventDefault();
});

jQuery("#userfrmResetPwd").on("submit", function (e) {
  jQuery.ajax({
    url: SITE_URL + "user_reset_pwd",
    type: "post",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var getData = $.parseJSON(result);
      if (getData.status == 1) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: getData.message,
        });
        setTimeout(function () {
          window.location.href = "/finonew/";
        }, 2000);
      } else if (getData.status == 0) {
        Swal.fire({
			icon: 'error',
			title: 'Error',
			text: getData.error,
		})
      }
    },
  });
  e.preventDefault();
});

function resendOtp() {
  jQuery(".validation_message_error").html("");
  var btnVal = jQuery(".resendOtpBtn").val();
  jQuery(".resendOtpBtn").val("Please wait...");
  jQuery(".resendOtpBtn").attr("disabled", true);
  $.ajax({
    type: "POST",
    url: SITE_URL + "resendOtp",
    data: "",
    cache: false,
    success: function (result) {
      console.log(result);
      var getData = $.parseJSON(result);
      jQuery(".resendOtpBtn").val(btnVal);
      jQuery(".resendOtpBtn").attr("disabled", false);
      if (getData.success == false) {
        $(".resendmessageotp").html(getData.msg);
      } else {
        $("#loginDivotp").show();
        $("#loginDivotpresent").hide();
        $("#registerDivotp").removeClass("hideReg");
        $("#registerDivotp").addClass("showReg");
        $("#registerDivotpresent").removeClass("showReg");
        $("#registerDivotpresent").addClass("hideReg");
        var timeLeft = 180;
        var timerId = setInterval(function () {
          if (timeLeft == 0) {
            clearTimeout(timerId);
            $("#loginDivotp").hide();
            $("#loginDivotpresent").show();
            $("#loginotptimer").html("");
            $("#registerDivotp").removeClass("showReg");
            $("#registerDivotp").addClass("hideReg");
            $("#registerDivotpresent").removeClass("hideReg");
            $("#otptimer").html("");
          } else {
            var zero = "";
            if (timeLeft < 10) {
              zero = "0";
            }
            $("#otptimer").html("00:" + zero + timeLeft);
            $("#loginotptimer").html("00:" + zero + timeLeft);
            timeLeft--;
          }
        }, 1000);
      }
    },
  });
}

function verificationProfile(type = "") {
  jQuery(".validation_message_error").html("");
  if (type == "mypage") {
    var otp = $("#mobileLoginOtp").val();
    var errorloginVar = "mobileLoginOtp";
  } else if (type == "mypop") {
    var otp = $("#verifyOtp").val();
    var errorloginVar = "verifyOtp";
  } else if (type == "loginpop") {
    var otp = $("#loginverifyOtp").val();
    var errorloginVar = "loginverifyOtp";
  }
  var isError = "false";
  if (otp == "") {
    $("#" + errorloginVar + "Error").html("Please enter otp");
    $("#" + errorloginVar + "Error").html("Please enter otp");
    isError = "true";
  }
  if (isError == "false") {
    var btnVal = jQuery(".verifyProfotpbtn").val();
    jQuery(".verifyProfotpbtn").val("Please wait...");
    jQuery(".verifyProfotpbtn").attr("disabled", true);
    var dataString = "otp=" + otp;
    $.ajax({
      type: "POST",
      url: SITE_URL + "verification",
      data: dataString,
      cache: false,
      success: function (result) {
        var getData = $.parseJSON(result);
        if (getData.success == false) {
          $(".errorMessageotp").html(getData.msg);
          jQuery(".verifyProfotpbtn").val(btnVal);
          jQuery(".verifyProfotpbtn").attr("disabled", false);
        } else {
          window.location.reload();
        }
      },
    });
  }
}

jQuery("#servicefrmData").on("submit", function (e) {
  jQuery(".field_error").html("");
  var id = jQuery("#id").val();
  var btnVal = jQuery("#servicebtn").val();
  jQuery("#servicebtn").val("Please wait...");
  jQuery("#servicebtn").attr("disabled", true);
  jQuery.ajax({
    url: SITE_URL + "service_process",
    type: "post",
    enctype: "multipart/form-data",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var str = result;
      var isError = str.indexOf("elementError");
      if (isError > 0) {
        var getData = $.parseJSON(result);
        $.each(getData, function (val, key) {
          $.each(key, function (fieldVal, fieldKey) {
            $.each(fieldKey, function (fieldVal1, fieldKey1) {
              $("#" + fieldVal1).html(fieldKey1);
            });
          });
        });
      } else {
        var getData = $.parseJSON(result);
        if (getData.success == true) {
          if (getData.servicecostflg == true) {
            window.location = SITE_URL + "checkout";
          } else {
            window.location = SITE_URL + "thank_you";
          }
        }
      }
      jQuery("#servicebtn").val(btnVal);
      jQuery("#servicebtn").attr("disabled", false);
    },
  });
  e.preventDefault();
});

jQuery("#servicefrmDataM").on("submit", function (e) {
  jQuery(".field_error").html("");
  var id = jQuery("#id").val();
  var btnVal = jQuery("#servicebtnM").val();
  jQuery("#servicebtnM").val("Please wait...");
  jQuery("#servicebtnM").attr("disabled", true);
  jQuery.ajax({
    url: SITE_URL + "service_process",
    type: "post",
    enctype: "multipart/form-data",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var str = result;
      var isError = str.indexOf("elementError");
      if (isError > 0) {
        var getData = $.parseJSON(result);
        $.each(getData, function (val, key) {
          $.each(key, function (fieldVal, fieldKey) {
            $.each(fieldKey, function (fieldVal1, fieldKey1) {
              $("#" + fieldVal1).html(fieldKey1);
            });
          });
        });
      } else {
        var getData = $.parseJSON(result);
        if (getData.success == true) {
          if (getData.servicecostflg == true) {
            window.location = SITE_URL + "checkout";
          } else {
            window.location = SITE_URL + "thank_you";
          }
        }
      }
      jQuery("#servicebtnM").val(btnVal);
      jQuery("#servicebtnM").attr("disabled", false);
    },
  });
  e.preventDefault();
});

function checkUser(type = "") {
  jQuery(".validation_message_error").html("");
  if (type == "mypage") {
    var uemail = $("#emailLogin").val();
    var upwd = $("#passwordLogin").val();
    var errorloginVar = "emailLogin";
    var errorpasswordVar = "passwordLogin";
  } else if (type == "mypop") {
    var uemail = $("#uemail").val();
    var upwd = $("#password").val();
    var errorloginVar = "uemail";
    var errorpasswordVar = "password";
  }
  $(".errorMessage").show();
  var isError = "false";
  if (uemail == "") {
    $("#" + errorloginVar + "Error").html("Please enter email");
    isError = "true";
  }
  if (upwd == "") {
    $("#" + errorpasswordVar + "Error").html("Please enter password");
    isError = "true";
  }

  if (isError == "false") {
    jQuery(".validation_message_error,#otptimer").html("");
    var btnVal = jQuery(".loginbtn").val();
    jQuery(".loginbtn").val("Please wait...");
    jQuery(".loginbtn").attr("disabled", true);
    var dataString = "uemail=" + uemail + "&upwd=" + upwd;
    $.ajax({
      type: "POST",
      url: SITE_URL + "user_authenticate",
      data: dataString,
      cache: false,
      success: function (result) {
        if (result == "done") {
          if (type == "mypop" || type == "mypage") {
            jQuery(".loginbtn").val(btnVal);
            jQuery(".loginbtn").attr("disabled", false);
            window.location.reload();
          }
        } else if (result == "verify") {
          // e.preventDefault();
          jQuery.ajax({
            url: SITE_URL + "register_user_verify_senotp",
            type: "post",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function (result) {
              var getData = $.parseJSON(result);
              if (getData.success == true) {
                alert("Please verify your account");
                $("#formlogin").hide();
                $("#loginDivotp").show();
                var timeLeft = 180;
                var timerId = setInterval(function () {
                  if (timeLeft == 0) {
                    clearTimeout(timerId);
                    $("#loginDivotp").hide();
                    $("#loginDivotpresent").show();
                    $("#loginotptimer").html("");
                  } else {
                    var zero = "";
                    if (timeLeft < 10) {
                      zero = "0";
                    }
                    $("#loginotptimer").html("00:" + zero + timeLeft);
                    timeLeft--;
                  }
                }, 1000);
              }
            },
          });
        } else {
          var position = result.indexOf("||");
          var warningMessage = result.substring(0, position);
          var errorMessage = result.substring(position + 2);
          $(".loginmsg").html(errorMessage);
          jQuery(".loginbtn").val(btnVal);
          jQuery(".loginbtn").attr("disabled", false);
          return false;
        }
        $(".errorMessage").hide();
        jQuery(".loginbtn").val(btnVal);
        jQuery(".loginbtn").attr("disabled", false);
      },
    });
  }
}

function getPopup() {
  $("#loginpoclik").trigger("click");
}

jQuery("#chkoutData").on("submit", function (e) {
  $(".validation_message_error").html("");
  var btnVal = jQuery("#orderbtn").val();
  jQuery("#orderbtn").val("Please wait...");
  jQuery("#orderbtn").attr("disabled", true);
  jQuery.ajax({
    url: SITE_URL + "orderPay",
    type: "post",
    enctype: "multipart/form-data",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var str = result;
      var isError = str.indexOf("elementError");
      if (isError > 0) {
        var getData = $.parseJSON(result);
        $.each(getData, function (val, key) {
          $.each(key, function (fieldVal, fieldKey) {
            $.each(fieldKey, function (fieldVal1, fieldKey1) {
              $("#" + fieldVal1).html(fieldKey1);
              if (fieldVal1 == "usermobileError") {
                $("#chkoutData #mobile").focus();
              }
              if (fieldVal1 == "useremailError") {
                $("#chkoutData #useremail").focus();
              }
            });
          });
        });
      } else {
        var getData = $.parseJSON(result);
        if (getData.key == true) {
          if (getData.link != "") {
            window.location = getData.link;
          } else if (getData.form != "") {
            jQuery("#pay_now_form").html(getData.form);
            setTimeout(function () {
              document.payForm.submit();
            }, 1000);
          }
        }
      }
      jQuery("#orderbtn").val(btnVal);
      jQuery("#orderbtn").attr("disabled", false);
    },
  });
  e.preventDefault();
});

jQuery("#contactfrm").on("submit", function (e) {
  $(".success_msg").html("");
  var btnVal = jQuery("#contbtn").val();
  jQuery("#contbtn").val("Please wait...");
  jQuery("#contbtn").attr("disabled", true);
  jQuery.ajax({
    url: SITE_URL + "addContact",
    type: "post",
    enctype: "multipart/form-data",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var getData = $.parseJSON(result);
      $.each(getData, function (val, key) {
        $(".success_msg").html(key);
      });
      jQuery("#contactfrm")["0"].reset();
      jQuery("#contbtn").val(btnVal);
      jQuery("#contbtn").attr("disabled", false);
    },
  });
  e.preventDefault();
});

jQuery("#blogfrmData").on("submit", function (e) {
  $(".errorMessageReg").html("");
  var btnVal = jQuery("#blogbtn").val();
  jQuery("#blogbtn").val("Please wait...");
  jQuery("#blogbtn").attr("disabled", true);
  jQuery.ajax({
    url: SITE_URL + "addBlogEnquiry",
    type: "post",
    enctype: "multipart/form-data",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var getData = $.parseJSON(result);
      $.each(getData, function (val, key) {
        $(".errorMessageReg").html(key);
      });
      jQuery("#blogfrmData")["0"].reset();
      jQuery("#blogbtn").val(btnVal);
      jQuery("#blogbtn").attr("disabled", false);
    },
  });
  e.preventDefault();
});

jQuery("#prffrmData").on("submit", function (e) {
  $(".validation_message_error").html("");
  var btnVal = jQuery("#updprf").val();
  jQuery("#updprf").val("Please wait...");
  jQuery("#updprf").attr("disabled", true);
  jQuery("#model_btn").trigger("click");
  jQuery.ajax({
    url: SITE_URL + "profile_update",
    type: "post",
    enctype: "multipart/form-data",
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function (result) {
      var getData = $.parseJSON(result);
      if (getData.success == true) {
        $(".errorPrfMessage").html(getData.msg);
      }
      jQuery("#updprf").val(btnVal);
      jQuery("#updprf").attr("disabled", false);
    },
  });
  e.preventDefault();
});

/*
$("#assistance_modal")
  .find("form")
  .on("submit", function (e) {
    e.preventDefault();
    var service = SERVICE;
    var email = $("#assistance_modal").find('form input[type="email"]').val();
    var mobile = $("#assistance_modal").find('form input[type="text"]').val();
    // var btnVal = $("#assistance_modal").find('form input[type="submit"]').val();
    $checkError = 0;
    if (email == "") {
      $("#assistance_modal")
        .find('form input[type="email"]')
        .after('<span class="text-danger">Email Required</span>');
      $checkError = 1;
    }
    if (mobile == "") {
      $("#assistance_modal")
        .find('form input[type="text"]')
        .after('<span class="text-danger">Phone NO. Required</span>');
      $checkError = 1;
    }
    if (mobile.length < 10) {
      $("#assistance_modal")
        .find('form input[type="text"]')
        .after(
          '<span class="text-danger">Please enter correct phone no.</span>'
        );
      $checkError = 1;
    }

    var dataString =
      "service_name=" + service + "&mobile=" + mobile + "&email=" + email;
    if (!$checkError) {
      let body = new FormData();
      body.append("email", email);
      body.append("mobile", mobile);
      body.append("service_name", service);

      fetch(SITE_URL + "saveenquiry", {
        method: "post",
        body,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            $("#assistance_modal .modal-content").append(
              "<p>Thank you for reaching out to us. Our team will contact you at the earliest</p>"
            );
            $("#assistance_modal .modal-body").hide();

            setTimeout(() => {
              $("#assistance_modal").modal("hide");
              $("#assistance_modal .modal-content p").remove();
              $("#assistance_modal .modal-body").show();
            }, 5000);
          }
        });
    }
    e.preventDefault();
  });
*/