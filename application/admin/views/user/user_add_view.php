<?php   $headerData = $this->headerlib->data();
/*****************************************************
		**          DEFINE FORM ATTRIBUTES  *****************************************************/
if ( isset( $getUserData ) && $getUserData != '' )
	extract( $getUserData );
	$form_attr  = array( 'name'=>    'user-form',
		"id"        =>  "validateForm",
		'method'    =>  'post',
		'class'     =>  "form-horizontal row-fluid");
	$first_name = array( 'name'=>    'vFirstname',
		'id'=>  'normal-field',
		'value'=> ( isset( $vFirstname ) && $vFirstname!= '' )?$vFirstname:'',
		'type'          => 'text',
		"data-errortext"=>  "This is user's First name!",
		'class'         => 'row-fluid');
	$last_name = array( 'name'=> 'vLastname',
		'id'=>  'vLastname',
		'value'=> ( isset( $vLastname ) && $vLastname!= '' )?$vLastname:'',
		'type'          => 'text',
		"data-errortext"=>  "This is user's last name!",
		'class'         => 'row-fluid'  );
	$Phone = array( 'name'=> 'vPhone',
		'id'=>  'vPhone',
		'value'=> ( isset( $vPhone ) && $vPhone!= '' )?$vPhone:'',
		'type'          => 'tel',
		'class'         => 'row-fluid'  );
	$user_name = array( 'name'=> 'vUsername',
		'id'=>  'vUsername',
		'value'=> ( isset( $vUsername ) && $vUsername!= '' )?$vUsername:'',
		'type'          => 'text',
		"required"      =>  "required",
		'class'         => 'row-fluid'  );
	$email = array( 'name'=> 'vEmail',
		'id'=>  'vEmail',
		"required"      =>  "required",
		"data-errortext"=>  "This is user's email address!",
		'value'=> ( isset( $vEmail ) && $vEmail != '' )?$vEmail:'',
		'type'          => 'email',
		
		'class'         => 'row-fluid' );
	if (isset( $vEmail ) && $vEmail != '') 
	{
		$email['readonly'] = 'readonly';
	}
	$gendermale = array( 'name'=> 'eGender',
		'id'=>  'eGendermale',
		'value'=> 'Male',
		'type'          => 'radio',
		'class'         => 'row-fluid widthheight' );
	if (isset( $eGender ) && $eGender != '' && $eGender== "Male" )
	{
		$gendermale['CHECKED'] ="CHECKED";
	}
	$genderfemale = array( 'name'=> 'eGender',
		'id'=>  'eGenderfemale',
		'value'=> 'Female',
		'type'          => 'radio',
		'class'         => 'row-fluid' );
	if (isset( $eGender ) && $eGender != '' && $eGender== "Female" )
	{
		$gendermale['CHECKED'] ="CHECKED";
	}
	$password = array( 'name'=>  'vPassword',
		'id'=>  'vPassword',
		"required"      =>  "required",
		"data-errortext"=>  "This is user's password!",
		'value'=> '',
		'type'          => 'password',
		'placeholder'   =>'min 5 characters' );
	$city = array( 'name'=> 'vCity',
		'id'=>  'vCity',
		'value'=> ( isset( $vCity ) && $vCity!= '' )?$vCity:'',
		'type'          => 'text',
		'class'         => 'row-fluid'  );
	$state = array( 'name'=> 'vState',
		'id'=>  'vState',
		'value'=> ( isset( $vState ) && $vState!= '' )?$vState:'',
		'type'          => 'text',
		'class'         => 'row-fluid'  );
	$country =( isset( $vCountry ) && $vCountry!= '' )?$vCountry:'';
	
	$dob =  ( isset( $dDob ) && $dDob!= '' )?$dDob:date('Y-m-d') ;
	$activestatus = array(
		'name'=> 'eStatus',
		'value'       => 'Active',
		'checked'     => ( isset( $eStatus ) && $eStatus == 'Active' )?'TRUE':'FALSE');
	$inactivestatus = array( 'name'  => 'eStatus',
		'value'       => 'Inactive',
		'checked'     => ( isset( $eStatus ) && $eStatus == 'Inactive' )?'TRUE':'FALSE');   
	$hiddenaddattr = array( 
		'action'       => 'backoffice.useradd'); 
	$hiddeneditattr = array( 
		'action'       => 'backoffice.useredit');  
	$user_id       = array( "iUserID"    => ( isset( $iUserID ) && $iUserID != '' )?$iUserID:'' );
	$submit_attr    =   array(
		'class'   => 'submit  btn-primary btn-large marginright',
		'type' => 'submit',
		'content' => "$ACTION_LABEL user");
