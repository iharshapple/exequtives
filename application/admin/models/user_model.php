<?php

class User_model extends CI_Model {

    var $table;

    function __construct() {
        parent::__construct();
        $this->table = 'tbl_user';
        $this->load->library('DatatablesHelper');
    }

    // **********************************************************************
    // Display List of User
    // **********************************************************************
    function getUserDataAll() {
        $this->db->from($this->table);
        $result = $this->db->get();
        if ($result->num_rows() > 0)
            return $result->result_array();
        else
            return '';
    }

    /************************************************************************
      User Setting(Getting user details by admin_id(Selected or inserted)
     *********************************************************************** */

    function getUserDataById($iUserID) {
        $result = $this->db->get_where($this->table, array('iUserID' => $iUserID));
        if ($result->num_rows() > 0)
            return $result->row_array();
        else
            return '';
    }

    // **********************************************************************
    // User Status
    // **********************************************************************
    function changeUserStatus($iUserID) {
        //$updateData = array('admin_status' => 'IF (admin_status = "Active", "Inactive","Active")');
        //$query = $this->db->update($this->admin_tbl,$updateData, array('admin_role ' => $admin_role));
        $query = $this->db->query("UPDATE $this->table SET eStatus = IF (eStatus = 'Active', 'Inactive','Active') WHERE iUserID = $iUserID");
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    // **********************************************************************
    // remove admin
    // **********************************************************************
    function removeUser($iUserID) { 
        $adid = implode(',', $iUserID);
        //mprd($adid);
        $query=$this->db->query("DELETE from $this->table WHERE iUserID in ($adid) ");
        //$query = $this->db->delete($this->table, array('iAdminID' => $iAdminID)); 
        //mprd($this->db->last_query());
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    // **********************************************************************
    // add admin
    // **********************************************************************
    function addUser($postData) {
        extract($postData);
        $vPassword = md5($vPassword);
        $data = array('vFirstname' => $vFirstname,
            'vLastname' => $vLastname,
            'vPhone' => $vPhone,
            'vEmail' => $vEmail,
            'vUsername' => $vUsername,
            'vCity' => $vCity,
            // 'vState' => $vState,
            // 'vCountry' => $vCountry,
            'dDob' => $dDob,
            'eGender' => $eGender,
            'eProfilestatus' => $eProfilestatus,
            'eType' => $eType,
            'eStatus' => 'Active',
            'vPassword' => $vPassword,
            'tAddedDate' => date('Y-m-d H:i:s')
        );
        if (isset($vImage) && $vImage != "") {
            $data['vImage'] = $vImage;
        }
        $query = $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return '';
    }

    // **********************************************************************
    // Edit admin
    // **********************************************************************
    function editUser($postData) {

        extract($postData);
        $data = array('vFirstname' => $vFirstname,
            'vLastname' => $vLastname,
            'vPhone' => $vPhone,
            'vUsername' => $vUsername,
            'vCity' => $vCity,
            // 'vState' => $vState,
            // 'vCountry' => $vCountry,
            'dDob' => $dDob,
            'eGender' => $eGender,
            'eProfilestatus' => $eProfilestatus,
            'eType' => $eType,
        );
        if (isset($vImage) && $vImage != "") {
            $this->db->select('vImage');
            $this->db->where('iUserID', $iUserID);
            $result = $this->db->get($this->table);
            if ($result->num_rows() > 0) {
                $result = $result->row_array();
                $result = $result['vImage'];
                if ($result != "") {
                    $this->unlinkprofileimages($result);
                }
            }
            $data['vImage'] = $vImage;
        }
        if (isset($vPassword) && $vPassword != "") {
            $data['vPassword'] = md5($vPassword);
        }

        $query = $this->db->update($this->table, $data, array('iUserID' => $iUserID));
        if ($this->db->affected_rows() > 0)
            return $query;
        else
            return '';
    }

    ############################################################
    #Check EMail#
############################################################

    public function checkAdminEmailAvailable($vEmail, $iUserID = '') {
        if ($iUserID != "") {
            $result = $this->db->query("SELECT `iUserID`  FROM `tbl_user` WHERE (`vEmail` = '" . $vEmail . "'  OR  `vUsername` =  '" . $vEmail . "' ) AND  `iUserID` != $iUserID");
        } else {
            $this->db->where('vEmail', $vEmail);
            $this->db->or_where('vUsername', $vEmail);
            $result = $this->db->get($this->table);
        }

        if ($result->num_rows() >= 1)
            return 0;
        else
            return 1;
    }

    function get_paginationresult() {
        $data = $this->datatableshelper->query("SELECT 
                                                    vUserName,
                                                    vEmail,                                                     
                                                    vProfilePic,
                                                    eGender,
                                                    vPhone,
                                                    ePlatform,                                                                                                              
                                                    eStatus,                                                     
                                                    iUserID,
                                                    iUserID AS DT_RowId
                                                    FROM tbl_user u
                                                ");        
        return $data;
    }

    function unlinkprofileimages($img) {
        unlink("../images/profilepictures/original/" . $img);
        unlink("../images/profilepictures/thumb/" . $img);
        unlink("../images/profilepictures/medium/" . $img);
    }

}

?>
