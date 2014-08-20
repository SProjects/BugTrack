<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migration_Initial_schema extends CI_Migration{

    public function up(){
        //users
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            )
        ));
        $this->dbforge->create_table('users');

        //status
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE),
            'number' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE
            )
        ));
        $this->dbforge->create_table('statuses');

        //bugs
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE),
            'description' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'status_id' => array(
                'type' => 'INT',
                'constraint' => 9,
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 9,
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('status_id');
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('bugs');
    }

    public function down(){
        $this->dbforge->drop_table('bugs');
        $this->dbforge->drop_table('users');
    }

}