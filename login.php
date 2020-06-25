<?php
  include("includes/config.php");
  include("includes/check_login.php");

  $uname = "";
  $upass = "";

  $unamemsg = "";
  $upassmsg = "";
  $loginmsg = "";

  if (isset($_REQUEST["formsubmit"])) {
		$uname = mysqli_real_escape_string($con, $_REQUEST["uname"]);
		$upass = mysqli_real_escape_string($con, $_REQUEST["upass"]);

		if ($uname == "") {
		  $unamemsg = "必須です。";
		} else { $unamemsg = "success"; }

		if ($upass == "") {
		  $upassmsg = "必須です。";
		} else { $upassmsg = "success"; }

		if ($uname != "" && $upass != "") {
			$sql = "SELECT count(*) as rowcount, active FROM user WHERE user_id = '".$uname."' and password = '".$upass."'";
			$result = mysqli_query($con, $sql);
			$data = mysqli_fetch_assoc($result);
			if ($data["rowcount"] <= 0) {
				$loginmsg = "ユーザーIDもしくはパスワードが間違えています。";
			} else if ($data["active"] == 0) {
				$loginmsg = "ユーザーもアクティブでない。";
			} else { $loginmsg = "success"; }
		}

		if ($loginmsg == "success") {
      $_SESSION["login"] = "log-in";
      $_SESSION["user-name"] = $uname;
      header("Location: index.php");
		}
  }
?>

<html>
	<head>
		<title>Login Page</title>
	</head>
	<body>
    登録済みのメールアドレスとパスワードを入力して、ログインしてください。<br/>
    <form action="#" method="post">
    <table border="0">
    <tr>
      <td>ユーザーID</td>
      <?php
        if (isset($_REQUEST['formsubmit'])) {
          if ($unamemsg == "success") {
      ?>
      <td><input type="text" name="uname" id="uname" value="<?php if (isset($_REQUEST['formsubmit'])) { echo htmlentities($uname); } else { echo htmlentities(''); } ?>" /></td>
      <?php
          } else {
      ?>
      <td><input type="text" name="uname" id="uname" value="<?php if (isset($_REQUEST['formsubmit'])) { echo htmlentities($uname); } else { echo htmlentities(''); } ?>" style="background-color:lightpink" /></td>
      <?php
          }
        } else {
      ?>
      <td><input type="text" name="uname" id="uname" value="<?php if (isset($_REQUEST['formsubmit'])) { echo htmlentities($uname); } else { echo htmlentities(''); } ?>" /></td>
      <?php
        }
      ?>
    </tr>
    <?php
      if (isset($_REQUEST['formsubmit'])) {
        if ($unamemsg != "success") {
    ?>
    <tr>
      <td>&nbsp;</td>
      <td><span style="color:red"><?php echo $unamemsg; ?></span></td>
    </tr>
    <?php
        }
      }
    ?>
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
    <?php
      if (isset($_REQUEST['formsubmit'])) {
        if ($loginmsg != "success") {
    ?>
    <tr>
      <td>&nbsp;</td>
      <td><span style="color:red"><?php echo $loginmsg; ?></span></td>
    </tr>
    <?php
        }
      }
    ?>
    </table>
    <input type="hidden" name="formsubmit" value="SubmitPage" />
    <input type="submit" value="ログイン" />
    <!--<input type="button" value="バック" onclick="window.location.assign('index.php')" />-->
    </form>
	</body>
</html>
