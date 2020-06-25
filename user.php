<?php
  include("includes/config.php");
  include("includes/check_notlogin.php");
  include("includes/validation.php");

  $uname = $s_uname;
  $upass = "";
  $cupass = "";

  $upassmsg = "";
  $cupassmsg = "";

  if (isset($_REQUEST["formsubmit"])) {
		$upass = mysqli_real_escape_string($con, $_REQUEST["upass"]);
		$cupass = mysqli_real_escape_string($con, $_REQUEST["cupass"]);

    $valid = new validation();

    $upassmsg = $valid->checkValidRegPassword($upass);
    $cupassmsg = $valid->checkValidRegConfirmPassword($cupass);

    unset($valid);

		if ($upassmsg == "success" && $cupassmsg == "success") {
      $sql = "UPDATE user SET password = '".$upass."' WHERE user_id = '".$uname."'";
      mysqli_query($con, $sql);
      header("Location: complete.php");
		}
  }
?>

<html>
	<head>
		<title>User Information Page</title>
	</head>
	<body>
    変更内容を入力してください。<br/>
    <form action="#" method="post">
    <table border="0">
    <tr>
      <td>パスワード</td>
      <?php
        if (isset($_REQUEST['formsubmit'])) {
          if ($upassmsg == "success") {
      ?>
      <td><input type="password" name="upass" id="upass" /></td>
      <?php
          } else {
      ?>
      <td><input type="password" name="upass" id="upass" style="background-color:lightpink" /></td>
      <?php
          }
        } else {
      ?>
      <td><input type="password" name="upass" id="upass" /></td>
      <?php
        }
      ?>
    </tr>
    <?php
      if (isset($_REQUEST['formsubmit'])) {
        if ($upassmsg != "success") {
    ?>
    <tr>
      <td>&nbsp;</td>
      <td><span style="color:red"><?php echo $upassmsg; ?></span></td>
    </tr>
    <?php
        }
      }
    ?>
    <tr>
      <td>パスワード(確認用)</td>
      <?php
        if (isset($_REQUEST['formsubmit'])) {
          if ($cupassmsg == "success") {
      ?>
      <td><input type="password" name="cupass" id="cupass" /></td>
      <?php
          } else {
      ?>
      <td><input type="password" name="cupass" id="cupass" style="background-color:lightpink" /></td>
      <?php
          }
        } else {
      ?>
      <td><input type="password" name="cupass" id="cupass" /></td>
      <?php
        }
      ?>
    </tr>
    <?php
      if (isset($_REQUEST['formsubmit'])) {
        if ($cupassmsg != "success") {
    ?>
    <tr>
      <td>&nbsp;</td>
      <td><span style="color:red"><?php echo $cupassmsg; ?></span></td>
    </tr>
    <?php
        }
      }
    ?>
    </table>
    <input type="hidden" name="formsubmit" value="SubmitPage" />
    <input type="submit" value="変更する" />
    <!--<input type="button" value="バック" onclick="window.location.assign('index.php')" />-->
    </form>
	</body>
</html>
