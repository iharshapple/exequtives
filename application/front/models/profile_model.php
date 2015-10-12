<?php

class Profile_model extends CI_Model {

    function __construct() {
        parent::__construct();
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

}
