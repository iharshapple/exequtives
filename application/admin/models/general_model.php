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
	//************************************************************
    				//Check for Super Admin(If needed)
    //************************************************************
	function isSuperAdmin()
	{
		if($this->session->userdata('ADMINTYPE') && $this->session->userdata('ADMINTYPE') == 'Super')
			return 1;
		return 0;
	}
	//************************************************************
    				//If not find any record
    //************************************************************
	function noRecordsHere()
	{
		echo '<div class="alert i_magnifying_glass yellow"><strong>Opps!!&nbsp;&nbsp;:</strong>&nbsp;&nbsp;No Records available here.</div>';
	}
	//************************************************************
    				//Truncatting string
    //************************************************************
	function myTruncate($string, $limit, $break=".", $pad=".") { // return with no change if string is shorter than $limit
	 if(strlen($string) <= $limit) return $string; // is $break present between $limit and the end of the string?
	  if(false !== ($breakpoint = strpos($string, $break, $limit)))
	  	 { 
		 	if($breakpoint < strlen($string) - 1) 
				{ 
					$string = substr($string, 0, $breakpoint) . $pad;
				} 
		} 
		return $string; 
	}
	//**************************************************
					//BreadCrumb
	//**************************************************
	function getAdminBreadCrumb($arr)
	{
		$seg=$this->uri->segment(1);
		$str='';
		foreach($arr as $k=>$v)
		{
			if(next($arr))
				$str .= "<li><a href='../$seg/'>".$v."</a></li>";
			else
				$str .="<li><a class='active'>".$v."</a></li>";				
		}
		return $str;
	}
	function getAllusers(){
		$this->load->model();
	}
	function getcountries($id="")
	{
		$strtoprint="";
		$result=$this->db->get('countries');
		if ($result->num_rows() > 0)
		{
			$result=$result->result_array();
			foreach ($result as $key => $value) 
			{
				$seltoprint="";
				if ($id != "") 
				{
					$seltoprint=($id==$value['idCountry'])?"SELECTED":"";
					
				}
				
				$strtoprint .= "<option  $seltoprint value='".$value['idCountry']."' >".$value['countryName']."</option>";
			}	
			return $strtoprint;
		}
		else
		{
			return "";
		}
	}

}
	