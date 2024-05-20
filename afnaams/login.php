<?php session_start();
?>
<title>Alumni Tracking System</title>
<style>
  body {
    font-family: "Poppins", sans-serif !important;
  }

  .laginbutton {
    width: 100%;
    font-weight: 500;
  }

  #uni_modal #saveButton {
    display: none;
  }


  .signup-link {
    display: block;
    margin-top: 10px;
    text-align: center;
  }

  .signup-link a {
    text-decoration: none;
  }

  .password-container {
    position: relative;
  }

  .EyePass {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translate(0, -50%);
    cursor: pointer;
  }

  #eye {
    font-size: 15px;
    color: #7a797e;
  }
</style>
<div class="container-fluid">
  <form action="" id="login-frm">
    <div class="form-group">
      <label for="" class="control-label">Email</label>
      <input type="email" name="username" required="" class="form-control">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Password</label>
      <div class="password-container">
        <input id="password" type="password" name="password" required="" class="form-control">
        <span class="EyePass">
          <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
        </span>
      </div> <br>
      <button class="button btn btn-primary btn-md laginbutton p-2 ">Login</button>
    </div>
  </form>
</div>


<script>
  // Form submit event handler
  $('#login-frm').submit(function (e) {
    e.preventDefault();
    $('#login-frm button[type="submit"]').attr('disabled', true).html('Logging in...');

    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();

    $.ajax({
      url: 'admin/ajax.php?action=login2',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err);
        $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
      },
      success: function (resp) {
        if (resp == 1) {
          // Redirect to the home page after successful login
          location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=my_account' ?>';
        } else if (resp == 2) {
          $('#login-frm').prepend('<div class="alert alert-danger">Your account is not yet verified.</div>');
          $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
        } else {
          $('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>');
          $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
        }
      }
    });
  });

  var state = false;

  function toggle() {
    // Use the name attribute to select the password input
    var passwordInput = document.getElementsByName("password")[0];

    if (state) {
      passwordInput.setAttribute("type", "password");
      document.getElementById("eye").style.color = '#7a797e';
      state = false;
    } else {
      passwordInput.setAttribute("type", "text");
      document.getElementById("eye").style.color = '#5887ef';
      state = true;
    }
  }
</script>