<?php
class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        //$this->load->helper('string');
        $this->load->library('email');
        //$this->load->library('encrypt');
        $this->table = 'tbl_user';
    }
    
    function index() {
        //echo $_REQUEST['function'];
    }
    
    function checkAlreadyLikeThenRemove($iPostID){
        
        $this->db->select('iLikeID');
        $query = $this->db->get_where('tbl_like', array('iPostID' => $iPostID, 'iUserID' => getuserid()));
        if ($query->num_rows() > 0) {
            //mprd($query->row()->iLikeID);
            $this->db->delete('tbl_like', array('iLikeID' => $query->row()->iLikeID)); 
            return 1;
        } else {
            return 0;
        }
    } 

    function checkUserAvailableWithOldPass($vOldPassword){
        
        $insertData = array(
            'iUserID' => getuserid(),
            'vPassword' => md5($vOldPassword)
        );
        //mprd($insertData);
        $query = $this->db->get_where($this->table, $insertData);
        //mprd($query);
        //mprd($this->db->last_query());
        if ($query->num_rows() > 0) {            
            return 1;
        } else {
            return 0;
        }
    } 

    function changeUserPassword($postData) {
        extract($postData);

        $insertData = array('vPassword' => md5($vNewPassword));

        $this->db->update($this->table, $insertData,array('iUserID'=>getuserid()));

        //mprd($this->db->last_query());

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }

    }
    
    function addLike($iPostID){
        $insertData = array(
            'iUserID' => getuserid(),
            'iPostID' => $iPostID,
            'dtCreated' => gmdate('Y-m-d H:i:s')
        );
        $this->db->insert('tbl_like', $insertData);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    function addComment($postData){
        $postData['iUserID'] = getuserid();
        $postData['dtCreated'] = gmdate('Y-m-d H:i:s');
        $this->db->insert('tbl_comment', $postData);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }
        
    function checkAlreadyAdded($iAcceptorID) {
        $iRequestorID  = getuserid();
        return  $this->db->query("SELECT * FROM tbl_friend WHERE (iRequestorID = $iRequestorID AND iAcceptorID = $iAcceptorID) OR (iRequestorID = $iAcceptorID AND iAcceptorID = $iRequestorID)")->num_rows();
    }
    
    function addConnect($iAcceptorID) {
        $insertData = array(
            'iRequestorID' => getuserid(),
            'iAcceptorID' => $iAcceptorID,
            'eStatus'=>'pending',
            'dtCreated' => gmdate('Y-m-d H:i:s')
        );
        $this->db->insert('tbl_friend', $insertData);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }
    
    function checkEmailAvailable($vEmail) {
        $self_email = $this->db->get_where($this->table, array('iUserID'=>getuserid()))->row()->vEmail;
        //mprd($self_email);
        if($vEmail == $self_email){
            return 0;
            
        }
        $this->db->where('vEmail',$vEmail);
        $query = $this->db->get($this->table); 
        if ($query->num_rows() > 0)
            return 1;
        else
            return 0;
    }
    function getvHmacFromEmail($vEmail){
        $this->db->select("vHmac");
        return $this->db->get_where($this->table, array('vEmail' => $vEmail))->row()->vHmac;
    }
    
    function addUser($postData) {
        
        $postData['dtCreated'] = gmdate('Y-m-d: H:i:s'); 
        $query = $this->db->insert($this->table, $postData);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    } 
    
    function getUserData() {        
        $iUserID  = getuserid();
        $query = $this->db->query("SELECT iUserID, 
                                          vUserName,
                                          vEmail,
                                          vProfilePic,
                                          dDob,
                                          tAdd1,
                                          tAdd2,
                                          vCity,
                                          vState,
                                          vCountry,
                                          vPhone,
                                          eGender                                          
                                FROM $this->table
                                WHERE iUserID= $iUserID"); 
                
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return array();
        }
               
    }
    
    function update($postData){
        
        $iUserID  = getuserid();
        $this->db->update($this->table, $postData,array('iUserID'=>$iUserID));
       // mprd($this->db->last_query());
        
            return 1;
        
    }
    
    
    function verifyEmail($email_address) {
        $this->db->select('iUserID');
        $query = $this->db->get_where($this->table, array('vEmail' => $email_address));
        if ($query->num_rows() > 0)
            return $query->row()->iUserID;
        else
            return 0;
    }
    function checkUserName($user_id, $user_name) {
        $query = $this->db->get_where($this->table, array('vUserName' => $user_name));
//echo $this->db->last_query();exit;
//echo $query->num_rows();exit();
        if ($query->num_rows() > 0) {
            return 0;
        } else {
            $unameupdate = $this->db->query("UPDATE $this->table SET vUserName = '$user_name' where iUserID=$user_id");
            if ($this->db->affected_rows() > 0)
                return 1;
        }
    }
    function checkUserCredentials($email_address, $password) {
        $password = base64_encode($password);
        $query = $this->db->query("SELECT * FROM $this->table WHERE vEmail = '$email_address' and vPassword = binary '$password'");
        if ($query->num_rows() > 0)
            return 1;
        else
            return 0;
    }
    function sendPasswordToEmail($email_address) {
        $this->db->select('vPassword');
        $query = $this->db->get_where($this->table, array('vEmail' => $email_address));
        if ($query->num_rows() > 0) {
            $dataformail = array(
                'email' => $email_address,
                'subject' => 'Forgot Password for Adult-Draw.',
                'password' => base64_decode($query->row()->vPassword)
            );
            $this->load->view('email/forgotpass_view', $dataformail);
            return 1;
        }
        else
            return array();
    }
    function changePassword($email_address, $password) {
        $password = base64_encode($password);
        $this->db->where('vEmail', $email_address);
        $query = $this->db->update($this->table, array('vPassword' => $password));
        if ($this->db->affected_rows() > 0)
            return 1;
        else
            return 0;
    }
     
    
    
    
    
    function getReceiverDeviceInfo($iReceiverID){
        $this->db->select('eDeviceType, vDeviceToken');
        return $this->db->get_where($this->table, array('iUserID'=>$iReceiverID))->row_array();
    }
    
    function getSenderName($iSenderID){
        return $this->db->query("SELECT vUserName FROM $this->table_user where iUserID = $iSenderID")->row()->vUserName;
    }
}
?>