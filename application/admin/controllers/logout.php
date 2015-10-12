<?php
class Logout extends CI_Controller
{ 	
	var $viewData = array();
	function __construct()
	{
		 parent::__construct();         
		 $this->load->model('dashboard_model');
	}
	
	function index()
	{	
		//$this->dashboard_model->changetime();
		$this->session->unset_userdata();
		$this->session->sess_destroy();     
		redirect('login','refresh');
	}
}