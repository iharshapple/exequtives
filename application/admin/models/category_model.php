<?php

class Category_model extends CI_Model {

    public $table;
    public $now;
    function __construct() {
        parent::__construct();
        $this->table = 'tbl_category';
        $this->load->library('DatatablesHelper');
        $this->now = date('Y-m-d H:i:s');
    }

    // **********************************************************************
    // Display List of User
    // **********************************************************************
    function getDataAll($iCategoryID = '') {
       
        $result = $this->db->get($this->table);
        if ($result->num_rows() > 0)
            return $result->result_array();
        else
            return '';
    }
   
    /*     * **********************************************************************
      User Setting(Getting user details by admin_id(Selected or inserted)
     * ********************************************************************** */

    function getDataById($iCategoryID) {
        $result = $this->db->get_where($this->table, array('iCategoryID' => $iCategoryID));
        if ($result->num_rows() > 0)
            return $result->row_array();
        else
            return '';
    }

    function getOrgDropDown() {
        $qry = $this->db->select('org_id, vTitle')->get_where('tbl_organization');
        if ($qry->num_rows()) {
            $res = $qry->result_array();
            foreach ($res as $value) {
                $ret[$value['org_id']] = $value['vTitle'];
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
    function changeStatus($iCategoryID) {
        //$updateData = array('admin_status' => 'IF (admin_status = "Active", "Inactive","Active")');
        //$query = $this->db->update($this->admin_tbl,$updateData, array('admin_role ' => $admin_role));
        $query = $this->db->query("UPDATE $this->table SET iStatus = IF (iStatus = '1', '0','1') WHERE iCategoryID = $iCategoryID");
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    // **********************************************************************
    // remove admin
    // **********************************************************************
    function remove($iCategoryID) {
        $adid = implode(',', $iCategoryID);
        $query = $this->db->query("DELETE from $this->table WHERE iCategoryID in ($adid) ");
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
        
       extract($postData);
        $data = array();
        $data['vTitle'] = $vTitle;
        if (isset($vImage) && $vImage != "") {
            $this->db->select('vImage');
            $this->db->where('iCategoryID', $iCategoryID);
            $result = $this->db->get($this->table);
            if ($result->num_rows() > 0) {
                $result = $result->row_array();
                $result = $result['vImage'];
            }
            $data['vImage'] = $vImage;
            
        }
        $query = $this->db->update($this->table,$data , array('iCategoryID' => $iCategoryID));

        
 
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    ############################################################
    #Check EMail#
############################################################

    public function checkCategoryAvailable($vTitle, $iCategoryID = '') {
        if ($iCategoryID != "") {
            // $result = $this->db->query("SELECT `iCategoryID`  FROM `tbl_user` WHERE (`vTitle` = '".$vTitle."'  OR  `vUsername` =  '".$vTitle."' ) AND  `iCategoryID` != $iCategoryID");
            $result = $this->db->query("SELECT `iCategoryID`  FROM $this->table WHERE `vTitle` = '" . $vTitle . "'   AND  `iCategoryID` != $iCategoryID");
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

    function get_paginationresult($iCategoryID) { 

        $data = $this->datatableshelper->query("SELECT iCategoryID,vTitle,vImage WHERE iCategoryID =$iCategoryID ");
       // mprd($this->db->last_query());
        return $data;
    }

    function getUsernameById($iCategoryID) {
        $result = $this->db->query("SELECT concat(vFirstname,' ',vLastname) AS name FROM tbl_user WHERE iCategoryID=$iCategoryID");
        // $result = $this->db->get_where( $this->table, array( 'iCategoryID' => $iCategoryID ) );
        if ($result->num_rows() > 0) {
            $result = $result->row_array();
            return $result['name'];
        } else
            return '';
    }
    public function getalldatabyid($iCategoryID)
    {
        $data=$this->db->query("SELECT *,tbl_subject.iCategoryID as iCategoryID,tbl_subject.vImage as vImage FROM tbl_subject LEFT JOIN tbl_user ON  tbl_user.iCategoryID=tbl_subject.iCategoryID  WHERE  tbl_subject.iCategoryID=$iCategoryID");
        return $data->row_array();
    }
}

?>
