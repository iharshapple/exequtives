<?php

class Category extends CI_Controller {
    
    public $controller = 'category';
    public $title = 'Category Management';
    public $add_view = 'category_add_view';
    public $list_view = 'category_view';
    public $uppercase = 'Category'; 
    public $list_title = 'Category List'; 
    public $primary_key = 'iCategoryID'; 
    public $table = 'tbl_category'; 
    
    function __construct() {
        parent::__construct();
        //$this->load->library('Datatables.php');
        $this->load->library('DatatablesHelper');
        $this->load->model('category_model');
        $this->load->helper('string');
        $this->load->library('image_oxl');

    }

    // INDEX
    function index($iCategoryID = "") {

        $getRecords = $this->category_model->getDataAll($iCategoryID);
      
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
            $changeStatus = $this->category_model->changeStatus($_POST['id']);
            echo "1";
            
        }
    }



    // ***************************************************************
    // REMOVE
    // ***************************************************************
    function remove($iCategoryID = '', $rm = '') {
        if ($iCategoryID != '' && $rm != '' && $rm == 'y') {
            $remove = $this->category_model->remove($iCategoryID);
            if ($remove != '') {
                $succ = array('0' => CATEGORY_DELETED);
                $this->session->set_userdata('SUCCESS', $succ);
            } else {
                $err = array('0' => CATEGORY_NOT_DELETED);
                $this->session->set_userdata('ERROR', $err);
            }
        }

        redirect($this->controller, 'refresh');
    }

    // ***************************************************************
    // ADD
    // ***************************************************************
    function add($iCategoryID = '') {
        
        $viewData['title'] = $this->title;
        $viewData['ACTION_LABEL'] = ( isset($iCategoryID) && $iCategoryID != '' ) ? 'Edit' :  'Add';

        if ($iCategoryID != '') {
            $getData = $this->category_model->getDataById($iCategoryID);
            $viewData['getData'] = $getData;
        }

        if ($this->input->post('action') && $this->input->post('action') == 'backoffice.add') {
          // mprd($_POST);
            if ($this->category_model->checkCategoryAvailable($this->input->post('vTitle'))) {
               
                $Add = $this->category_model->add($_POST);
                $vImage = "";
                if (isset($_FILES['vImage']) && $_FILES['vImage']['name'] != "") { ######### Upload IMage#####
                    $vImage = $this->image_oxl->uploadimage('../images/categoryImage/'.$Add, 'vImage',100);
                }
                if (isset($_FILES['vImage2']) && $_FILES['vImage2']['name'] != "") { ######### Upload IMage#####
                    $vImage2 = $this->image_oxl->uploadimage('../images/categoryImage/'.$Add, 'vImage2',100);
                }
                if ($Add != '') {
                    $query = $this->db->update($this->table, array('vImage'=>$vImage,'vImage2'=>$vImage2), array($this->primary_key => $Add));
                    $succ = array('0' => CATEGORY_ADDED);
                    $this->session->set_userdata('SUCCESS', $succ);
                } else {
                    $err = array('0' => CATEGORY_NOT_ADDED);
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
            $iCategoryID = $this->input->post('iCategoryID');
                $Edit = $this->category_model->edit($_POST);
                if (isset($_FILES['vImage']) && $_FILES['vImage']['name'] != "") { ######### Upload IMage#####
                    $img = $this->image_oxl->uploadimage('../images/categoryImage/'.$iCategoryID, 'vImage', 100);
                    $query = $this->db->update($this->table, array('vImage'=>$img), array($this->primary_key => $iCategoryID));
                }
                if (isset($_FILES['vImage2']) && $_FILES['vImage2']['name'] != "") { ######### Upload IMage#####
                    $img = $this->image_oxl->uploadimage('../images/categoryImage/'.$iCategoryID, 'vImage2', 100);
                    $query = $this->db->update($this->table, array('vImage2'=>$img), array($this->primary_key => $iCategoryID));
                }
                $succ = array('0' => CATEGORY_EDITED);
                $this->session->set_userdata('SUCCESS', $succ);
                 
                
            
            redirect($this->controller);
        }

        $this->load->view($this->controller.'/'.$this->add_view, $viewData);
    }

    // ***************************************************************
    function deleteAll() {
        $remove = $this->category_model->remove($_POST['rows']);
        if ($remove != '') {
            echo '1';
        } else {
            echo '0';
        }
    }

    function paginate()
    {
        
        $data=$this->datatableshelper->query("SELECT 
                                               iCategoryID,
                                               vTitle,
                                               vImage,
                                               vImage2,
                                               dtCreated,
                                               iStatus, 
                                               iCategoryID AS DT_RowId 
                                               FROM tbl_category
           ");
        echo json_encode($data);
    }
    
}
