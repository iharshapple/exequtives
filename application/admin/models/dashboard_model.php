<?php
class Dashboard_model extends CI_Model {
    var $table;
    var $content;
    var $admin;
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
    }
    // ***************************************************************
    // Count Number of users
    // ***************************************************************
    function getNumberOfUsers() {
        $counterResult=$this->db->query("SELECT * FROM tbl_user");
        return $counterResult->num_rows();
    }
    // ***************************************************************
    // Count Number of users Add on Today
    // ***************************************************************
    
}
?>