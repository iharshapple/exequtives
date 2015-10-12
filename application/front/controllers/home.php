<?php

class home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('home_model');
    }

    function index() {
        $getRecords = $this->home_model->getAllCategories();
        if ($getRecords != '')
            $viewData['record_set'] = $getRecords;
        else
            $viewData['record_set'] = array();
        $this->load->view('home/home_view', $viewData);
    }

    function signup() {
        if ($this->home_model->checkEmailAvailable($this->input->post('vEmail'))) {
            $add = $this->home_model->addUser($_POST);
            if ($add != '') {
                $this->set_session($add);
                redirect('profile');
            } else {
                $err = array('0' => 'There is some problem adding user.');
                $this->session->set_userdata('ERROR', $err);
            }
        } else {
            $err = array('0' => 'User with this email already exists.');
            $this->session->set_userdata('ERROR', $err);
        }
        redirect('home', 'refresh');
    }

    function login() {
        $vEmail = $this->input->post('vEmail', TRUE);
        $vPassword = $this->input->post('vPassword', TRUE);
        $array = array('vEmail' => $vEmail, 'vPassword' => md5($vPassword));
        // Query
        $query = $this->db->get_where('tbl_user', $array);
        if ($query->num_rows == 1) {
            $row = $query->row();
            $userdata = array(
                'IS_LOGGED_IN' => TRUE,
                'USERID' => $row->iUserID,
                'FIRST_NAME' => $row->vFirstname,
                'LAST_NAME' => $row->vLastname,
                'EMAIL' => $row->vEmail
            );
        // STORE SESSION
            $this->session->set_userdata($userdata);
            redirect('profile');
        } else {
            //SET ERROR 
            $ers = array(
                '0' => 'Invalid credentials',
            );

            $this->session->set_userdata('ERROR', $ers);
            redirect('home', 'refresh');
           
        }
    }
    function getsubcat(){
        echo $this->home_model->getSubCatDropDown();
    }

    function set_session($add) {
        $query = $this->db->get_where('tbl_user', array('iUserID' => $add));
        $row = $query->row();
        $userdata = array(
            'IS_LOGGED_IN' => TRUE,
            'USERID' => $row->iUserID,
            'FIRST_NAME' => $row->vFirstname,
            'LAST_NAME' => $row->vLastname,
            'EMAIL' => $row->vEmail
        );
        // STORE SESSION
        $this->session->set_userdata($userdata);
    }

}

/*
| -------------------------------------------------------------------
|  END OF CLASS FILE
| -------------------------------------------------------------------
*/
