<?php

class Menu extends CI_Controller {
    
    public $controller = 'menu';
    public $title = 'Menu Management';
    public $add_view = 'menu_add_view';
    public $list_view = 'menu_view';
    public $uppercase = 'Menu'; 
    public $list_title = 'Menu List'; 
    public $primary_key = 'iMenuID'; 
    public $table = 'tbl_menu'; 
    
    function __construct() {
        parent::__construct();
        //$this->load->library('Datatables.php');
        $this->load->library('DatatablesHelper');
        $this->load->model('menu_model');
        $this->load->helper('string');
    }

    // INDEX
    function index($iMenuID = "") {
        $getRecords = $this->menu_model->getDataAll($iMenuID);
        $viewData = array(
            "title" => $this->title,
                );
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
            $changeStatus = $this->menu_model->changeStatus($_POST['id']);
            echo "1";
        }
    }



    // ***************************************************************
    // REMOVE
    // ***************************************************************
    function remove($iMenuID = '', $rm = '') {
        if ($iMenuID != '' && $rm != '' && $rm == 'y') {
            $remove = $this->menu_model->remove($iMenuID);
            if ($remove != '') {
                $succ = array('0' => MENU_DELETED);
                $this->session->set_userdata('SUCCESS', $succ);
            } else {
                $err = array('0' => MENU_NOT_DELETED);
                $this->session->set_userdata('ERROR', $err);
            }
        }

        redirect($this->controller, 'refresh');
    }

    // ***************************************************************
    // ADD
    // ***************************************************************
    function add($iMenuID = '') {
        
        $viewData['title'] = $this->title;
        $viewData['ACTION_LABEL'] = ( isset($iMenuID) && $iMenuID != '' ) ? 'Edit' :  'Add';
        $viewData['options_menu']=$this->menu_model->getMenuDropDown();
        if ($iMenuID != '') {
            $getData = $this->menu_model->getDataById($iMenuID);
            $viewData['getData'] = $getData;
        }

        if ($this->input->post('action') && $this->input->post('action') == 'backoffice.add') {
          // mprd($_POST);
            if ($this->menu_model->checkAvailable($this->input->post('vTitle'))) {
               
                $Add = $this->menu_model->add($_POST);
                
                if ($Add != '') {
                    
                    $succ = array('0' => MENU_ADDED);
                    $this->session->set_userdata('SUCCESS', $succ);
                } else {
                    $err = array('0' => MENU_NOT_ADDED);
                    $this->session->set_userdata('ERROR', $err);
                }
            } else {
                $err = array('0' =>CATEORY_EXISTS );
                $this->session->set_userdata('ERROR', $err);
            }
            redirect($this->controller);
        } else if ($this->input->post('action') && $this->input->post('action') == 'backoffice.edit') {
            $iMenuID = $this->input->post('iMenuID');
            $Edit = $this->menu_model->edit($_POST);
            $succ = array('0' => MENU_EDITED);
            $this->session->set_userdata('SUCCESS', $succ);
            redirect($this->controller);
        }

        $this->load->view($this->controller.'/'.$this->add_view, $viewData);
    }

    // ***************************************************************
    function deleteAll() {
        $remove = $this->menu_model->remove($_POST['rows']);
        if ($remove != '') {
            echo '1';
        } else {
            echo '0';
        }
    }

    function paginate()
    {
        
        $data=$this->datatableshelper->query("SELECT 
                                               m1.vTitle as vTitle,
                                               IFNULL(m2.vTitle , 'Top Parent') as parent_id,
                                               m1.dtCreated as dtCreated,
                                               m1.iStatus as iStatus, 
                                               m1.iMenuID as iMenuID,
                                               m1.iMenuID AS DT_RowId 
                                               FROM $this->table m1
                                               LEFT JOIN $this->table m2 ON m2.iMenuID= m1.parent_id
           ");
        echo json_encode($data);
    }
    
}
