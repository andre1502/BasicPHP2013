<?php
  include("includes/config.php");
  include("includes/check_notlogin.php");
  include("includes/validation.php");

  $uname = $s_uname;
  $eaddr = "";

  $eaddrmsg = "";

  if (isset($_REQUEST["formsubmit"])) {
    $eaddr = mysqli_real_escape_string($con, $_REQUEST["eaddr"]);

    $valid = new validation();

    $eaddrmsg = $valid->checkValidRegEmailAddress($eaddr);

    unset($valid);

    if ($eaddrmsg == "success") {
      $sql = "INSERT INTO user_email (email,user_id) VALUES ('".$eaddr."','".$uname."')";
      mysqli_query($con, $sql);
      header("Location: complete.php");
    }
  }
?>

<html>
  <head>
    <title>Add Email Address Page</title>
  </head>
  <body>
    メールアドレスを入力してください<br/>
    <form action="#" method="post">
    <table border="0">
    <tr>
    <tr>
      <td>メールアドレス</td>
      <?php
        if (isset($_REQUEST['formsubmit'])) {
          if ($eaddrmsg == "success") {
      ?>
      <td><input type="text" name="eaddr" id="eaddr" value="<?php if (isset($_REQUEST['formsubmit'])) { echo htmlentities($eaddr); } else { echo htmlentities(''); } ?>" /></td>
      <?php
          } else {
      ?>
      <td><input type="text" name="eaddr" id="eaddr" value="<?php if (isset($_REQUEST['formsubmit'])) { echo htmlentities($eaddr); } else { echo htmlentities(''); } ?>" style="background-color:lightpink" /></td>
      <?php
          }
        } else {
      ?>
      <td><input type="text" name="eaddr" id="eaddr" value="<?php if (isset($_REQUEST['formsubmit'])) { echo htmlentities($eaddr); } else { echo htmlentities(''); } ?>" /></td>
      <?php
        }
      ?>
    </tr>
    <?php
      if (isset($_REQUEST['formsubmit'])) {
        if ($eaddrmsg != "success") {
    ?>
    <tr>
      <td>&nbsp;</td>
      <td><span style="color:red"><?php echo $eaddrmsg; ?></span></td>
    </tr>
    <?php
        }
      }
    ?>
    </table>
    <input type="hidden" name="formsubmit" value="SubmitPage" />
    <input type="submit" value="追加する" />
    <!--<input type="button" value="バック" onclick="window.location.assign('emaillist.php')" />-->
    </form>
  </body>
</html>
