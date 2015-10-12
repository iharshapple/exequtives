<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    var $tbl_user;

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->table = "tbl_user";
    }

    /**
     * [Insert_tbl_user_all description]
     * @param string $vFirstname [First name]
     */
    function checkEmailAvailable($vEmail) {
        $query = $this->db->get_where($this->table, array('vEmail' => $vEmail));
        if ($query->num_rows() > 0)
            return 1;
        else
            return 0;
    }

    /*function checkEmailAvailable($vEmail) {
        $query = $this->db->get_where($this->table, array('vEmail' => $vEmail));
        if ($query->num_rows() > 0)
            return 1;
        else
            return 0;
    }*/

    function updateToken($postData) {
        extract($postData);
        $updateData = array(
            'ePlatform' => $ePlatform,
            'vDeviceToken' => $vDeviceToken
        );
        $this->db->update($this->table, $updateData, $where);
    }

     function updateNewPassword($vEmail, $new_password){
        $query = $this->db->where(array('vEmail' => $vEmail ));
        $query = $this->db->update($this->table,array('vPassword'=>$new_password));

        if($this->db->affected_rows()>0)
            return 1;
        else
            return 0;
        
    }
    
    function getName($iUserID){
        return $query = $this->db->get_where($this->table, array('iUserID' => $iUserID))->row()->vUserName;
    }

    function getEmail($iUserID){
        return $query = $this->db->get_where($this->table, array('iUserID' => $iUserID))->row()->vEmail;
    }

    function getVicinity($iUserID){
        return $query = $this->db->get_where($this->table, array('iUserID' => $iUserID))->row()->iVicinity;
    }

    function updateUserLatLong($dLat,$dLong,$iUserID){
        $updateData = array('dLat'=>$dLat,'dLong'=>$dLong);
        $this->db->update('tbl_user', $updateData, array('iUserID' => $iUserID));
    }

    function getUserDetails($postData) {
        extract($postData);
        $this->db->select("iUserID, vEmail");
        $query = $this->db->get_where($this->table, array('vEmail' => $vEmail, 'vPassword' => md5($vPassword)));
        //mprd($this->db->last_query());
        if ($query->num_rows() > 0) {
            $res = $query->row_array();
            $updateData = array(
                'vDeviceToken' => $vDeviceToken,
                'ePlatform' => $ePlatform,
                //'vName'=>$vName
            );
            $this->db->update('tbl_user', $updateData, array('iUserID' => $res['iUserID']));
            return $res['iUserID'];
        } else {
            return '';
        }
    }

    function getvHmacFromEmail($vEmail) {
        $this->db->select("vHmac");
        return $this->db->get_where($this->table, array('vEmail' => $vEmail))->row()->vHmac;
    }

    function addUser($postData) {
        extract($postData);
        
        $postData['dtCreated'] = gmdate('Y-m-d: H:i:s');
        $postData['vPassword'] = md5($postData['vPassword']);
        $postData['vUserName'] = $vFirstName.' '.$vLastName;
        $postData['iVicinity'] = 10;
        $query = $this->db->insert($this->table, $postData);
        //mprd($this->db->last_query());
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    function getProfilePic($iUserID){
        $this->db->select("vProfilePic");
        return $this->db->get_where($this->table, array('iUserID' => $iUserID))->row()->vProfilePic;
    }

}

/* End of file admin_model.php */

/* Location: ./application/ws/models/admin_model.php */