<?php
  $s_login = "";
  $s_uname = "";
  if (isset($_SESSION["login"])) {
    $s_login = $_SESSION["login"];
    $s_uname = $_SESSION["user-name"];
    $_SESSION["login"] = $s_login;
    $_SESSION["user-name"] = $s_uname;
  } else {
    session_destroy();
    header("Location: index.php");
  }
?>
