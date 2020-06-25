<?php
  class validation {
    private $uname, $eaddr, $upass, $cupass, $chagree;
    private $unamelen, $eaddrlen, $upasslen, $cupasslen, $chagreelen;

    public function __construct() {
      $this->uname = "";
      $this->eaddr = "";
      $this->upass = "";
      $this->cupass = "";
      $this->chagree = "";

      $this->unamelen = 0;
      $this->eaddrlen = 0;
      $this->upasslen = 0;
      $this->cupasslen = 0;
      $this->chagreelen = 0;
    }

    /**
     * @assert ("") == "必須です。"
     * @assert ("123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890") == "255文字以下で入力してください。"
     * @assert ("testing") == "このユーザIDは登録済みです。"
     * @assert ("pastiada") == "success"
     */
    public function checkValidRegUsername($uname) {
      $this->uname = $uname;
      $this->unamelen = strlen($uname);

      if ($this->uname == "") {
        return "必須です。";
      } else if ($this->unamelen > 255) {
        return "255文字以下で入力してください。";
      } else {
        $sql = "SELECT count(*) as rowcount FROM user WHERE user_id = '".$this->uname."'";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        if ($data["rowcount"] > 0) {
          return "このユーザIDは登録済みです。";
        } else { return "success"; }
      }
    }

    /**
     * @assert ("") == "必須です。"
     * @assert ("123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890") == "255文字以下で入力してください。"
     * @assert ("email") == "メールアドレスの形式が正しくありません。"
     * @assert ("a@a.com") == "メールアドレスの形式が正しくありません。"
     * @assert ("abc@gotandadenshi.jp") == "このメールアドレスは登録済みです。"
     * @assert ("abc@abc.it") == "success"
     */
    public function checkValidRegEmailAddress($eaddr) {
      $this->eaddr = $eaddr;
      $this->eaddrlen = strlen($eaddr);

      if ($this->eaddr == "") {
        return "必須です。";
      } else if ($this->eaddrlen > 255) {
        return "255文字以下で入力してください。";
      } else if (EmailValidation($this->eaddr)) {
        return "メールアドレスの形式が正しくありません。";
      } else {
        $sql = "SELECT count(*) as rowcount FROM user_email WHERE email = '".$this->eaddr."'";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        if ($data["rowcount"] > 0) {
          return "このメールアドレスは登録済みです。";
        } else { return "success"; }
      }
    }

    /**
     * @assert ("") == "必須です。"
     * @assert ("abc") == "6文字以上で入力してください。"
     * @assert ("12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901") == "100文字以下で入力してください。"
     * @assert ("testing") == "success"
     */
    public function checkValidRegPassword($upass) {
      $this->upass = $upass;
      $this->upasslen = strlen($upass);

      if ($this->upass == "") {
        return "必須です。";
      } else if ($this->upasslen < 6) {
        return "6文字以上で入力してください。";
      } else if ($this->upasslen > 100) {
        return "100文字以下で入力してください。";
      } else { return "success"; }
    }

    /**
     * @assert ("") == "必須です。"
     * @assert ("testing") == "success"
     */
    public function checkValidRegConfirmPassword($cupass) {
      $this->cupass = $cupass;
      $this->cupasslen = strlen($cupass);

      if ($this->cupass == "") {
        return "必須です。";
      } else if ($this->upass != $this->cupass) {
        return "パスワードと一致していません。";
      } else { return "success"; }
    }

    /**
     * @assert ("") == "規約に同意してください。"
     * @assert ("Yes") == "success"
     */
    public function checkValidRegTermAgree($chagree) {
      $this->chagree = $chagree;
      $this->chagreelen = strlen($chagree);

      if ($this->chagree == "Yes") {
        return "success";
      } else { return "規約に同意してください。"; }
    }
  }
?>
