<?php
  session_start();
  unset($_SESSION['w_user_id']);
  session_destroy();
  header("location:index.php");
?>
