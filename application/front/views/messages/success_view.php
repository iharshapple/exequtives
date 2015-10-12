<?php
if($this->session->userdata('SUCCESS'))
{
			$errors = $this->session->userdata('SUCCESS');
			$this->session->unset_userdata('SUCCESS');
			foreach($errors as $key => $val)
			    echo "<div id='alert'><div class=' alert alert-block alert-info fade in center'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$val</div></div>";			
}
?>