<?php
  include("includes/config.php");
?>
<html>
	<head>
    <!--<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">-->
		<title>Top Page</title>
	</head>
	<body>
		<?php
      if (isset($_REQUEST["act"])) {
        $act = mysqli_real_escape_string($con, $_REQUEST["act"]);
        if ($act == "logout") {
          session_destroy();
          header("Location: index.php");
        }
      }

      if (isset($_SESSION["login"])) {
        if ($_SESSION["login"] == "log-in") {
          $s_login = $_SESSION["login"];
          $s_uname = $_SESSION["user-name"];
          $_SESSION["login"] = $s_login;
          $_SESSION["user-name"] = $s_uname;

          $uname = $s_uname;
          echo "こんにちは。 {$uname} 様。<br />";
		?>
		<a href="index.php?act=logout">ログアウト</a><br />
		<a href="user.php">ユーザ情報更新</a> <br />
		<a href="emaillist.php">メールアドレス一覧</a>
		<?php
		  	} else {
    ?>
    <a href="registration.php">まずは会員登録をしてください。</a> <br />
    <a href="login.php">会員登録済みの方はログインしてください。</a>
    <?php
        }
		  } else {
		?>
		<a href="registration.php">まずは会員登録をしてください。</a> <br />
		<a href="login.php">会員登録済みの方はログインしてください。</a>
		<?php
		  }
		?>
	</body>
</html>
