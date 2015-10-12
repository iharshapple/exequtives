<?php

class Subcategory_model extends CI_Model {

    public $table;
    public $now;
    function __construct() {
        parent::__construct();
        $this->table = 'tbl_subcategory';
        $this->load->library('DatatablesHelper');
        $this->now = date('Y-m-d H:i:s');
    }

    // **********************************************************************
    // Display List of User
    // **********************************************************************
    function getDataAll($iSubcategoryID = '') {
       
        $result = $this->db->get($this->table);
        if ($result->num_rows() > 0)
            return $result->result_array();
        else
            return '';
    }
   
    /*     * **********************************************************************
      User Setting(Getting user details by admin_id(Selected or inserted)
     * ********************************************************************** */

    function getDataById($iSubcategoryID) {
        $result = $this->db->get_where($this->table, array('iSubcategoryID' => $iSubcategoryID));
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
    function changeStatus($iSubcategoryID) {
        //$updateData = array('admin_status' => 'IF (admin_status = "Active", "Inactive","Active")');
        //$query = $this->db->update($this->admin_tbl,$updateData, array('admin_role ' => $admin_role));
        $query = $this->db->query("UPDATE $this->table SET iStatus = IF (iStatus = '1', '0','1') WHERE iSubcategoryID = $iSubcategoryID");
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    // **********************************************************************
    // remove admin
    // **********************************************************************
    function remove($iSubcategoryID) {
        $adid = implode(',', $iSubcategoryID);
        $query = $this->db->query("DELETE from $this->table WHERE iSubcategoryID in ($adid) ");
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
//            $this->db->where('iSubcategoryID', $iSubcategoryID);
//            $result = $this->db->get($this->table);
//            if ($result->num_rows() > 0) {
//                $result = $result->row_array();
//                $result = $result['vImage'];
//            }
//            $data['vImage'] = $vImage;
//            
//        }
        $query = $this->db->update($this->table,$postData , array('iSubcategoryID' => $postData['iSubcategoryID']));

        
 
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    ############################################################
    #Check EMail#
############################################################

    public function checkAvailable($vTitle, $iSubcategoryID = '') {
        if ($iSubcategoryID != "") {
            // $result = $this->db->query("SELECT `iSubcategoryID`  FROM `tbl_user` WHERE (`vTitle` = '".$vTitle."'  OR  `vUsername` =  '".$vTitle."' ) AND  `iSubcategoryID` != $iSubcategoryID");
            $result = $this->db->query("SELECT `iSubcategoryID`  FROM $this->table WHERE `vTitle` = '" . $vTitle . "'   AND  `iSubcategoryID` != $iSubcategoryID");
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

    function get_paginationresult($iSubcategoryID) { 

        $data = $this->datatableshelper->query("SELECT iSubcategoryID,vTitle,vImage WHERE iSubcategoryID =$iSubcategoryID ");
       // mprd($this->db->last_query());
        return $data;
    }

   
    public function getalldatabyid($iSubcategoryID)
    {
        $data=$this->db->query("SELECT *,tbl_subject.iSubcategoryID as iSubcategoryID,tbl_subject.vImage as vImage FROM tbl_subject LEFT JOIN tbl_user ON  tbl_user.iSubcategoryID=tbl_subject.iSubcategoryID  WHERE  tbl_subject.iSubcategoryID=$iSubcategoryID");
        return $data->row_array();
    }
}

?>
