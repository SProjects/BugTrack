<?php

class Bugs extends CI_Controller{

    private $user_id;
    private $status;
    private $user;

    public function __construct(){
        parent::__construct();
        $this->user_id = $this->session->userdata('session_user_id');
        $this->status = new Status();
        $this->user = new User();
    }

    public function index(){
        redirect('users/show');
    }

    public function add(){
        if($_REQUEST['title'] != '' && $_REQUEST['description'] != ''){
            $bug = new Bug();
            $status = new Status();
            $user = new User();

            $bug->from_array($_POST, array('title', 'description'));
            $status->where('name', 'OPEN')->get();
            $rel['status'] = $status;
            $user->where('id', $this->user_id)->get();
            $rel['user'] = $user;

            $success = $bug->save($rel);
            if($success){
                $this->session->set_flashdata('message', 'Successfully added new bug');
                $this->session->set_flashdata('color_code', 'green');
            }else{
                $this->session->set_flashdata('message', 'Failed to add new bug');
                $this->session->set_flashdata('color_code', 'red');
            }
        }else{
            $this->session->set_flashdata('message', 'Title/Description fields have no values');
            $this->session->set_flashdata('color_code', 'blue');
        }
        redirect('users/show');
    }

    public function update($id){
        $bug = new Bug($id);
        $success = $bug->from_array($_POST, array('title', 'description', 'status', 'user'), TRUE);
        if($success){
            $this->session->set_flashdata('message', 'Bug updated.');
            $this->session->set_flashdata('color_code', 'green');
        }else{
            $this->session->set_flashdata('message', 'Could not update bug. Try again.');
            $this->session->set_flashdata('color_code', 'red');
        }
        redirect('bugs/edit/'.$id);
    }

    public function edit($id){
        $bug = new Bug($id);

        $statuses = new Status();
        $statuses->get();

        $users = new User();
        $users->get();

        $form_fields = array(
            'id',
            'title',
            'description' => array('rows'=>10, 'cols'=>30),
            'status' => array('list' => $statuses),
            'user' => array('list' => $users)
        );

        $this->load->view('template_header');
        $this->load->view('bugs/edit', array('bug' => $bug, 'form_fields' => $form_fields, 'url' => site_url('bugs/update/'.$bug->id)));
        $this->load->view('template_footer');
    }

    public function delete($id){
        $bug = new Bug($id);
        if($bug->delete()){
            $this->session->set_flashdata('message', 'Bug deleted.');
            $this->session->set_flashdata('color_code', 'green');
        }else{
            $this->session->set_flashdata('message', 'Bug was not deleted.');
            $this->session->set_flashdata('color_code', 'red');
        }
        redirect('users/show');
    }

}