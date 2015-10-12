<?php

class Forgot_pass extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    /*
      | -------------------------------------------------------------------
      |  ACTIVATE EMAIL ACCOUNT
      | -------------------------------------------------------------------
     */

    function activate($email_enc, $temp_pass_enc) {
      // mprd($email_enc);
        $this->load->library('encrypt');
        
        $this->load->library('email');
        
        $id = base64_decode(urldecode($email_enc));

        $password = base64_decode($temp_pass_enc);
        //mprd($id);
        //mprd($password);

        if ($this->db->get_where('tbl_user', array('iUserID' => $id, 'temp_pass' => $password))->num_rows()) {
            $email = $this->getEmailFromiUserID($id);
            //mprd($email);
            $data = array(
                'email' => $email,
                'password' => $password,
                'subject' => 'New Password'
            );
            $this->load->view('email/reset_pass_view', $data);
            $this->db->update('tbl_user', array('vPassword' => md5($password)), array('iUserID' => $id));
            echo 'New password sent to Email.';
        }
    }
    
    function getEmailFromiUserID($id) {
        $this->db->select('vEmail');
        $query = $this->db->get_where('tbl_user', array('iUserID' => $id));
        if ($query->num_rows() > 0) {
            return $query->row()->vEmail;
        } else {
            return 0;
        }
    }
    
    

}