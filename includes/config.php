<?php
  header("Content-type: text/html; charset=utf-8");

  ini_set('session.gc_maxlifetime', 86400);
  ini_set('session.cookie_lifetime', 86400);
  ini_set('session.use_only_cookies', 1);
  ini_set('session.use_trans_sid', 0);
  ini_set('session.gc_probability', 1);
  ini_set('session.gc_divisor', 1);

  session_start();

  $server = "localhost";
  $username = "root";
  $password = "BCPfTYVmtYtFTrPL";
  $con = mysqli_connect($server, $username, $password) or die("I couldn't connect to your database, please make sure your info is correct!");
  mysqli_select_db($con, "ums_dbase") or die("I couldn't find the database table make sure it's spelt right!");
  mysqli_query($con, "SET NAMES utf8");

  function EmailValidation($email) {
    $email = htmlspecialchars(stripslashes(strip_tags($email))); //parse unnecessary characters to prevent exploits
    if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
      return True;
    } else { return False; }
    /*if (eregi ("[a-z||0-9]@[a-z||0-9].[a-z]", $email ) ) { //checks to make sure the email address is in a valid format
      return True;
    } else { return False; }*/
  }
?>
