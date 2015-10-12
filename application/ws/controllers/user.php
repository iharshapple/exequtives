<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

class User extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->table = 'tbl_user';
        //mprd(checkmac());
        if (!checkmac()) {
            $row = array("MESSAGE" => "You are not authorize to use this service", "SUCCESS" => '0');
            $this->response($row, 403);
        }
        $this->load->model('user_model');
    }

    function profile_get() {

        //no email available then user can change an email.
        $res = $this->user_model->getUserData();
        if (!empty($res)) {
           $res['vProfilePic'] =  isset($res['vProfilePic'])?PROFILE_PIC_URL . $res['iUserID'] . '/thumb/' . $res['vProfilePic']:'';
            //$res['vProfilePic'] = PROFILE_PIC_URL . $res['iUserID'] . '/thumb/' . $res['vProfilePic'];
            $this->send_success($res);
        } else {
            $this->send_fail('No data found.');
        }
    }

    function change_pass_post(){

        if (checkparams($this->post(), array('vOldPassword', 'vNewPassword'))) {
            $postData = $this->post();
            extract($postData);
            if ($this->user_model->checkUserAvailableWithOldPass($vOldPassword)) {

                $NewPassword = $this->user_model->changeUserPassword($this->post());                
                if ($NewPassword != '') {

                    $data=array('Message' => 'Password has been changed');

                    $this->send_success($data);
                } else {
                    $this->send_fail('Problem changing password');
                }
            } else {
                $this->send_fail('Your old Password does not match. Please try again');
                   }

        } else {
            $this->send_fail('Insufficient Data');
            }

    }

    function setting_get() {

        $res = $this->user_model->getUserData();
            if (!empty($res)) {

                if($res['vProfilePic']==''){
                   unset($res['vProfilePic']); 
                }else{               
                    $res['vProfilePic'] = PROFILE_PIC_URL.$res['iUserID'].'/thumb/'.$res['vProfilePic'];                    
                } 
                if($res['dDob']=='0000-00-00'){
                        unset($res['dDob']);
                    }     
                $this->send_success($res);
            } else {
                $this->send_fail('No Data found.');
            }        
    }

    function profilePic_post() {

        $postData = $this->post();        
        $iUserID  = getuserid();
        //extract($postData);
        //mprd($_FILES['vProfilePic']);   
        if (isset($_FILES['vProfilePic']) && $_FILES['vProfilePic']['tmp_name'] != '' && $_FILES['vProfilePic']['error'] == 0) {
            $post_image = $this->save($iUserID);
            $data['media_url'] = PROFILE_PIC_URL . $iUserID . '/thumb/' . $post_image;
            $this->send_success($data);
        }else{
            $msg = $_FILES['vProfilePic']='';
            $this->send_fail($msg);
        }
        
    }

    /*function logout_get() {
        $key = $_SERVER['HTTP_ACCESSTOKEN'];
        $data = array(
            'vHmac' => ''
        );
        $iUserID = getuserid();
        $this->db->update($this->table, $data, array('iUserID' => $iUserID));
        if ($this->db->affected_rows() > 0) {
            $this->db->delete('keys', array('key' => $key));
            $row = array("SUCCESS" => '1');
            $this->response($row, 200);
        } else {
            $row = array("MESSAGE" => "Some Problem.", "SUCCESS" => '0');
            $this->response($row, 200);
        }
    }*/

    function updateSetting_post() {
        if (checkparams($this->post(), array('vUserName','vEmail','dDob','tAdd1','tAdd2', 'vPhone', 'vCity','vState','vCountry','eGender'))) {
            $postData = $this->filter_send($this->post());
            extract($postData);
            
            $res = $this->user_model->update($postData);
            if (!empty($res)) {
                //mprd($res);
                $this->send_success($res);
            } else {
                //mprd($res);
                $this->send_fail('Problem in editing setting');
            }
        } else {
            $this->send_fail('Insufficient Data');
        }
    }

    function filter_send($post) {
        foreach ($post as $key => $value) {
            if ($value == '') {
                unset($post[$key]);
            }
        }
        return $post;
    }

    function save($iUserID) {
        // mprd($_FILES);
        if (isset($_FILES['vProfilePic']) && $_FILES['vProfilePic']['name'] != '') {
            $upload_name = $_FILES['vProfilePic']['name'];
            $file_name = time() . "_" . random_string('alnum', 5);
            $targetpath = PROFILE_PIC_ROOT . $iUserID;
            //mprd($targetpath);
            if (!is_dir($targetpath)) {
                if (!mkdir($targetpath, 0777, TRUE)) {
                    exit('dir not created.');
                }
            }
            $config['upload_path'] = $targetpath;
            $config['file_name'] = $file_name;
            $config['allowed_types'] = '*';
            $config['max_size'] = 1024 * 6;
            $config['overwrite'] = false;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('vProfilePic')) {
                extract($this->upload->data());
                $mypath = $targetpath . '/' . $file_name;
                $this->make_thumb($mypath, $targetpath);
                //$this->make_main($mypath, $targetpath);
                $this->db->update('tbl_user', array('vProfilePic' => $file_name), array('iUserID' => $iUserID));
                return $file_name;
            } else {
                $this->send_fail($this->upload->display_errors());
            }
        }
    }

    public function make_thumb($mypath, $img_root_folder) {
        $source_path = $mypath;
        $list = list($width, $height) = getimagesize($mypath);
        $ratio = 100.00 / min($width, $height);
        $w = $width * $ratio;
        $h = $height * $ratio;
        $target_path = $img_root_folder . '/thumb/';
        if (!is_dir($target_path))
            mkdir($target_path, 0777, TRUE);
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => FALSE,
            //'thumb_marker' => '_thumb',
            'width' => 100,
            'height' => $h
        );
        $this->load->library('image_lib', $config_manip);
        $this->image_lib->clear();
        $this->image_lib->initialize($config_manip);
        if (!$this->image_lib->resize()) {
            
        }
    }

    function send_fail($msg) {
        $row = array("MESSAGE" => "$msg", "SUCCESS" => 0);
        $this->response($row, 200);
    }

    function send_success($data) {
        $row = array("DATA" => $data, "SUCCESS" => 1);
        $this->response($row, 200);
    }

}
