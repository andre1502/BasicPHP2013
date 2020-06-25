<?php
  include("includes/config.php");
  include("includes/check_login.php");
  include("includes/validation.php");
  require_once("phpmailer/class.phpmailer.php");

  $success = False;
  $uname = "";
  $eaddr = "";
  $upass = "";
  $cupass = "";
  $chagree = "";

  $unamemsg = "";
  $eaddrmsg = "";
  $upassmsg = "";
  $cupassmsg = "";
  $chagreemsg = "";

  if (isset($_REQUEST["formsubmit"])) {
		$uname = mysqli_real_escape_string($con, $_REQUEST["uname"]);
		$eaddr = mysqli_real_escape_string($con, $_REQUEST["eaddr"]);
		$upass = mysqli_real_escape_string($con, $_REQUEST["upass"]);
		$cupass = mysqli_real_escape_string($con, $_REQUEST["cupass"]);
		$chagree = isset($_REQUEST["chagree"]);

    $valid = new validation();

    $unamemsg = $valid->checkValidRegUsername($uname);
    $eaddrmsg = $valid->checkValidRegEmailAddress($eaddr);
    $upassmsg = $valid->checkValidRegPassword($upass);
    $cupassmsg = $valid->checkValidRegConfirmPassword($cupass);
    $chagreemsg = $valid->checkValidRegTermAgree($chagree);

    unset($valid);

		if ($unamemsg == "success" && $eaddrmsg == "success" && $upassmsg == "success" && $cupassmsg == "success" && $chagreemsg == "success") {
		  $success = True;
		}
  }
?>

<html>
	<head>
		<title>
			<?php
				$title = $success ? "Registration Success" : "Registration Page";
				echo $title;
			?>
		</title>
	</head>
	<body>
	  <?php
			if ($success) {
        $today = date("Y-m-d H:i:s");
			  $token = md5($uname.$eaddr.$today);

				$sql = "INSERT INTO user (user_id, password, token, token_expire) VALUES ('".$uname."','".$upass."','".$token."',INTERVAL 1 HOUR + SYSDATE())";
				mysqli_query($con, $sql);

				$sql = "INSERT INTO user_email (email,user_id) VALUES ('".$eaddr."','".$uname."')";
				mysqli_query($con, $sql);

				$to = $eaddr;
        $reply = "no-reply";
        $ereply = "no-reply@gotandadenshi.jp";
        $sender = "administrator";
        $esender = "sender@gotandadenshi.jp";
				$subject = "仮登録完了のお知らせ";

        $header = "MIME-version: 1.0"."\r\n";
        $header .= "Content-type: text/plain; charset=UTF-8"."\r\n";
        $header .= "From: {$sender}<{$esender}>"."\r\n";
        $header .= "Reply-To: {$ereply}"."\r\n";
        $header .= "Subject: {$subject}"."\r\n";
        $header .= "X-Mailer: PHP/".phpversion();

        $message = "&lt;&lt;&lt;{$uname}&gt;&gt;&gt; 様"."<br /><br />";
        $message .= "仮登録いただき、ありがとうございます。"."<br /><br />";
        $message .= "※ 仮登録の覚えのない場合は、たいへんお手数ですが、"."<br />";
        $message .= "メールを破棄していただきますよう、お願いいたします。"."<br /><br /><br />";
        $message .= "現在、仮登録状態です。"."<br /><br /><br />";
        $message .= "以下のURLへアクセスすることにより、本登録が完了いたします。"."<br /><br />";
        $message .= "<a href='http://localhost/practice1_andrelukito/confirmation.php?token=".$token."'>http://localhost/practice1_andrelukito/confirmation.php?token=".$token."</a><br /><br />";
        $message .= "お手続きいただきますよう、よろしくお願いいたします。";

        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();

        try {
          $mail->Host = "mail.gotandadenshi.jp";
          $mail->Port = 587;
          $mail->AddReplyTo($ereply, $reply);
          $mail->AddAddress($to, $uname);
          $mail->SetFrom($esender, $sender);
          $mail->Subject = $subject;
          $mail->MsgHTML($message);

          if($mail->Send()) {
            echo "仮登録が完了しました。"."<br />";
            echo "ご登録されたメールアドレス宛てに、"."<br />";
            echo "本登録手続きのメールを送りましたので、ご確認ください。"."<br />";
          } else {
            $sql = "DELETE FROM user WHERE user_id = '".$uname."'";
            mysqli_query($con, $sql);

            $sql = "DELETE FROM user_email WHERE email = '".$eaddr."'";
            mysqli_query($con, $sql);

            echo "エラーは、メールを送った。再度登録してください。"."<br />";
          }
        } catch (phpmailerException $e) {
          $sql = "DELETE FROM user WHERE user_id = '".$uname."'";
          mysqli_query($con, $sql);

          $sql = "DELETE FROM user_email WHERE email = '".$eaddr."'";
          mysqli_query($con, $sql);

          echo "エラーは、メールを送った。再度登録してください。"."<br />";
          echo $e->errorMessage()."<br />"; //Pretty error messages from PHPMailer
        } catch (Exception $e) {
          $sql = "DELETE FROM user WHERE user_id = '".$uname."'";
          mysqli_query($con, $sql);

          $sql = "DELETE FROM user_email WHERE email = '".$eaddr."'";
          mysqli_query($con, $sql);

          echo "エラーは、メールを送った。再度登録してください。"."<br />";
          echo $e->getMessage()."<br />"; //Boring error messages from anything else!
        }

				//echo "<a href='index.php'>バック</a>";

			} else {
		?>
				会員登録情報を入力してください       <br/>
				<form action="#" method="post">
				<table border="0">
				<tr>
					<td>ユーザID </td>
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
					<td>メールアドレス  </td>
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
				<tr>
					<td>パスワード  </td>
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
					<td>パスワード(確認用)    </td>
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
				<tr>
					<td>&nbsp;</td>
					<?php
						if (isset($_REQUEST['formsubmit'])) {
							if ($chagreemsg == "success") {
					?>
					<td><input type="checkbox" name="chagree" id="chagree" value="Yes" checked="checked" />規約に同意する    </td>
					<?php
							} else {
					?>
					<td style="background-color:lightpink"><input type="checkbox" name="chagree" id="chagree" value="Yes" />規約に同意する    </td>
					<?php
							}
						} else {
					?>
					<td><input type="checkbox" name="chagree" id="chagree" value="Yes" />規約に同意する    </td>
					<?php
						}
					?>
				</tr>
				<?php
					if (isset($_REQUEST['formsubmit'])) {
						if ($chagreemsg != "success") {
				?>
				<tr>
				  <td>&nbsp;</td>
					<td><span style="color:red"><?php echo $chagreemsg; ?></span></td>
				</tr>
				<?php
						}
					}
				?>
				</table>
				<input type="hidden" name="formsubmit" value="SubmitPage" />
				<input type="submit" value="登録する" />
        <!--<input type="button" value="バック" onclick="window.location.assign('index.php')" />-->
				</form>
		<?php
			}
		?>
	</body>
</html>
