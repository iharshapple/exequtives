<?php

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
    }

    function index() {
       
        $this->load->view('profile/index');
    }

    

}

/*
| -------------------------------------------------------------------
|  END OF CLASS FILE
| -------------------------------------------------------------------
*/