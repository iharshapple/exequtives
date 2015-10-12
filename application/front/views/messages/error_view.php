<?php
if($this->session->userdata('ERROR'))
{
                $errors = $this->session->userdata('ERROR');
                $this->session->unset_userdata('ERROR');
                foreach($errors as $key => $val)
                    echo "<div id='alert'><div class='alert alert-danger center'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$val."</div></div>";
}
?>