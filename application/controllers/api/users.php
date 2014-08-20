<?php
require_once APPPATH.'libraries/REST_Controller.php';

class Users extends REST_Controller{

    public function list_get(){
        $users = new User();
        $users->get();

        if($users->count() > 0){
            $user_array = array();
            foreach($users as $user){
                array_push($user_array, $user->to_array());
            }
            $this->response($user_array, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('message' => 'Notice: No users found.'), 404);
        }
    }

    public function show_get(){
        if(!$this->get('id')){
            $this->response(array('message' => 'Notice: ID of resource is required.'), 400);
        }

        $user = new User();
        $user->get_where(array('id' => $this->get('id')));

        if($user->exists()){
            $this->response($user->to_array(), 200); // 200 being the HTTP response code
        }else{
            $this->response(array('message' => 'Error: User with id '.$this->get('id').' not found.'), 404);
        }
    }

    //Adding user through $_POST data
    public function add_post(){
        if($_POST['name'] == '' && $_POST['email'] == '' && $_POST['username'] == '' && $_POST['password'] == '' && $_POST['confirm_password'] == ''){
            $this->response(array('message' => 'Notice: Missing fields.'), 400);
        }

        $user = new User();
        $success = $user->from_array($_POST, array('name','email','username','password','confirm_password'), TRUE);
        if($success){
            $this->response(array("message" => "Success: User added."), 200); // 200 being the HTTP response code
        }else{
            $this->response(array("message" => "Error: User not added."), 404);
        }
    }

    //Update user through $_POST data
    public function update_post(){
        if(!$this->get('id')){
            $this->response(array('message' => 'Notice: ID of resource is required.'), 400);
        }

        if($_POST['name'] == '' && $_POST['email'] == '' && $_POST['username'] == '' && $_POST['password'] == ''){
            $this->response(array('message' => 'Notice: Missing fields.'), 400);
        }

        $user = new User();
        $user->get_where(array('id' => $this->get('id')));
        $bugs = new Bug();
        $bugs->get_where(array('user_id' => $this->get('id')));
        $rel['bug'] = $bugs;

        $user->from_array($_POST, array('name','email','username','password'));
        $success = $user->save($rel);
        if($success){
            $this->response(array("message" => "Success: User updated."), 200); // 200 being the HTTP response code
        }else{
            $this->response(array("message" => "Error: User not updated."), 404);
        }
    }

    public function delete_delete(){
        if(!$this->get('id')){
            $this->response(array('message' => 'Notice: ID of resource is required.'), 400);
        }

        $user = new User();
        $user->get_where(array('id' => $this->get('id')));

        if($user->delete() === TRUE){
            $this->response(array('message' => 'Success: User deleted.'), 200); // 200 being the HTTP response code
        }else{
            $this->response(array('message' => 'Error: User not deleted.'), 404);
        }
    }

    //Add User using JSON
    public function addjson_post(){
        $json_string = file_get_contents('php://input');
        $user_array = json_decode($json_string, true);

        if($user_array['name'] == '' && $user_array['email'] == '' && $user_array['username'] == '' && $user_array['password'] == '' && $user_array['confirm_password'] == ''){
            $this->response(array('message' => 'Notice: Missing fields.'), 400);
        }

        $user = new User();
        $success = $user->from_array($user_array, array('name','email','username','password','confirm_password'), TRUE);
        if($success){
            $this->response(array("message" => "Success: User added."), 200); // 200 being the HTTP response code
        }else{
            $this->response(array("message" => "Error: User not added."), 404);
        }
    }

    //Update User using JSON
    public function updatejson_post(){
        if(!$this->get('id')){
            $this->response(array('message' => 'Notice: ID of resource is required.'), 400);
        }

        $json_string = file_get_contents('php://input');
        $user_array = json_decode($json_string, true);

        if($user_array['name'] == '' && $user_array['email'] == '' && $user_array['username'] == '' && $user_array['password'] == '' && $user_array['confirm_password'] == ''){
            $this->response(array('message' => 'Notice: Missing fields.'), 400);
        }

        $user = new User();
        $user->get_where(array('id' => $this->get('id')));
        $bugs = new Bug();
        $bugs->get_where(array('user_id' => $this->get('id')));
        $rel['bug'] = $bugs;

        $user->from_array($user_array, array('name','email','username','password','confirm_password'));
        $success = $user->save($rel);
        if($success){
            $this->response(array("message" => "Success: User updated."), 200); // 200 being the HTTP response code
        }else{
            $this->response(array("message" => "Error: User not updated."), 404);
        }
    }

}