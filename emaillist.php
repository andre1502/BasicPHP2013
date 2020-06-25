<?php
  include("includes/config.php");
  include("includes/check_notlogin.php");

  $uname = $s_uname;

  if (isset($_REQUEST["act"]) && (mysqli_real_escape_string($con, $_REQUEST["act"]) == "delete")) {
    $eaddr = mysqli_real_escape_string($con, $_REQUEST["q"]);

    $sql = "DELETE FROM user_email WHERE user_id = '{$uname}' and email = '{$eaddr}'";
    mysqli_query($con, $sql);
    header("Location: complete.php");
  }
?>

<html>
	<head>
		<title>List of Email Address Page</title>
	</head>
	<body>
	  <?php
      $ctr = 1;

      $sql = "SELECT * FROM user_email WHERE user_id = '{$uname}'";
      $result = mysqli_query($con, $sql);

      echo "<table border=1>";
      echo "<tr>";
      echo "<td>No.</td>";
      echo "<td>メールアドレス</td>";
      echo "<td>削除</td>";
      echo "</tr>";
      while($data = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$ctr."</td>";
        echo "<td>".$data['email']."</td>";
        echo "<td><input type='button' value='削除する' onClick=window.location='emaillist.php?act=delete&q=".$data['email']."'></td>";
        echo "</tr>";

        $ctr++;
      }
      echo "</table>";
		?>
    <input type="button" value="追加する" onclick="window.location.assign('addemail.php')" />
    <!--<input type="button" value="バック" onclick="window.location.assign('index.php')" />-->
	</body>
</html>
