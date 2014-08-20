<?php

class Bug extends DataMapper{

    public $model = 'bug';
    public $table = 'bugs';

    public $has_one = array('user','status');

    public $validation = array(
        'title' => array(
            'rules' => array('required', 'trim', 'max_length' => 100),
            'label' => 'Title'
        ),
        'description' => array(
            'rules' => array('required', 'xss_clean'),
            'label' => 'Description',
            'type' => 'textarea'
        ),
        'user' => array(
            'rules' => array('required'),
            'label' => 'User',
        ),
        'status' => array(
            'rules' => array('required'),
            'label' => 'Status',
        )
    );

    public $default_order_by = array('title');

}