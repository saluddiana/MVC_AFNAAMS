<style>
  nav#sidebar {
    background: #2C3E50;
    height: 100%;
    position: fixed;
    width: 250px;
    z-index: 1;
    overflow-x: hidden;
    transition: 0.5s;
  }

  .sidebar-list {
    padding: 0;
    list-style: none;
    margin-top: 3px;
  }

  .nav-item {
    padding: 10px;
    text-decoration: none;
    font-size: 16px;
    color: #ecf0f1;
    display: block;
    transition: 0s;
  }

  .nav-item:hover {
    background-color: #1F2933;
    color: #ffffff;
  }

  .nav-item:not(.active) {
    background-color: #2C3E50;
    color: #fff;
  }

  .active {
    background-color: #1F2933;
    color: #ffffff;
  }

  .icon-field {
    margin-right: 10px;
  }

  .brand-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    margin-top: -20px;
  }

  .brand-logo img {
    max-width: 100%;
    height: auto;
  }
</style>

<nav id="sidebar">
  <div class="sidebar-list">
    <a href="index.php?page=home" class="nav-item nav-home active">
      <span class='icon-field'><i class="fa-solid fa-gauge"></i></span> Dashboard
    </a>
    <a href="index.php?page=list_non_academic_request" class="nav-item nav-list_non_academic_request"
      style="font-size: 0.8em;">
      <span class='icon-field'> <i class="fa-solid fa-list-check"></i></span> All Non-Academic Requested
    </a>
    <a href="index.php?page=list_non_academic_approved" class="nav-item nav-list_non_academic_approved"
      style="font-size: 0.8em;">
      <span class='icon-field'> <i class="fas fa-award"></i></span> All Non-Academic Awards List
    </a>
    <H5 class=" text-white p-1 ml-3">Departments</H5>
    <a href="index.php?page=list_cics" class="nav-item nav-list_cics">
      <span class='icon-field'> <i class="fas fa-award"></i></span> CICS
    </a>
    <a href="index.php?page=list_caste" class="nav-item nav-list_caste">
      <span class='icon-field'> <i class="fas fa-award"></i></span> CASTE
    </a>
    <a href="index.php?page=list_ccje" class="nav-item nav-list_ccje">
      <span class='icon-field'> <i class="fas fa-award"></i></span> CCJE
    </a>
    <a href="index.php?page=list_cbm" class="nav-item nav-list_cbm">
      <span class='icon-field'> <i class="fas fa-award"></i></span> CBM
    </a>

    <a href="index.php?page=list_students" class="nav-item nav-list_students">
      <span class='icon-field'>
        <i class="fa-solid fa-users-line"></i>
      </span> All students
    </a>
    <a href="index.php?page=users" class="nav-item nav-users">
      <span class='icon-field'><i class="fa-solid fa-users-gear"></i></span> Manage Students
    </a>
    <a href="index.php?page=archives" class="nav-item nav-archives">
      <span class='icon-field'><i class="fa-solid fa-box-archive"></i></span> Archive History
    </a>
  </div>
</nav>

<script>
  $('.nav_collapse').click(function () {
    console.log($(this).attr('href'))
    $($(this).attr('href')).collapse()
  })
  $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
  if ('<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>' !== 'home') {
    $('.nav-home').removeClass('active');
  }
</script>