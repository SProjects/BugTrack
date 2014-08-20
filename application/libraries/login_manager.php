<?php

class Login_Manager {

    function __construct(){
        $this->CI =& get_instance();
        $this->session =& $this->CI->session;
    }

    function process_login(User $user){
        if($user->login()){
            $user->where(array('username' => $user->username, 'password' => $user->password))->get();
            $this->session->set_userdata(array('session_user_id' => $user->id, 'session_user_name' => $user->name));
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function get_user(){
        $user = new User();
        $user->get_by_id($this->session->userdata('session_user_id'));
        return $user;
    }

    function logout(){
        $this->session->sess_destroy();
    }

}