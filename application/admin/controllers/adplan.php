<?php

class Adplan extends CI_Controller {
    
    public $controller = 'adplan';
    public $title = 'Ad Plan Management';
    public $add_view = 'adplan_add_view';
    public $list_view = 'adplan_view';
    public $uppercase = 'Adplan'; 
    public $list_title = 'Adplan List'; 
    public $primary_key = 'iPlanID'; 
    public $table = 'tbl_ad_plans'; 
    
    function __construct() {
        parent::__construct();
        //$this->load->library('Datatables.php');
        $this->load->library('DatatablesHelper');
        $this->load->model('adplan_model');
        $this->load->helper('string');
        $this->load->library('image_oxl');

    }

    // INDEX
    function index($iPlanID = "") {

        $getRecords = $this->adplan_model->getDataAll($iPlanID);
      
        $viewData = array("title" => $this->title);
        if ($getRecords != '')
            $viewData['record_set'] = $getRecords;
        else
            $viewData['record_set'] = '';

        $this->load->view($this->controller.'/'.$this->list_view, $viewData);
    }

    // ***************************************************************
    // STATUS
    // ***************************************************************
    function status() {
        
        if ($_POST['id'] != '') {
            $changeStatus = $this->adplan_model->changeStatus($_POST['id']);
            echo "1";
            
        }
    }


    // ***************************************************************
    // REMOVE
    // ***************************************************************
    function remove($iPlanID = '', $rm = '') {
        if ($iPlanID != '' && $rm != '' && $rm == 'y') {
            $remove = $this->adplan_model->remove($iPlanID);
            if ($remove != '') {
                $succ = array('0' => ADPLAN_DELETED);
                $this->session->set_userdata('SUCCESS', $succ);
            } else {
                $err = array('0' => ADPLAN_NOT_DELETED);
                $this->session->set_userdata('ERROR', $err);
            }
        }

        redirect($this->controller, 'refresh');
    }

    // ***************************************************************
    // ADD
    // ***************************************************************
    function add($iPlanID = '') {
        
        $viewData['title'] = $this->title;
        $viewData['ACTION_LABEL'] = ( isset($iPlanID) && $iPlanID != '' ) ? 'Edit' :  'Add';
        
        if ($iPlanID != '') {
            $getData = $this->adplan_model->getDataById($iPlanID);
            $viewData['getData'] = $getData;
        }

        if ($this->input->post('action') && $this->input->post('action') == 'backoffice.add') {
          // mprd($_POST);
            if ($this->adplan_model->checkAvailable($this->input->post('vTitle'))) {
               
                $Add = $this->adplan_model->add($_POST);
                $vImage = "";
//                if (isset($_FILES['vImage']) && $_FILES['vImage']['name'] != "") { ######### Upload IMage#####
//                    $vImage = $this->image_oxl->uploadimage('../images/categoryImage/'.$Add, 'vImage',100);
//                }
                if ($Add != '') {
                   // $query = $this->db->update($this->table, array('vImage'=>$vImage), array($this->primary_key => $Add));
                    $succ = array('0' => ADPLAN_ADDED);
                    $this->session->set_userdata('SUCCESS', $succ);
                } else {
                    $err = array('0' => ADPLAN_NOT_ADDED);
                    $this->session->set_userdata('ERROR', $err);
                }
                
            } else {
                $err = array('0' =>CATEORY_EXISTS );
                $this->session->set_userdata('ERROR', $err);
            }
            redirect($this->controller);
        } else if ($this->input->post('action') && $this->input->post('action') == 'backoffice.edit') {
            $iPlanID = $this->input->post('iPlanID');
                $Edit = $this->adplan_model->edit($_POST);

                $succ = array('0' => ADPLAN_EDITED);
                $this->session->set_userdata('SUCCESS', $succ);
                 
                
            
            redirect($this->controller);
        }

        $this->load->view($this->controller.'/'.$this->add_view, $viewData);
    }

    // ***************************************************************
    function deleteAll() {
        $remove = $this->adplan_model->remove($_POST['rows']);
        if ($remove != '') {
            echo '1';
        } else {
            echo '0';
        }
    }

    function paginate()
    {
        
        $data=$this->datatableshelper->query("SELECT 
                                               iPlanID,
                                               vTitle,
                                               iAmount,
                                               iDurationMonth,
                                               dtCreated,
                                               iStatus, 
                                               iPlanID AS DT_RowId 
                                               FROM $this->table
           ");
        echo json_encode($data);
    }
    
}
