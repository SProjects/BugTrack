<?php

class Status extends DataMapper{

    public $model = 'status';
    public $table = 'statuses';

    public $has_many = array('bug');

    public $validation = array(
        'name' => array(
            'rules' => array('required', 'trim', 'unique')
        ),
        'number' => array(
            'rules' => array('required', 'integer')
        )
    );

    public $default_order_by = array('id' => 'asc');//desc

    public function __toString(){
        return empty($this->name) ? $this->localize_label('unset') : $this->name;
    }

}