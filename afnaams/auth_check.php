<?php
if (!isset($_SESSION['login_id'])) {
  echo '<script>var openLoginModal = true;</script>';
}
?>