<?php

class search extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('search_model');
        $this->load->model('home_model');
    }

    function index() {
        $viewData = array();
        $this->load->view('search/index_view', $viewData);
    }
    
    function grid() {
        $viewData = array();
        $this->load->view('search/grid_view', $viewData);
    }

    

}

/*
| -------------------------------------------------------------------
|  END OF CLASS FILE
| -------------------------------------------------------------------
*/
