<?php

class Menu_model extends CI_Model {

    public $table;
    public $now;
    function __construct() {
        parent::__construct();
        $this->table = 'tbl_menu';
        $this->load->library('DatatablesHelper');
        $this->now = date('Y-m-d H:i:s');
    }

    // **********************************************************************
    // Display List of User
    // **********************************************************************
    function getDataAll($iMenuID = '') {
       
        $result = $this->db->get($this->table);
        if ($result->num_rows() > 0)
            return $result->result_array();
        else
            return '';
    }
   
    /*     * **********************************************************************
      User Setting(Getting user details by admin_id(Selected or inserted)
     * ********************************************************************** */

    function getDataById($iMenuID) {
        $result = $this->db->get_where($this->table, array('iMenuID' => $iMenuID));
        if ($result->num_rows() > 0)
            return $result->row_array();
        else
            return '';
    }

    function getMenuDropDown() {
        $qry = $this->db->select('iMenuID, vTitle')->get_where($this->table);
        $ret=array();
        $ret['0'] = 'Top parent';
        if ($qry->num_rows()) {
            $res = $qry->result_array();
            foreach ($res as $value) {
                $ret[$value['iMenuID']] = $value['vTitle'];
            }
            return $ret;
        }else{
            return array(
                '0'=>$ret['0']
            );
        }
    }

    // **********************************************************************
    // User Status
    // **********************************************************************
    function changeStatus($iMenuID) {
        //$updateData = array('admin_status' => 'IF (admin_status = "Active", "Inactive","Active")');
        //$query = $this->db->update($this->admin_tbl,$updateData, array('admin_role ' => $admin_role));
        $query = $this->db->query("UPDATE $this->table SET iStatus = IF (iStatus = '1', '0','1') WHERE iMenuID = $iMenuID");
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    // **********************************************************************
    // remove admin
    // **********************************************************************
    function remove($iMenuID) {
        $adid = implode(',', $iMenuID);
        $query = $this->db->query("DELETE from $this->table WHERE iMenuID in ($adid) ");
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
            $this->db->where('iMenuID', $iMenuID);
            $result = $this->db->get($this->table);
            if ($result->num_rows() > 0) {
                $result = $result->row_array();
                $result = $result['vImage'];
            }
            $data['vImage'] = $vImage;
            
        }
        $query = $this->db->update($this->table,$data , array('iMenuID' => $iMenuID));

        
 
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    ############################################################
    #Check EMail#
############################################################

    public function checkAvailable($vTitle, $iMenuID = '') {
        if ($iMenuID != "") {
            // $result = $this->db->query("SELECT `iMenuID`  FROM `tbl_user` WHERE (`vTitle` = '".$vTitle."'  OR  `vUsername` =  '".$vTitle."' ) AND  `iMenuID` != $iMenuID");
            $result = $this->db->query("SELECT `iMenuID`  FROM $this->table WHERE `vTitle` = '" . $vTitle . "'   AND  `iMenuID` != $iMenuID");
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

    function get_paginationresult($iMenuID) { 

        $data = $this->datatableshelper->query("SELECT iMenuID,vTitle,vImage WHERE iMenuID =$iMenuID ");
       // mprd($this->db->last_query());
        return $data;
    }

    function getUsernameById($iMenuID) {
        $result = $this->db->query("SELECT concat(vFirstname,' ',vLastname) AS name FROM tbl_user WHERE iMenuID=$iMenuID");
        // $result = $this->db->get_where( $this->table, array( 'iMenuID' => $iMenuID ) );
        if ($result->num_rows() > 0) {
            $result = $result->row_array();
            return $result['name'];
        } else
            return '';
    }
    public function getalldatabyid($iMenuID)
    {
        $data=$this->db->query("SELECT *,tbl_subject.iMenuID as iMenuID,tbl_subject.vImage as vImage FROM tbl_subject LEFT JOIN tbl_user ON  tbl_user.iMenuID=tbl_subject.iMenuID  WHERE  tbl_subject.iMenuID=$iMenuID");
        return $data->row_array();
    }
}

?>
