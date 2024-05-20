<?php session_start();
?>
<style>
  body {
    font-family: 'Poppins', sans-serif !important;
  }

  .laginbutton {
    width: 100%;
    font-weight: 600;
  }

  .modal-footer {
    display: none;
  }

  .signup-link {
    display: block;
    margin-top: 10px;
    text-align: center;
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

  .fa {
    font-size: 20px;
    color: #7a797e;
  }
</style>
<div class="container-fluid">
  <form action="" id="login-frm">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <div><i class="fa-solid fa-triangle-exclamation" style="color: #973F47;"></i>
        Please Log In first to continue.
      </div>
    </div>
    <div class="form-group">
      <label for="" class="control-label">Email</label>
      <input type="email" name="username" required="" class="form-control">
    </div>
    <div class="form-group">
      <label for="" class="control-label">Password</label>
      <div class="password-container">
        <input type="password" name="password" id="password" required="" class="form-control">
        <span class="EyePass">
          <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
        </span>
      </div>
      <br>
      <button class="button btn btn-primary btn-md laginbutton p-2 ">Log In</button>
    </div>
    <hr>
  </form>
</div>


<script>
  // Form submit event handler
  $('#login-frm').submit(function (e) {
    e.preventDefault()
    $('#login-frm button[type="submit"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();
    $.ajax({
      url: 'admin/ajax.php?action=login2',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

      },
      success: function (resp) {
        if (resp == 1) {
          // Reload the current page after a successful login
          location.reload();
        } else if (resp == 2) {
          $('#login-frm').prepend('<div class="alert alert-danger">Your account is not yet verified.</div>');
          $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
        } else {
          $('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>');
          $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
        }
      }
    })
  })

  var state = false;
  function toggle() {
    if (state) {
      document.getElementById("password").setAttribute("type", "password");
      document.getElementById("eye").style.color = '#7a797e';
      state = false;
    }
    else {
      document.getElementById("password").setAttribute("type", "text");
      document.getElementById("eye").style.color = '#5887ef';
      state = true;
    }
  }
</script>