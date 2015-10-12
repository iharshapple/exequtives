<?php
class General_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();         
		$this->role_tbl = 'admin';
    }
    //************************************************************
    				//Error Or success Msg View
    //************************************************************
    function getMessages()
	{
		if($this->session->userdata('ERROR') && array_count_values($this->session->userdata('ERROR')) > 0)
			return $this->load->view('messages/error_view');
		else if($this->session->userdata('SUCCESS') && array_count_values($this->session->userdata('SUCCESS')) > 0)
			return $this->load->view('messages/success_view');
	}
}
	