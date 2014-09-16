<?php

class UserTest extends CIUnit_TestCase{

    private $user;

    public function __construct($name = NULL, array $data = array(), $dataName = ''){
        parent::__construct($name, $data, $dataName);
        $this->user = new User();
    }

    public function setUp(){
        parent::setUp();
        $data = array(
            'name' => 'Daniel Sebuuma',
            'email' => 'sedzsoft@gmail.com',
            'username' => 'admin',
            'password' => 'admin',
            'confirm_password' => 'admin');

        foreach($data as $field => $value){
            $this->user->$field = $value;
        }
    }

    public function testReturnsCorrectName(){
        $this->assertEquals("Daniel Sebuuma", $this->user->name);
    }

    public function testReturnsCorrectEmailAddress(){
        $this->assertEquals("sedzsoft@gmail.com", $this->user->email);
    }

    public function tearDown(){
        parent::tearDown();
    }

}