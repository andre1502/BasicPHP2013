<?php
  include("includes/config.php");
  include("includes/check_login.php");

  if (isset($_REQUEST["token"])) {
    $token = mysqli_real_escape_string($con, $_REQUEST["token"]);
    $uname = "";
    $active = 0;
    $dtdiff = "";

    $sql = "SELECT user_id, active, TIMESTAMPDIFF(SECOND, sysdate(), token_expire) AS tsdiff FROM user WHERE token = '".$token."'";
    $result = mysqli_query($con, $sql);
    while($data=mysqli_fetch_assoc($result)) {
      $uname = $data["user_id"];
      $active = $data["active"];
      $dtdiff = $data["tsdiff"];
    }

    if ($uname == "") {
      echo "URLが不正です。"."<br />";
      echo "再度登録を行ってください。"."<br />";
    } else {
      if ($active == 1) {
        echo "登録済みです。"."<br />";
      } else {
        if ($dtdiff > 0) {
          $sql = "UPDATE user SET active = 1 WHERE user_id = '".$uname."'";
          mysqli_query($con, $sql);

          echo "本登録が完了しました。"."<br />";
          echo "引き続き、本サイトをお楽しみください。"."<br />";
        } else {
          $sql = "DELETE FROM user WHERE user_id = '".$uname."'";
          mysqli_query($con, $sql);

          $sql = "DELETE FROM user_email WHERE user_id = '".$uname."'";
          mysqli_query($con, $sql);

          echo "URLは有効期限切れです。"."<br />";
          echo "再度登録を行ってください。"."<br />";
        }
      }
    }
    echo "<a href='index.php'>トップページへ戻る"."</a>";
  } else {
    echo "URLが不正です。"."<br />";
    echo "再度登録を行ってください。"."<br />";
    echo "<a href='index.php'>トップページへ戻る"."</a>";
  }
?>