?>
<!doctype html>
<html lang="en-us">
<head>    <title><?=$title?></title>    
<?= $headerData['meta_tags']; ?>
<?= $headerData['stylesheets']; ?>
<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
<?= $headerData['javascript']; ?>
<style>
	.widthheight
	{
		width:300px !important;
		height:20px !important;
	}
	.error
	{
		min-width: 250px;
	}
</style>
</head>
<body>
<?php $this->load->view( 'include/sidebar_view' )?>
<div id="main">
	<div class="container">
		<?php $this->load->view( 'include/header_view' )?>
		<div class="row-fluid">
			<?php echo $this->general_model->getMessages()?>
			<div class="span10">
				<div class="box gradient">
					<div class="title">
						<h3>
							<i class="icon-book"></i><span><?php echo $ACTION_LABEL." user"; ?></span>
							<span class="pull-right"><?php echo anchor( "user/", "<button class='btn btn-info'>Back to List</button>" );?></span>
						</h3>
					</div>
					<div class="content">
						<?php echo form_open_multipart( "user/add", $form_attr );
						if ( isset( $iUserID ) && $iUserID != '' ) {
						echo form_hidden( $user_id );
						echo form_hidden( $hiddeneditattr );
						}else {
						echo form_hidden($hiddenaddattr );
						}?>
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">First Name</label>
							<div class="controls span7">
								<?php echo form_input( $first_name ); ?>
							</div>
						</div>
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">Last Name</label>
							<div class="controls span7">
								<?php echo form_input( $last_name ); ?>
							</div>
						</div>
						<div class="form-row control-group row-fluid">
			                <label class="control-label span3" for="normal-field">Gender <span class="required">*</span></label>
			                <div class="controls span7">
			                  <label class="inline radio">
			                  <?php echo form_input( $gendermale ); ?>Male</label>
			                  <label class="inline radio">
			                  <?php echo form_input( $genderfemale ); ?>Female</label>
			                </div>
			            </div>
						
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">User Name<span class="required">*</span></label>
							<div class="controls span7">
								<?php echo form_input( $user_name ); ?>
							</div>
						</div>
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">Email<span class="required">*</span></label>
							<div class="controls span7">
								<?php echo form_input( $email ); ?>
							</div>
						</div>
						<div class="form-row control-group row-fluid scrollpashandler">

			                <label class="control-label span3" for="normal-field">Password</label>

			                <div class="controls span7">
									<a id="chngpass" href="javascript:void(0)">Change Password</a>	
			                </div>

			              </div>
			              	<div class="scrollpas">
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="password-field">Password<span class="required">*</span> </label>
							<div class="controls span7 input-prepend">
								<span class="add-on"><i class="icon-lock"></i></span>
								<?php echo form_password( $password ); ?>
							</div>
						</div>
					
						<div class="control-group row-fluid">
							<label class="control-label span3">Confirm Password</label>
							<div class="controls span7 input-prepend">
								<span class="add-on"><i class="icon-lock"></i></span>
								<input type="password" required minlength=5 id="confirm_password" placeholder="confirm password" name="confirm_password">
							</div>
						</div>
						</div>	
						<div class="form-row control-group row-fluid">
			                <label class="control-label span3" for="normal-field">Date Of Birth<span class="required">*</span></label>
			                <div class="controls span7">
			                  <div class="input-append date row-fluid"  data-date="<?= date('Y-m-d') ?>" data-date-format="yyy-mm-dd">
			                    <input type="text" name="dDob" id="datepicker" value="<?= $dob ?>" required  class="row-fluid">
			                    <span class="add-on"><i class="icon-th"></i></span>
			                  </div>
			                </div>
			            </div>
			            <?php if (isset($vImage) && $vImage != ""): ?>
			        <div class="form-row control-group row-fluid">
	                            <label class="control-label span3" for="normal-field">Upload Image<span class="required">*</span></label>
	                            <div class="controls span7">
	                                <div class="input-append row-fluid">
	                                	<input type="hidden" name="imagetodelete" value="<?= $vImage ?>">
	                                   <img src="<?= $Profilepic_thumb ?>" id="profilepic" style="margin-right:20px" alt="PROFILE PIC">
	                                    <input type="file" style="margin-bottom: 10px;"  class="spa1n6 fileinput" name="vImage" id="imagebootun" accept="image/*" />
	                                   <button class='btn btn-secondary' type='button' id="removebutton" onclick=''>Remove	</button>
	                                </div>
	                            </div>
	                        </div>
			            	
							<?php else: ?>
							<div class="form-row control-group row-fluid">
	                            <label class="control-label span3" for="normal-field">Upload Image<span class="required">*</span></label>
	                            <div class="controls span7">
	                                <div class="input-append row-fluid">
	                                    <input type="file" style="margin-bottom: 10px;" class="spa1n6 fileinput" name="vImage"   accept="image/*" />

	                                </div>
	                                

	                            </div>

	                        </div>
			            <?php endif ?>
						
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">City</label>
							<div class="controls span7">
								<?php echo form_input( $city ); ?>
							</div>
						</div>
						<!-- <div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">State</label>
							<div class="controls span7">
								<?php // echo form_input( $state ); ?>
							</div>
						</div>
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">Country</label>
							<div class="controls span7">
								 <select data-placeholder="Choose a Country..." id="vCountry" name="vCountry" required class="chzn-select">
				                    <option value="">SELECT</option>
				                   	<?php // echo  $this->general_model->getcountries($country); ?>
				                  </select>
							</div>
						</div> -->
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">Phone</label>
							<div class="controls span7">
								<?php echo form_input( $Phone ); ?>
							</div>
						</div>
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">User Type</label>
							<div class="controls span7">
								<select name="eType" class="chzn-select" id="etype" required="required">
									<option value="Individual" <?=(isset($eType) && $eType != '' && $eType == 'Individual')?'selected="selected"':''?> >Individual</option>
									<option value="Bussiness" <?=(isset($eType) && $eType != '' && $eType == 'Bussiness')?'selected="selected"':''?>>Bussiness</option>
								</select>
							</div>
						</div>
						<div class="form-row control-group row-fluid">
							<label class="control-label span3" for="normal-field">Profile Type</label>
							<div class="controls span7">
								<select name="eProfilestatus" id="eProfilestatus" class="chzn-select" required="required">
									<option value="Private" <?=(isset($eProfilestatus) && $eProfilestatus != '' && $eProfilestatus == 'Private')?'selected="selected"':''?> >Private</option>
									<option value="Public" <?=(isset($eProfilestatus) && $eProfilestatus != '' && $eProfilestatus == 'Public')?'selected="selected"':''?>>Public</option>
								</select>
							</div>
						</div>
						<div class="form-actions row-fluid">
							<div class="span7 offset3">
								<?php echo form_button( $submit_attr );
								//echo "<button class='btn btn-secondary' type='button' onclick='clearForm(this.form)'>Cancel</button>";
								?>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function clearForm(oForm)
	{
		 var frm_elements = oForm.elements;
		//window.location.reload();
		//$('#form-dept')[0].reset();
		for(i=0; i<frm_elements.length; i++)
		{
			// code for accessing each element goes here
			field_type = frm_elements[i].type.toLowerCase();
			switch (field_type)
			{
				case "text":
				case "password":
				case "textarea":
				case "hidden":
				frm_elements[i].value = "";
				break;
				case "radio":
				case "checkbox":
				if (frm_elements[i].checked)
				{
					frm_elements[i].checked = false;
				}
				break;
				case "select-one":
				case "select-multi":
				frm_elements[i].selectedIndex = -1;
				break;
				default:
				break;
			}
		}
	}
	$().ready(function() 
	{



		if (<?= (isset($vEmail) && $vEmail != "")?1:0?>==1) 
	{
		$(".scrollpas").hide();
		$(".scrollpashandler").show();
	}
	else
	{
		$(".scrollpashandler").hide();	
	}
	$("#chngpass").click(function(event) 
	{
			$(".scrollpas").slideToggle('slow');
	});


		 $(".chzn-select").chosen({
   disable_search_threshold: 10
 });
		if (<?= isset($iUserID)?"1":"0"  ?> ) 
		{
			$(".uploader").hide('fast');
		}
		
		$("#removebutton").click(function(event) 
		{
			$(this).hide('fast');
			$("#profilepic").hide('fast');
			$(".uploader").show('fast');
		});
		$(".fileinput").customFileInput();
		$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'  });

	    $("#validateForm").validate({
	    	rules: {
			// vCountry: {
			// 	required: true,
			// },
			vEmail: {
				required: true,
				email: true
			},
			eGender: {
				required: true
			},
			vUserName:{
				required: true,
			},
			vPassword: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#vPassword"
			},
			vImage: {
				required: true
			
			},
			vPhone : "number",
			
			radios: "required",
			dDob: "required",
		},
			messages: {
			vUserName: "Please enter a username",
			eGender: "Please Select Gender",
			vPassword: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			vEmail: "Please enter a valid email address",
			vCountry: "Please Select a valid Country",
			}
	    });
	});
</script>    
<?php $this->load->view( 'include/footer_view' )?>
