<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migrate extends CI_Controller{

    public function index() {
        if (ENVIRONMENT == 'development') {
            if ( ! $this->migration->current()) {
                show_error($this->migration->error_string());
            } else {
                echo "SUCCESS: Tables successfully migrated.";
            }
        } else {
            echo "NOTICE: This is a non development version. Change environment to development.";
        }
        echo PHP_EOL;
    }

    public function latest_migration(){
        if (ENVIRONMENT == 'development') {
            if ( ! $this->migration->latest()) {
                show_error($this->migration->error_string());
            } else {
                echo "SUCCESS: Latest migration completed.";
            }
        } else {
            echo "NOTICE: This is a non development version. Change environment to development.";
        }
        echo PHP_EOL;
    }

    public function previous_migration($_version = NULL){
        if($_version == NULL){
            echo "ERROR: Must provide version number to revert to.";
            echo PHP_EOL;
            return null;
        }

        if (ENVIRONMENT == 'development') {
            if ( ! $this->migration->version($_version)) {
                show_error($this->migration->error_string());
            } else {
                echo "SUCCESS: Previous migration complete: Version #".$_version;
            }
        } else {
            echo "NOTICE: This is a non development version. Change environment to development.";
        }
        echo PHP_EOL;
    }

}