<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('Datatables.php');
        $this->load->library('DatatablesHelper');
        $this->load->model('user_model');
        $this->load->helper('string');
        $this->controller = 'user';
        $this->uppercase = 'User';
        $this->title = 'User Management';
    }

    // INDEX
    function index()
    {
        $getRecords = $this->user_model->getUserDataAll();
        $viewData = array("title" => "User Management");
        $viewData['breadCrumbArr'] = array("user" => "User Management");
        if ($getRecords != '')
            $viewData['record_set'] = $getRecords;
        else
            $viewData['record_set'] = '';

        $this->load->view('user/user_view', $viewData);
    }

    // ***************************************************************
    // STATUS
    // ***************************************************************
    function status($iUserID = '', $rm = '') 
    {
        if ($iUserID != '' && $rm != '' && $rm == 'y') 
        {
            $changeStatus = $this->user_model->changeUserStatus($iUserID);
            
            if($changeStatus != '')
            {
              echo '1';
            }
            else
            {
              echo '0';
            }
        }
       // redirect("user", 'refresh');
    }

    // ***************************************************************
                                // Order history
    // ***************************************************************

    function get_ordered_user($iOutletID) 
    { 
        $viewData = array(
            "title" => $this->title,
            'page' => 'post',
            'outlet_id' => $iOutletID           
        );
        $this->load->view("user/user_view", $viewData);
    }
    // ***************************************************************
    // REMOVE
    // ***************************************************************
    function remove($iUserID = '', $rm = '') 
    {
        if ($iUserID != '' && $rm != '' && $rm == 'y') 
        {
            $removeUser = $this->user_model->removeUser($iUserID);
            if ($removeUser != '') 
            {
                $succ = array('0' => USER_DELETED);
                $this->session->set_userdata('SUCCESS', $succ);
            } else {
                $err = array('0' => USER_NOT_DELETED);
                $this->session->set_userdata('ERROR', $err);
            }
        }
        redirect("user", 'refresh');
    }

 // ***************************************************************
    function deleteAll() 
    {
        $data = $_POST['rows'];
      
        $removeUser = $this->user_model->removeUser($_POST['rows']);
        if($removeUser != '')
        {
            echo '1';
        }
        else
        {
            echo '0';
        }
        //redirect("user", "refresh");
    }

    function paginate()
    {
        $data=$this->user_model->get_paginationresult();
        echo json_encode($data);
    }


  /********************* End of the File ******************************/
}
