<?php

class Adplan_model extends CI_Model {

    public $table;
    public $now;
    function __construct() {
        parent::__construct();
        $this->table = 'tbl_ad_plans';
        $this->load->library('DatatablesHelper');
        $this->now = date('Y-m-d H:i:s');
    }

    // **********************************************************************
    // Display List of User
    // **********************************************************************
    function getDataAll($iPlanID = '') {
       
        $result = $this->db->get($this->table);
        if ($result->num_rows() > 0)
            return $result->result_array();
        else
            return '';
    }
   
    /*     * **********************************************************************
      User Setting(Getting user details by admin_id(Selected or inserted)
     * ********************************************************************** */

    function getDataById($iPlanID) {
        $result = $this->db->get_where($this->table, array('iPlanID' => $iPlanID));
        if ($result->num_rows() > 0)
            return $result->row_array();
        else
            return '';
    }

    function getDropDown() {
        $qry = $this->db->select('iCategoryID, vTitle')->get_where('tbl_category');
        if ($qry->num_rows()) {
            $res = $qry->result_array();
            foreach ($res as $value) {
                $ret[$value['iCategoryID']] = $value['vTitle'];
            }
            return $ret;
        }else{
            return array(
                ''=>'select'
            );
        }
    }

    // **********************************************************************
    // User Status
    // **********************************************************************
    function changeStatus($iPlanID) {
        //$updateData = array('admin_status' => 'IF (admin_status = "Active", "Inactive","Active")');
        //$query = $this->db->update($this->admin_tbl,$updateData, array('admin_role ' => $admin_role));
        $query = $this->db->query("UPDATE $this->table SET iStatus = IF (iStatus = '1', '0','1') WHERE iPlanID = $iPlanID");
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    // **********************************************************************
    // remove admin
    // **********************************************************************
    function remove($iPlanID) {
        $adid = implode(',', $iPlanID);
        $query = $this->db->query("DELETE from $this->table WHERE iPlanID in ($adid) ");
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    // **********************************************************************
    // add admin
    // **********************************************************************
    function add($postData) {
        unset($postData['action']); 
        $postData['dtCreated'] = $this->now;
        $postData['iStatus'] = 1;
        
        $query = $this->db->insert($this->table, $postData);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return '';
    }

    // **********************************************************************
    // Edit admin
    // **********************************************************************
    function edit($postData) {
        
        unset($postData['action']);
       
       
       
//        if (isset($vImage) && $vImage != "") {
//            $this->db->select('vImage');
//            $this->db->where('iPlanID', $iPlanID);
//            $result = $this->db->get($this->table);
//            if ($result->num_rows() > 0) {
//                $result = $result->row_array();
//                $result = $result['vImage'];
//            }
//            $data['vImage'] = $vImage;
//            
//        }
        $query = $this->db->update($this->table,$postData , array('iPlanID' => $postData['iPlanID']));

        
 
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    ############################################################
    #Check EMail#
############################################################

    public function checkAvailable($vTitle, $iPlanID = '') {
        if ($iPlanID != "") {
            // $result = $this->db->query("SELECT `iPlanID`  FROM `tbl_user` WHERE (`vTitle` = '".$vTitle."'  OR  `vUsername` =  '".$vTitle."' ) AND  `iPlanID` != $iPlanID");
            $result = $this->db->query("SELECT `iPlanID`  FROM $this->table WHERE `vTitle` = '" . $vTitle . "'   AND  `iPlanID` != $iPlanID");
        } else {
            $this->db->where('vTitle', $vTitle);
            //$this->db->or_where('vUsername', $vEmail);	
            $result = $this->db->get($this->table);
        }

        if ($result->num_rows() >= 1)
            return 0;
        else
            return 1;
    }

    public function unlinkprofileimages($vImage) {
        unlink('../images/userimages/' . $vImage);
        unlink('../images/userimages/thumb/' . $vImage);
    }

    function get_paginationresult($iPlanID) { 

        $data = $this->datatableshelper->query("SELECT iPlanID,vTitle,vImage WHERE iPlanID =$iPlanID ");
       // mprd($this->db->last_query());
        return $data;
    }

   
    public function getalldatabyid($iPlanID)
    {
        $data=$this->db->query("SELECT *,tbl_subject.iPlanID as iPlanID,tbl_subject.vImage as vImage FROM tbl_subject LEFT JOIN tbl_user ON  tbl_user.iPlanID=tbl_subject.iPlanID  WHERE  tbl_subject.iPlanID=$iPlanID");
        return $data->row_array();
    }
}

?>
