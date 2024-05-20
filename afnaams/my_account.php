<?php
include 'admin/db_connect.php';

if (!isset($_SESSION['bio'])) {
  echo "<script>location.href='index.php?page=my_account';</script>";
  exit;
}
?>
<style>
  .masthead {
    min-height: 23vh !important;
    height: 23vh !important;
  }

  .masthead:before {
    min-height: 23vh !important;
    height: 23vh !important;
  }

  img#cimg {
    max-height: 10vh;
    max-width: 6vw;
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

<section id="hero-about" class="d-flex align-items-center">
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="d-flex justify-content-center" data-aos="zoom-out" data-aos-delay="500">
        <h1 style="margin-bottom : 50px">Update Account</h1>
      </div>
    </div>
  </div>

  <div class="container mt-3 pt-2" data-aos="zoom-out" data-aos-delay="1000">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <form action="" id="update_account">
                <div class="row form-group">
                  <div class="col-md-4">
                    <label for="" class="control-label">First Name</label>
                    <input type="text" class="form-control" name="firstname"
                      value="<?php echo isset($_SESSION['bio']['firstname']) ? $_SESSION['bio']['firstname'] : ''; ?>"
                      required>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="control-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname"
                      value="<?php echo isset($_SESSION['bio']['lastname']) ? $_SESSION['bio']['lastname'] : ''; ?>"
                      required>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="control-label">Middle Name</label>
                    <input type="text" class="form-control" name="middlename"
                      value="<?php echo isset($_SESSION['bio']['middlename']) ? $_SESSION['bio']['middlename'] : ''; ?>">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-3">
                    <label for="" class="control-label">Gender</label>
                    <select class="custom-select" name="gender" required>
                      <option value="Male" <?php echo (isset($_SESSION['bio']['gender']) && $_SESSION['bio']['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                      <option value="Female" <?php echo (isset($_SESSION['bio']['gender']) && $_SESSION['bio']['gender'] === 'Female') ? 'selected' : ''; ?>>Female
                      </option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="birthday" class="control-label">Birthday:</label>
                    <script type="text/javascript">
                      $(document).ready(function () {
                        $('#datepicker').datepicker({
                          onSelect: function (value, ui) {
                            // Parse the selected date and current date
                            var selectedDate = new Date(ui.selectedYear, ui.selectedMonth, ui.selectedDay);
                            var currentDate = new Date();

                            // Calculate age
                            var age = currentDate.getFullYear() - selectedDate.getFullYear();

                            // Check if the birthdate has occurred this year
                            if (currentDate.getMonth() < selectedDate.getMonth() || (currentDate.getMonth() === selectedDate.getMonth() && currentDate.getDate() < selectedDate.getDate())) {
                              age--;
                            }

                            // Set the age input field
                            $('#age').val(age);

                            // Set the hidden field for the selected date (if needed)
                            $('#todayb').val(value);
                          },
                          changeMonth: true,
                          changeYear: true,
                          dateFormat: 'mm/dd/yy',
                          yearRange: '1954:2054' // Adjust the range of years as per your requirement
                        });
                      });
                    </script>
                    <br>
                    <input type="input" id="datepicker" name="birthday" class="form-control"
                      value="<?php echo isset($_SESSION['bio']['birthday']) ? $_SESSION['bio']['birthday'] : ''; ?>">
                  </div>
                  <div class="col-md-3">
                    <label for="">Age:</label><br>
                    <input class="form-control" type="text" id="age" name="age"
                      value="<?php echo isset($_SESSION['bio']['age']) ? $_SESSION['bio']['age'] : ''; ?>">
                  </div>
                  <div class="col-md-3">
                    <label for="">Address:</label><br>
                    <input class="form-control" type="text" id="address" name="address"
                      value="<?php echo isset($_SESSION['bio']['address']) ? $_SESSION['bio']['address'] : ''; ?>">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-4">
                    <label for="" class="control-label">Image</label>
                    <input type="file" class="form-control" name="img" onchange="displayImg(this, $(this))">
                    <img src="admin/assets/uploads/<?php echo $_SESSION['bio']['avatar'] ?>" alt="" id="cimg">
                  </div>
                  <div class="col-md-4">
                    <label for="" class="control-label">Email</label>
                    <input type="email" class="form-control" name="email"
                      value="<?php echo $_SESSION['bio']['email'] ?>" required>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="control-label">Password</label>
                    <div class="password-container">
                      <input type="password" class="form-control" name="password">
                      <span class="EyePass">
                        <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
                      </span>
                    </div>
                    <small><i>Leave this blank if you don't want to change your
                        password</i></small>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <div id="msg">
                    </div>
                    <button id="submitBtn" class="btn btn-primary">Update Account</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('.datepickerY').datepicker({
      format: " yyyy",
      viewMode: "years",
      minViewMode: "years"
    })
    $('.select2').select2({
      placeholder: "Please Select Here",
      width: "100%"
    })

    function displayImg(input, _this) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    $('#update_account').submit(function (e) {
      e.preventDefault();
      start_load();
      $.ajax({
        url: 'admin/ajax.php?action=update_account',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
          if (resp == 1) {
            alert_toast("Account successfully updated, Please Login Again", 'success');
            setTimeout(function () {
              location.reload();
            }, 700);
          }
          end_load();
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

    const submitBtn = document.getElementById("submitBtn");

    // Function to validate the password
    function validatePassword() {
      var passwordInput = document.getElementsByName("password")[0];
      var password = passwordInput.value;

      // Define regex patterns for special characters, uppercase letters, lowercase letters, and numbers
      var specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
      var uppercaseRegex = /[A-Z]/;
      var lowercaseRegex = /[a-z]/;
      var numberRegex = /[0-9]/;

      // Check if the password meets all criteria
      var isLengthValid = password.length >= 8;
      var hasSpecialChar = specialCharRegex.test(password);
      var hasUppercase = uppercaseRegex.test(password);
      var hasLowercase = lowercaseRegex.test(password);
      var hasNumber = numberRegex.test(password);

      // Display appropriate error messages
      var errorMsg = '';
      if (!isLengthValid) {
        errorMsg += 'Password must be at least 8 characters long. ';
      }
      if (!hasSpecialChar) {
        errorMsg += 'Password must contain at least one special character. ';
      }
      if (!hasUppercase) {
        errorMsg += 'Password must contain at least one uppercase letter. ';
      }
      if (!hasLowercase) {
        errorMsg += 'Password must contain at least one lowercase letter. ';
      }
      if (!hasNumber) {
        errorMsg += 'Password must contain at least one number. ';
      }

      // Update the error message and enable/disable the submit button
      if (errorMsg !== '') {
        document.getElementById("msg").innerHTML = '<div class="alert alert-danger">' + errorMsg + '</div>';
        document.getElementById("submitBtn").setAttribute("disabled", "disabled");
      } else {
        document.getElementById("msg").innerHTML = '';
        document.getElementById("submitBtn").removeAttribute("disabled");
      }
    }
    // Add an event listener to the password input to trigger validation
    document.getElementsByName("password")[0].addEventListener("keyup", validatePassword);

  </script>
</section>