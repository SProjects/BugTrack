<?php

class User extends DataMapper{

    public $model = 'user';
    public $table = 'users';

    public $has_many = array('bug');

    public $validation = array(
        'name' => array(
            'rules' => array('required', 'trim', 'unique', 'max_length' => 100),
            'label' => 'Name'
        ),
        'email' => array(
            'rules' => array('required', 'trim', 'unique', 'valid_email'),
            'label' => 'Email'
        ),
        'username' => array(
            'rules' => array('required', 'trim', 'unique', 'alpha_dash', 'min_length' => 3, 'max_length' => 20),
            'label' => 'Username',
        ),
        'password' => array(
            'rules' => array('required', 'trim', 'min_length' => 3, 'max_length' => 40),
            'label' => 'Password',
            'type' => 'password'
        ),
        'confirm_password' => array(
            'rules' => array('required', 'matches' => 'password', 'min_length' => 3, 'max_length' => 40),
            'label' => 'Confirm Password',
            'type' => 'password'
        )
    );

    public $default_order_by = array('name');

    public function login(){
        $username = $this->username;
        $password = $this->password;

        $user = new User();
        $user->get_where(array('username' => $username, 'password' => $password));
        if($user->exists()){
            return TRUE;
        }else{
            $this->username = $username;
            return FALSE;
        }
    }

    public function __toString(){
        return empty($this->name) ? $this->localize_label('unset') : $this->name;
    }
}