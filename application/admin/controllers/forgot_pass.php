<?php
class Forgot_pass extends CI_Controller
{ 	
	var $viewData = array();
	function __construct()
	{
		 parent::__construct();     
	}
	
	function index($check='')
	{	
		
	   // $this->lang->switch_to('en');
		$data	=	array(
			'title' =>	'Forgot Password'
		);
		
		if(count($_POST)>0)
	  	{
			
	  		$resU = $this->admin_model->check_admin_email_valid();
	  	}
	  	else
	  	{
			$this->load->model('general_model');
			if(isset($check) && $check == '1')
			{
				$succ = array('0' => PASSWORD_SENT);
				
				$this->session->set_userdata('SUCCESS',$succ);
			}
		
			redirect('login','refresh');
			// $this->load->view('login/login_view',$data);
	  	}
	}
/*
| -------------------------------------------------------------------
|  ACTIVATE EMAIL ACCOUNT
| -------------------------------------------------------------------
*/
function activate($id)
{
	$this->load->library('encrypt');
	//$id	=	$this->encrypt->decode(strtr($id, '___', '+/='));
	$id	=	$this->encrypt->decode($id);
	// CHECK IF URL IS NOT WRONG
	
	if (is_numeric($id)) 
	{
		
		$data	=	array(
			'id'	=>	$id,
			'title' =>	'Reset Password'
		);
		$this->load->view('reset_pass_view',$data);
	}
}
/*
| -------------------------------------------------------------------
|  RESET PASSWORD
| -------------------------------------------------------------------
*/
function reset_pass()
{
	if(count($_POST)>0)
	{
		$this->admin_model->reset_admin_pass($this->input->post('vPassword'));
	}
}
/*
| -------------------------------------------------------------------
|  END OF CLASS FILE
| -------------------------------------------------------------------
*/
}