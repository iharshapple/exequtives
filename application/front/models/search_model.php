<?php

class Search_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->now = date('Y-m-d H:i:s');
    }

    //************************************************************
    //Error Or success Msg View
    //************************************************************
    function getAllCategories() {
        $result = $this->db->get('tbl_category');
        if ($result->num_rows() > 0)
            return $result->result_array();
        else
            return '';
    }

    function checkEmailAvailable($email) {
        $result = $this->db->get_where('tbl_user', array('vEmail' => $email));
        if ($result->num_rows() >= 1)
            return 0;
        else
            return 1;
    }
    
    function addUser($postData){
        $postData['dtCreated'] = $this->now;
        $postData['iStatus'] = 1;
        $postData['user_type'] = 1;
        $postData['vPassword'] = md5($postData['vPassword']);
        $query = $this->db->insert('tbl_user', $postData);
        if ($this->db->affected_rows() > 0) 
            return $this->db->insert_id();
        else
            return '';
    }
    
     function getCatDropDown() {
        $qry = $this->db->select('iCategoryID, vTitle')->get_where('tbl_category');
        $ret = array();
        $ret[''] = 'Select category';
        if ($qry->num_rows()) {
            $res = $qry->result_array();
            foreach ($res as $value) {
                $ret[$value['iCategoryID']] = $value['vTitle'];
            }
            return $ret;
        }else{
            return array(
                ''=>'Select category'
            );
        }
    }
     function getSubCatDropDown() {
        $iCategoryID = $this->input->post('c');
        
        $qry = $this->db->select('iSubcategoryID, vTitle')->get_where('tbl_subcategory', array('iCategoryID'=>$iCategoryID));
        $ret = '<option>Subcategory Select</option>';
        if ($qry->num_rows()) {
            $res = $qry->result_array();
            foreach ($res as $value) {
                $ret.='<option value="'.$value["iSubcategoryID"].'">'.$value["vTitle"].'</option>';
            }
            return $ret;
        }else{
            return '';
        }
    }

}
