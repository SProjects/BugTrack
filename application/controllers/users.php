<?php

class Users extends CI_Controller{

    private $user;

    public function __construct(){
        parent::__construct();
        $this->user = new User();
    }

    public function index(){
        //$this->user->load_extension('htmlform');
        $form_fields = array('username','password');
        $this->load->view('template_header');
        $this->load->view('users/index', array('user' => $this->user, 'form_fields' => $form_fields, 'url' => site_url('users/login')));
        $this->load->view('template_footer');
    }

    public function login(){
        if($_POST['username'] != '' && $_POST['password'] != ''){
            $this->user->from_array($_POST, array('username', 'password'));
            if($this->login_manager->process_login($this->user) === TRUE){
                redirect('users/show');
            }else{
                $this->session->set_flashdata('message', 'Wrong username/password. Try again.');
                $this->session->set_flashdata('color_code', 'red');
                redirect('users');
            }
        }else{
            $this->session->set_flashdata('message', 'Missing username/password. Try again.');
            $this->session->set_flashdata('color_code', 'red');
            redirect('users');
        }
    }

    public function logout(){
        $this->login_manager->logout();
        redirect('users');
    }

    public function show(){
        $this->user = $this->login_manager->get_user();
        $bug = new Bug();

        $this->load->view('template_header');
        $this->load->view('users/view', array('user' => $this->user, 'bugs' => $this->user->bug->get(), 'bug' => $bug, 'url' => site_url('bugs/add')));
        $this->load->view('template_footer');
    }

    public function test($id = -1){
        $user = new User($id);
        $user->trans_start();
        $data = array(
                      'name' => 'Daniel Sebuuma',
                      'email' => 'sedzsoft@gmail.com',
                      'username' => 'admin',
                      'password' => 'admin',
                      'confirm_password' => 'admin');

        foreach($data as $field => $value){
           $user->$field = $value;
        }
        $success = $user->save();
        if($success){
            $user->trans_complete();
            $this->session->set_flashdata('message', 'The user ' . $user->name . ' was successfully created.');
            echo $this->session->flashdata('message');
        }else{
            $this->session->set_flashdata('message', 'The user ' . $user->name . ' was not created.');
            echo $this->session->flashdata('message');
        }
    }

}