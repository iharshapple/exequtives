<?php
class Admin_model extends CI_Model 
{
	var $table;
	var $currentLang;
	var $isAdminLogin;
	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->table = 'tbl_admin';
		$this->chk_admin_cookie();
		$this->chk_admin_session();
	}
	function getLang()    
	{
		$lang = $this->session->userdata('userLang');
		
		if($this->session->userdata('userLang') && in_array($this->session->userdata('userLang'),$this->config->item('avail_languages')))
			return $this->session->userdata('userLang');
		return $this->config->item('language');
	}
	function chk_admin_session()
	{
		$user = $this->session->userdata('ADMINLOGIN');
		$session_login = $this->session->userdata("ADMINLOGIN");
		if($session_login == '' && $this->uri->segment(1) != 'login' && $this->uri->segment(1) != 'forgot_pass' && $this->uri->segment(1) != 'confirmation')
			redirect('login');
		/*if($session_login == 1 && $session_login == TRUE && ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'login' || $this->uri->segment(1) == 'forgot_pass'))
		redirect('dashboard');*/
		if($session_login == 1 && $session_login == TRUE && ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'login' || $this->uri->segment(1) == 'forgot_pass' || $this->uri->segment(1) == 'confirmation'))
			redirect('dashboard');
	}
	function chk_admin_cookie()
	{
		$loggedin = $this->chk_cookie();
		if($loggedin === TRUE)
		{
			redirect('dashboard');
		}
	}
	/*************************************************************************
	**                  Check Cookie For Loggedin User
	*************************************************************************/
	function chk_cookie()
	{
		$cookie = md5('loggedin');
		if($cookie_value = get_cookie($cookie))
		{
			$query = $this->db->get_where($this->table,array('md5(vEmail)'=>$cookie_value));
			if($query->num_rows == 1)
			{
				 // If there is a user, then create session data
				$row = $query->row();
				if($row != '')
				{
					$userdata = array(
						'ADMINLOGIN'        => TRUE,
						'ADMINID'           => $row->iAdminID,
						'ADMINFIRSTNAME'    => $row->vFirstName,
						'ADMINLASTNAME'     => $row->vLastName,
						'ADMINEMAIL'        => $row->vEmail
						);
					// STORE SESSION
					$this->session->set_userdata($userdata);
					return true;
				}
			}
			return false;
		}
	}
	/*************************************************************************
	**                  Check User Login
	*************************************************************************/
	function login_check()
	{
		// User Inputs
		$vEmail     = $this->input->post('vEmail',TRUE);
		$vPassword  = $this->input->post('vPassword',TRUE);
		// Define array
		$array = array('vEmail' => $vEmail, 'vPassword' => md5($vPassword));
		// Query
		$query = $this->db->get_where($this->table,$array);
	
		// Let's check if there are any results
		if($query->num_rows == 1)
		{
			// If there is a user, then create session data
			$row = $query->row();
			
			if($row->eStatus == "Active")
			{
					// USER NOT EXISTS IN DATABASE
				if($row != '')
				{
					$userdata = array(
						'ADMINLOGIN'        => TRUE,
						'ADMINID'           => $row->iAdminID,
						'ADMINFIRSTNAME'    => $row->vFirstName,
						'ADMINLASTNAME'     => $row->vLastName,
						'ADMINEMAIL'        => $row->vEmail						
						);
						// STORE SESSION
					$this->session->set_userdata($userdata);
					
						// LOGGEDIN COOKIE ARGUMENTS
					if($this->input->post('chkRemember') == 'on')
					{
						$cookie = array(
							'name'   => md5('loggedin'),
							'value'  => md5($row->vEmail),
							'expire' => '86500',
							'secure' => TRUE
							);
						
							// SET LOOGEDIN COOKIE
						set_cookie($cookie);
					}
					return true;
				}
			}else{
				//mprd("fdfa");
				 $err = array('0' => ACCOUNT_NOT_ACTIVE);

                $this->session->set_userdata('ERROR',$err);

                $this->load->view('login/login_view','');  
				return false;
			}
		}
		else
		{
					//SET ERROR 
			$ers = array(
				'0' => LOGIN_ERROR,
				);
			
			$this->session->set_userdata('ERROR',$ers);
			$this->load->view('login/login_view','');  
			return false;
		}
		
	}
	
	
	/*
	| -------------------------------------------------------------------
	|  CHECK ADMIN EMAIL VALIDATION
	| -------------------------------------------------------------------
	*/  
	function check_admin_email_valid()
	{
		// User Inputs
		$admin_email = $this->input->post('vEmail');
		
		if(isset($admin_email) && $admin_email != '')
		{
			// Query
			$query  = $this->db->get_where($this->table,array('vEmail'=>$admin_email));
			
			// USER NOT EXISTS IN DATABASE
			if($query->num_rows == 0)
			{
				//SET ERROR
				$ers = array(
					'0' => ADMIN_ERROR
					);
				$this->session->set_userdata('ERROR',$ers);
				$this->load->view('login/login_view','');  
				return false;
			}
			else
			{ 
				$row = $query->row();
				//IF USER IS VALID BUT STATUS IS NOT ACTIVATED YET
				if($row->eStatus == NULL)
				{
					//SET ERROR
					$ers = array(
						'0' => ACTIVE_ERROR
						);
					$this->session->set_userdata('ERROR',$ers);
					$this->load->view('login/login_view','');
					return false;
				}
				else
				{
					//SEND RESET PASSWORD LINK TO THE USER VIA EMAIL
					$name       =   $row->vFirstName." ".$row->vLastName;
					$id         =   $row->iAdminID;
					$email      =   $row->vEmail;
					
					$subject    =   'Forgot Password';
					$this->load->library('email');
					$this->load->library('encrypt');
					
					//$encrypted_id = strtr($this->encrypt->encode($id), '+/=', '___');
					$encrypted_id   = $this->encrypt->encode($id);
					$data   =   array(
						'link'      =>  BASEURL."forgot_pass/activate/".$encrypted_id,
						'email'     =>  $email,
						'from'   => $this->getcompanyemail(),
						'subject'   =>  $subject
						);
										
					$this->load->view('email/forgotpass_view',$data);


				}
			}
		}
		else // EMAIL BOX LEFT BLANK
		{
			//SET ERROR
			$ers = array(
				'0' => ADMIN_ERROR
				);
			$this->session->set_userdata('ERROR',$ers);
			$this->load->view('login/login_view','');  
			return false;
		}
	}
	
	/*
	| -------------------------------------------------------------------
	|  RESET ADMIN PASSWORD
	| -------------------------------------------------------------------
	*/  
	function reset_admin_pass($vPassword)
	{
		$id     = $this->input->post('admin_id');
		
		$this->db->update($this->table, array('vPassword'=>md5($vPassword)), array('iAdminID' => $id));
		
		$query  = $this->db->get_where($this->table,array('iAdminID ' => $id));
		$row    = $query->row();
		if($row != '')
		{
			//$this->set_admin_session();
			$userdata = array(
				'ADMINLOGIN'        => TRUE,
				'ADMINID'           => $row->iAdminID,
				'ADMINFIRSTNAME'    => $row->vFirstName,
				'ADMINLASTNAME'     => $row->vLastName,
				'ADMINEMAIL'        => $row->vEmail
				);
			// STORE SESSION
			$this->session->set_userdata($userdata);
			$email      = $row->vEmail;
			$password   = md5($row->vPassword);
			$subject    = "Password Reset";
			
			$this->load->library('email');
			$data = array(
				'link'      =>  BASEURL."login",
				'email'     =>  $email,
				'subject'   =>  $subject,
				'password'  =>  $vPassword
				);
			$this->load->view('email/reset_pass_view',$data);
		}
		else
		{
			return false;
		}   
	}
	/************************************************************************
	Admin Setting(Getting user details by ADMINID=> From session Element)
		************************************************************************/
		function admin_setting()
		{
			$query  = $this->db->get_where($this->table,array('iAdminID ' => $this->session->userdata('ADMINID')));
			
			if($query->num_rows() > 0)
				return $query->row_array();
			else
				return '';  
		}
	// **********************************************************************
								// Edit Admin
	 // **********************************************************************
		function edit_admin_setting()
		{
			$admin_id        = $this->session->userdata('ADMINID');
			$updateData = array('vFirstName'        =>$this->input->post('vFirstName'),
				'vLastName'     =>$this->input->post('vLastName'),
				'vEmail'        =>$this->input->post('vEmail')
				);
			
			$query = $this->db->update($this->table,$updateData, array('iAdminID ' => $iAdminID));
			
			if($this->db->affected_rows() > 0)
			{
				$userdata = array(
					'ADMINLOGIN'        => TRUE,
					'ADMINID'           => $iAdminID,
					'ADMINFIRSTNAME'    => $this->input->post('vFirstName'),
					'ADMINLASTNAME'     =>$this->input->post('vLastName'),
					'ADMINEMAIL'        => $this->input->post('vEmail')
					);
// STORE SESSION
				$this->session->set_userdata($userdata);
				return $query;
			}
			else
				return '';  
		}
	// **********************************************************************
								// Check Old Password
	 // **********************************************************************
		function checkOldPassword()
		{
			$arrData = array('vEmail' => $this->session->userdata('ADMINEMAIL'),
				'vPassword' => md5($this->input->post('vOldPassword'))
				);
			$query  = $this->db->get_where($this->table,$arrData);
			if($query->num_rows() >= 1)
				return 1;
			
			return 0;
		}
	// **********************************************************************
								// Change Password
	 // **********************************************************************
		function changePassword()
		{
			
			$data = array('vPassword' => md5($this->input->post('vPassword')));
			$where = "vEmail ='".$this->session->userdata('ADMINEMAIL')."'"; 
//you can use array
			
			$query = $this->db->update('tbl_admin', $data, $where);
			
			return $query;
		}
	// **********************************************************************
								// Display List of Adminstrator Module
	 // **********************************************************************
		function getAdminDataAll()
		{
			$this->db->from($this->table);
			$result = $this->db->get();
			/*$result->result_array();
			print_r($result);
			exit;
*/			
			if($result->num_rows() > 0)
				return $result->result_array();
			else
				return '';  
		}
	/************************************************************************
	Admin Setting(Getting user details by admin_id(Selected or inserted)
		************************************************************************/
		function getAdminDataById($iAdminID)
		{
			$result = $this->db->get_where($this->table, array('iAdminID' => $iAdminID));
			
			
			if($result->num_rows() > 0)
				
				return $result->row_array();
			
			else
				return '';  
		}
	// **********************************************************************
								// Admin Status
	 // **********************************************************************
		function changeAdminStatus($iAdminID)
		{
	//$updateData = array('admin_status' => 'IF (admin_status = "Active", "Inactive","Active")');
			
	//$query = $this->db->update($this->admin_tbl,$updateData, array('admin_role ' => $admin_role));
			$query = $this->db->query("UPDATE $this->table SET eStatus = IF (eStatus = 'Active', 'Inactive','Active') WHERE iAdminID = $iAdminID");
			
			if($this->db->affected_rows() > 0)
				return $query;
			else
				return '';  
		}
	// **********************************************************************
					// remove admin
	 // **********************************************************************
		function removeAdmin($iAdminID)
		{

			$adid=implode(',', $iAdminID);
			$query=$this->db->query("DELETE from tbl_admin WHERE iAdminID in ($adid) ");
			//$query = $this->db->delete($this->table, array('iAdminID' => $iAdminID)); 
			if($this->db->affected_rows() > 0)
				return $query;
			else
				return '';  
		}
	// **********************************************************************
					// add admin
	 // **********************************************************************
		function addAdmin($postData)
		{
			extract($postData);
			$vPassword=md5($vPassword);
			
			$data = array('vFirstName'  => $vFirstName ,
				'vLastName' => $vLastName,
				'vEmail'    => $vEmail,
				'eStatus'   => 'Active',
				'iAddedBy'  => $this->session->userdata('ADMINID'),
				'vPassword'    =>  $vPassword
				
				);
			
			$query = $this->db->insert($this->table, $data); 
			
			if($this->db->affected_rows() > 0)
				return $this->db->insert_id();
			else
				return '';
		}
	// **********************************************************************
					// Edit admin
	 // **********************************************************************
		function editAdmin($postData)
		{
			
			extract($postData);
			
			$updateData = array(  'vFirstName' => $vFirstName,
				'vLastName'  => $vLastName,
				'vEmail'       => $vEmail,
				'iLastEditedBy' => $this->session->userdata('ADMINID')
				);
			if (isset($vPassword) && $vPassword != "") 
			{
				$updateData['vPassword']=md5($vPassword);
			}
			
			$query = $this->db->update($this->table,$updateData, array('iAdminID' => $iAdminID));
			
			if($this->db->affected_rows() > 0)
				return $query;
			else
				return '';  
		}
	// **********************************************************************
							// Check Email Availibility
	 // **********************************************************************
		function checkAdminEmailAvailable($vEmail,$iAdminID ='')
		{
			if($iAdminID !='')
				$check = array('vEmail' => $vEmail,'iAdminID  <>'=>$iAdminID );
			else
				$check = array('vEmail' => $vEmail);
			
			
			$result = $this->db->get_where($this->table,$check);
			//mprd($this->db->last_query());
			if($result->num_rows() >= 1 )
				return 0;
			else
				return 1;   
		}
				
	// **********************************************************************
							// Check adminID Availibility
	 // **********************************************************************
		function checkAdminIDAvailable($iAdminID ='')
		{	//mprd("hello");
			if($iAdminID !=''){
				$check = array('iAdminID  '=>$iAdminID );
			}else{
				return '';
			}			
			$result = $this->db->get_where($this->table,$check);
			//mprd($this->db->last_query());
			if($result->num_rows() >= 1 )
				return 1;
			else
				return 0;   
		}			
	/****************************************************
	**              Role Manegement
	****************************************************/
	
	function getAdminRoleListById($admin_role)
	{
		$result = $this->db->get_where($this->role_tbl,array('admin_role'=>$admin_role));
		
		if($result->num_rows() > 0)
			return $result->result_array();
		else
			return '';      
	}
	
	function changeAdminRoladmin_status($iRoleId)
	{
		//$updateData = array('admin_status' => 'IF (admin_status = "Active", "Inactive","Active")');
		
		//$query = $this->db->update($this->table,$updateData, array('admin_role ' => $admin_role));
		$query = $this->db->query("UPDATE $this->role_tbl SET admin_status = IF (admin_status = 'Active', 'Inactive','Active') WHERE iRoleId = $iRoleId");
		
		if($this->db->affected_rows() > 0)
			return $query;
		else
			return '';  
	}
	
	function removeAdminRole($iRoleId)
	{
		$query = $this->db->delete($this->role_tbl, array('iRoleId' => $iRoleId)); 
		
		if($this->db->affected_rows() > 0)
			return $query;
		else
			return '';  
	}
	
	function getRoleDataById($iRoleId,$admin_role)
	{
		$result = $this->db->get_where($this->role_tbl, array('admin_role' => $admin_role,'iRoleId'=>$iRoleId));
		
		if($result->num_rows() > 0)
			return $result->row_array();
		else
			return '';  
	}
	
	function checkAdminRoleAvailable($vRoleName,$admin_role,$iRoleId='')
	{
		if($iRoleId!='')
			$check = array('vRoleName' => $vRoleName,'admin_role' => $admin_role,'iRoleId <>'=>$iRoleId);
		else
			$check = array('vRoleName' => $vRoleName,'admin_role' => $admin_role);
		
		
		$result = $this->db->get_where($this->role_tbl,$check);
		if($result->num_rows() >= 1 )
			return 0;
		else
			return 1;   
	}
	
	function addRole($postData)
	{
		
		extract($postData);
		
		$data = array('vRoleName'       => $vRoleName ,
			'admin_role'        => $admin_role,
			'admin_status'  => $admin_status
			);
		
		$query = $this->db->insert($this->role_tbl, $data); 
		
		if($this->db->affected_rows() > 0)
			return $query;
		else
			return '';
	}
	
	function editRole($postData)
	{
		extract($postData);
		
		$updateData = array('vRoleName'     => $vRoleName ,
			'admin_status'      => $admin_status
			);
		
		$query = $this->db->update($this->role_tbl,$updateData, array('iRoleId ' => $iRoleId));
		
		if($this->db->affected_rows() > 0)
			return $query;
		else
			return '';  
	}
	// **********************************************************************
					// Activation  Mail
	 // **********************************************************************
	function sendActivationMailToAdmin($admin_id,$admin_pwd)
	{
		$query  = $this->db->get_where($this->table,array('admin_id'=>$admin_id));
		$row = $query->row();
		
		
		$this->load->library('email');
		$this->load->library('encrypt');
		
		$encrypted_id   = $this->encrypt->encode($row->admin_email);
		
		$subject = "Your account has been created.";
		$data = array(
			'sitelink'          =>  BASEURL."login/",
			'acvtivation_link'  =>  BASEURL."confirmation/index/".$encrypted_id,
			'email'             =>  $row->admin_email,
			'subject'           =>  $subject,
			'password'          =>  $admin_pwd
			);
		
		$this->load->view('email/company_activation_view',$data);
	}
	// **********************************************************************
					// Activation Account
	 // **********************************************************************
	function activateAccount($admin_email,$admin_pwd)
	{
		$updateData = array('admin_status' => 'Active','admin_pwd' => md5($admin_pwd));
		$query = $this->db->update($this->table,$updateData, array('admin_email' => $admin_email));
		if($this->db->affected_rows() > 0)
			return 1;
		else
			return 0;
	}
	function checkAccountActivate($admin_email)
	{
		$checkData = array('admin_status' => 'Active','admin_email' => $admin_email);
		$query = $this->db->get_where($this->table,$checkData);
		if($query->num_rows() == 0)
			return 1;
		else
			return 0;
	}
	function get_result()
	{
		$this->db->select('iAdminID,vFirstName,vLastName,vEmail');
		///$this->db->like('table.field',$this->input->post('sSearch'));
		//$this->db->where('table.field2',$this->input->post('field2'));
		$this->db->limit(
			$this->input->post('iDisplayLength'),
			$this->input->post('iDisplayStart')
			);
		$query = $this->db->get('tbl_admin');
		//echo $this->db->last_query();exit;
		return $query->result_array();
		
	}
	public function getcompanyemail()
	{
		$this->db->select('vCompanymail');
		$cmpdata=$this->db->get('tbl_setting');
		if ($cmpdata->num_rows() > 0) 
		{
			$cmpdata=$cmpdata->row_array();
			return $cmpdata['vCompanymail'];
		}
		else
		{
			return "";
		}
	}
}
?>