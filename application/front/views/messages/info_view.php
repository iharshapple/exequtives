<?php
if($this->session->userdata('INFO'))
{
	$errors = $this->session->userdata('INFO');
	$this->session->unset_userdata('INFO');
	foreach($errors as $key => $val)
		echo "<div class='alert i_magnifying_glass yellow'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$val</div>";			
}
?>