<?php
  include("../../config.php");
  include("../../validation.php");

  /**
   * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-11-23 at 10:33:49.
   */
  class validationTest extends PHPUnit_Framework_TestCase {

    /**
     * @var validation
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
      $this->object = new validation();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
      unset($this->object);
    }

    /**
     * Generated from @assert ("") == "必須です。".
     *
     * @covers validation::checkValidRegUsername
     */
    public function testCheckValidRegUsername() {
      $this->assertEquals("必須です。", $this->object->checkValidRegUsername(""));
    }

    /**
     * Generated from @assert ("123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890") == "255文字以下で入力してください。".
     *
     * @covers validation::checkValidRegUsername
     */
    public function testCheckValidRegUsername2() {
      $this->assertEquals("255文字以下で入力してください。",$this->object->checkValidRegUsername("123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"));
    }

    /**
     * Generated from @assert ("testing") == "このユーザIDは登録済みです。".
     *
     * @covers validation::checkValidRegUsername
     */
    public function testCheckValidRegUsername3() {
      $this->assertEquals("このユーザIDは登録済みです。", $this->object->checkValidRegUsername("testing"));
    }

    /**
     * Generated from @assert ("pastiada") == "success".
     *
     * @covers validation::checkValidRegUsername
     */
    public function testCheckValidRegUsername4() {
      $this->assertEquals("success", $this->object->checkValidRegUsername("pastiada"));
    }

    /**
     * Generated from @assert ("") == "必須です。".
     *
     * @covers validation::checkValidRegEmailAddress
     */
    public function testCheckValidRegEmailAddress() {
      $this->assertEquals("必須です。", $this->object->checkValidRegEmailAddress(""));
    }

    /**
     * Generated from @assert ("123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890") == "255文字以下で入力してください。".
     *
     * @covers validation::checkValidRegEmailAddress
     */
    public function testCheckValidRegEmailAddress2() {
      $this->assertEquals("255文字以下で入力してください。", $this->object->checkValidRegEmailAddress("123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"));
    }

    /**
     * Generated from @assert ("email") == "メールアドレスの形式が正しくありません。".
     *
     * @covers validation::checkValidRegEmailAddress
     */
    public function testCheckValidRegEmailAddress3() {
      $this->assertEquals("メールアドレスの形式が正しくありません。", $this->object->checkValidRegEmailAddress("email"));
    }

    /**
     * Generated from @assert ("a@a.com") == "メールアドレスの形式が正しくありません。".
     *
     * @covers validation::checkValidRegEmailAddress
     */
    public function testCheckValidRegEmailAddress4() {
      $this->assertEquals("メールアドレスの形式が正しくありません。", $this->object->checkValidRegEmailAddress("a@a.com"));
    }

    /**
     * Generated from @assert ("abc@gotandadenshi.jp") == "このメールアドレスは登録済みです。".
     *
     * @covers validation::checkValidRegEmailAddress
     */
    public function testCheckValidRegEmailAddress5() {
      $this->assertEquals("このメールアドレスは登録済みです。", $this->object->checkValidRegEmailAddress("abc@gotandadenshi.jp"));
    }

    /**
     * Generated from @assert ("abc@abc.it") == "success".
     *
     * @covers validation::checkValidRegEmailAddress
     */
    public function testCheckValidRegEmailAddress6() {
      $this->assertEquals("success", $this->object->checkValidRegEmailAddress("abc@abc.it"));
    }

    /**
     * Generated from @assert ("") == "必須です。".
     *
     * @covers validation::checkValidRegPassword
     */
    public function testCheckValidRegPassword() {
      $this->assertEquals("必須です。", $this->object->checkValidRegPassword(""));
    }

    /**
     * Generated from @assert ("abc") == "6文字以上で入力してください。".
     *
     * @covers validation::checkValidRegPassword
     */
    public function testCheckValidRegPassword2() {
      $this->assertEquals("6文字以上で入力してください。", $this->object->checkValidRegPassword("abc"));
    }

    /**
     * Generated from @assert ("12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901") == "100文字以下で入力してください。".
     *
     * @covers validation::checkValidRegPassword
     */
    public function testCheckValidRegPassword3() {
      $this->assertEquals("100文字以下で入力してください。", $this->object->checkValidRegPassword("12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901"));
    }

    /**
     * Generated from @assert ("testing") == "success".
     *
     * @covers validation::checkValidRegPassword
     */
    public function testCheckValidRegPassword4() {
      $this->assertEquals("success", $this->object->checkValidRegPassword("testing"));
    }

    /**
     * Generated from @assert ("") == "必須です。".
     *
     * @covers validation::checkValidRegConfirmPassword
     */
    public function testCheckValidRegConfirmPassword() {
      $this->assertEquals("必須です。", $this->object->checkValidRegConfirmPassword(""));
    }

    /**
     * Generated from @assert ("testing") == "success".
     *
     * @covers validation::checkValidRegConfirmPassword
     */
    public function testCheckValidRegConfirmPassword2() {
      $result = $this->object->checkValidRegPassword("testing");
      $this->assertEquals("success", $this->object->checkValidRegConfirmPassword("testing"));
    }

    /**
     * Generated from @assert ("") == "規約に同意してください。".
     *
     * @covers validation::checkValidRegTermAgree
     */
    public function testCheckValidRegTermAgree() {
      $this->assertEquals( "規約に同意してください。", $this->object->checkValidRegTermAgree(""));
    }

    /**
     * Generated from @assert ("Yes") == "success".
     *
     * @covers validation::checkValidRegTermAgree
     */
    public function testCheckValidRegTermAgree2() {
      $this->assertEquals("success", $this->object->checkValidRegTermAgree("Yes"));
    }
  }
?>