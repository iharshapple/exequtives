<?php

class Dashboard extends CI_Controller

{ 	

	var $viewData = array();

	function __construct()

	{

		 parent::__construct();         

		$this->load->model('dashboard_model');

	}

	

	function index()

	{	
		$data = array('title'=>'Dashboard');
		$this->load->view('dashboard/dashboard_view',$data);

	}
	
}