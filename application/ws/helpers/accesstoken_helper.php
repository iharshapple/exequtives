<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('genratemac')) {


    function genratemac($iUserID) {

        $api_key_variable = config_item('rest_key_name');
        //mprd($api_key_variable);
        $key_name = 'HTTP_' . strtoupper(str_replace('-', '_', $api_key_variable));
        $key = $_SERVER[$key_name];

        $mac = hash_hmac('md5', $key, $iUserID);
        $ci = & get_instance();
        //make it blank
//        $data_blank = array('vHmac' => '');
//        $ci->db->where('iUserID', $iUserID);
//        $ci->db->update('tbl_hmac', $data_blank);
        // update new key

        // $key_id = $ci->db->get_where('keys', array('key' => $key))->row()->id;

        //$data = array('vHmac' => $mac, 'key_id' => $key_id);
        //$ci->db->where('iUserID', $iUserID);
        $insertData = array(
            'iUserID' => $iUserID,
            'vHmac' => $mac,
           // 'key_id' => $key_id,
            'dtCreated' => date('Y-m-d h:i:s')
        );
        $ci->db->insert('tbl_hmac', $insertData);
        if ($ci->db->affected_rows() > 0) {
            return $mac;
        } else {
            return "";
        }
    }

    function checkmac() {
        //mprd($_SERVER);
        //mprd($_SERVER);
        if (isset($_SERVER['HTTP_' . strtoupper(str_replace('-', '_', 'iUserID'))]) && $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', 'iUserID'))] != "" && isset($_SERVER['HTTP_' . strtoupper(str_replace('-', '_', 'accesstoken'))]) && $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', 'accesstoken'))] != "") {
            $ci = & get_instance();
            $q = $ci->db->get_where('tbl_hmac', array('iUserID' => $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', 'iUserID'))], 'vHmac' => $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', 'accesstoken'))]));
            if ($q->num_rows() > 0) {
                $q = $q->row_array();
                $api_key_variable = config_item('rest_key_name');
                if (hash_hmac('md5', $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', $api_key_variable))], $q['iUserID']) == $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', 'accesstoken'))]) {
                    return true;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function getuserid() {
        return $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', 'iUserID'))];
    }

    function delete_key() {
        $key = $_SERVER['HTTP_X_API_KEY'];
        $ci = & get_instance();
        if($ci->db->get_where('keys', array('key' => $key))->num_rows()>0){
            $ci->db->delete('keys', array('key' => $key));
        }
        
    }

    function getEmailFromUserID() {
        $ci = & get_instance();
        return $ci->db->get_where('tbl_user', array('iUserID' => getuserid()))->row()->vEmail;
    }

}