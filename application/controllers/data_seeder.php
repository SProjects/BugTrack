<?php defined("BASEPATH") or exit("No direct script access allowed");

class Data_Seeder extends CI_Controller {

    public $user;

    function __construct(){
        parent::__construct();

        // can only be called from the command line
        if (!$this->input->is_cli_request()) {
            exit('Direct access is not allowed');
        }

        // can only be run in the development environment
        if (ENVIRONMENT !== 'development') {
            exit('Wowsers! You don\'t want to do that!');
        }

        // initiate faker
        $this->faker = Faker\Factory::create();

        // load any required models
        $this->user = new User();
        $this->bug = new Bug();
        $this->status = new Status();
    }

    function seed($_limit = 10){
        $this->_truncate_db();

        $this->_seed_users($_limit);
        $this->_seed_statuses();
        $this->_seed_bugs();
    }

    function _seed_statuses(){
        echo 'Seeding statuses';
        $statuses = array(
            array('name' => 'OPEN', 'number' => '1'),
            array('name' => 'CLOSED', 'number' => '0'),
            array('name' => 'PROCESSING', 'number' => '2'),
        );

        foreach($statuses as $status){
            echo '.';
            $this->status = $this->_populate_object_with_array_data(new Status(), $status);
            $this->status->save();
        }
        echo PHP_EOL;
    }

    function _seed_bugs(){
        $status = new Status();
        $user = new User();
        echo 'Seeding bug';
        $data = array(
                'title' => 'Title of the bug',
                'description' => 'Description of the bug'
        );
        $this->bug = $this->_populate_object_with_array_data(new Bug(), $data);

        $status->where('name', 'OPEN')->get();
        $user->where('id', '1')->get();
        $rel['status'] = $status;
        $rel['user'] = $status;

        $this->bug->save($rel);
        echo PHP_EOL;
    }

    function _seed_users($limit){
        echo "seeding $limit users";
        // create a bunch of base buyer accounts
        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = array(
                'name' => $this->faker->firstName ." ". $this->faker->lastName,
                'email' => $this->faker->email,
                'username' => $this->faker->unique()->userName, // get a unique nickname
                'password' => 'awesomepassword', // run this via your password hashing function
                'confirm_password' => 'awesomepassword' // run this via your password hashing function
            );
            $this->user = $this->_populate_object_with_array_data(new User(), $data);
            $this->user->save();
        }
        echo PHP_EOL;
    }

    private function _populate_object_with_array_data($object, $data){
        foreach($data as $field => $value){
            $object->$field = $value;
        }
        return $object;
    }

    private function _truncate_db(){
        $this->bug->truncate();
        $this->status->truncate();
        $this->user->truncate();
    }

}