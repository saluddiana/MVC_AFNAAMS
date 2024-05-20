<?php
include ('db_connect.php');

?>


<style>
  .navbar {
    background-color: #55741C;
    min-height: 4.5rem;
  }

  .brand-logo {
    top: -10%;
    transform: translateY(10%);
    margin-left: -65%;
  }

  .dropdown-toggle:hover {
    color: #eea000 !important;
    transition: 0.4s;
  }

  .dropdown-item:hover {
    color: #eea000;
  }

  .dropdown-item:focus {
    color: #eea000;
    background-color: transparent !important;
  }

  .users {
    top: -70%;
    transform: translateY(70%);
  }

  .bell {
    top: -25%;
    transform: translateY(25%);
  }
</style>

<nav class="navbar navbar-light fixed-top" style="padding:0;min-height: 4.5rem">
  <div class="container-fluid mt-2 mb-2">
    <div class="col-lg-12">
      <div class="col-md-4 float-left">
        <a href="index.php?page=home" class="brand-logo">
          <img src="../assets/img/sjcbaggao.png" style="width: 15em;" alt="Company Brand Logo">
        </a>
      </div>

      <div class="float-right users">
        <div class="dropdown mr-4">
          <a href="#" class="text-white dropdown-toggle dropdown-link" id="account_settings" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-user mr-2"></i>
            <?php echo $_SESSION['login_name'] ?>
          </a>
          <div class="dropdown-menu dropdown-link" aria-labelledby="account_settings" style="left: -4.70em;">
            <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage
              Account</a><a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i>
              Logout</a>

          </div>

        </div>

      </div>
    </div>

  </div>
</nav>

<script>
  $('#manage_my_account').click(function () {
    uni_modal("Manage Account", "manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>