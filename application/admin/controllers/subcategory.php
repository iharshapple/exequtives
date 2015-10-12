<?php

class Subcategory extends CI_Controller {
    
    public $controller = 'subcategory';
    public $title = 'Subcategory Management';
    public $add_view = 'subcategory_add_view';
    public $list_view = 'subcategory_view';
    public $uppercase = 'Subcategory'; 
    public $list_title = 'Subcategory List'; 
    public $primary_key = 'iSubcategoryID'; 
    public $table = 'tbl_subcategory'; 
    
    function __construct() {
        parent::__construct();
        //$this->load->library('Datatables.php');
        $this->load->library('DatatablesHelper');
        $this->load->model('subcategory_model');
        $this->load->helper('string');
        $this->load->library('image_oxl');

    }

    // INDEX
    function index($iSubcategoryID = "") {

        $getRecords = $this->subcategory_model->getDataAll($iSubcategoryID);
      
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
            $changeStatus = $this->subcategory_model->changeStatus($_POST['id']);
            echo "1";
            
        }
    }



    // ***************************************************************
    // REMOVE
    // ***************************************************************
    function remove($iSubcategoryID = '', $rm = '') {
        if ($iSubcategoryID != '' && $rm != '' && $rm == 'y') {
            $remove = $this->subcategory_model->remove($iSubcategoryID);
            if ($remove != '') {
                $succ = array('0' => SUBCATEGORY_DELETED);
                $this->session->set_userdata('SUCCESS', $succ);
            } else {
                $err = array('0' => SUBCATEGORY_NOT_DELETED);
                $this->session->set_userdata('ERROR', $err);
            }
        }

        redirect($this->controller, 'refresh');
    }

    // ***************************************************************
    // ADD
    // ***************************************************************
    function add($iSubcategoryID = '') {
        
        $viewData['title'] = $this->title;
        $viewData['ACTION_LABEL'] = ( isset($iSubcategoryID) && $iSubcategoryID != '' ) ? 'Edit' :  'Add';
        $viewData['options'] = $this->subcategory_model->getDropDown();
        if ($iSubcategoryID != '') {
            $getData = $this->subcategory_model->getDataById($iSubcategoryID);
            $viewData['getData'] = $getData;
        }

        if ($this->input->post('action') && $this->input->post('action') == 'backoffice.add') {
          // mprd($_POST);
            if ($this->subcategory_model->checkAvailable($this->input->post('vTitle'))) {
               
                $Add = $this->subcategory_model->add($_POST);
                $vImage = "";
//                if (isset($_FILES['vImage']) && $_FILES['vImage']['name'] != "") { ######### Upload IMage#####
//                    $vImage = $this->image_oxl->uploadimage('../images/categoryImage/'.$Add, 'vImage',100);
//                }
                if ($Add != '') {
                   // $query = $this->db->update($this->table, array('vImage'=>$vImage), array($this->primary_key => $Add));
                    $succ = array('0' => SUBCATEGORY_ADDED);
                    $this->session->set_userdata('SUCCESS', $succ);
                } else {
                    $err = array('0' => SUBCATEGORY_NOT_ADDED);
                    $this->session->set_userdata('ERROR', $err);
                }
                // }
                // else {
                // 	$err = array( '0' => CATEORY_USERNAME_EXISTS );
                // 	$this->session->set_userdata( 'ERROR', $err );
                // }
            } else {
                $err = array('0' =>CATEORY_EXISTS );
                $this->session->set_userdata('ERROR', $err);
            }
            redirect($this->controller);
        } else if ($this->input->post('action') && $this->input->post('action') == 'backoffice.edit') {
            $iSubcategoryID = $this->input->post('iSubcategoryID');
                $Edit = $this->subcategory_model->edit($_POST);
//                if (isset($_FILES['vImage']) && $_FILES['vImage']['name'] != "") { ######### Upload IMage#####
//                    $img = $this->image_oxl->uploadimage('../images/categoryImage/'.$iSubcategoryID, 'vImage', 100);
//                    $query = $this->db->update($this->table, array('vImage'=>$img), array($this->primary_key => $iSubcategoryID));
//                }
                $succ = array('0' => SUBCATEGORY_EDITED);
                $this->session->set_userdata('SUCCESS', $succ);
                 
                
            
            redirect($this->controller);
        }

        $this->load->view($this->controller.'/'.$this->add_view, $viewData);
    }

    // ***************************************************************
    function deleteAll() {
        $remove = $this->subcategory_model->remove($_POST['rows']);
        if ($remove != '') {
            echo '1';
        } else {
            echo '0';
        }
    }

    function paginate()
    {
        
        $data=$this->datatableshelper->query("SELECT 
                                               iSubcategoryID,
                                               sc.vTitle as vTitle,
                                               c.vTitle as iCategoryID,
                                               sc.dtCreated as dtCreated,
                                               sc.iStatus as iStatus, 
                                               iSubcategoryID AS DT_RowId 
                                               FROM $this->table sc
                                               INNER JOIN tbl_category c ON c.iCategoryID = sc.iCategoryID
                                               
                                               
           ");
        echo json_encode($data);
    }
    
}
