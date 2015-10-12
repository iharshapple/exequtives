<?php
	
	$msg['Severity']=$severity;
	$msg['Message']= strip_tags($message);
	$msg['Filename']=$filepath; 
	$msg['linenumber']= $line;
	$msg['type']='1';
	
	$array['success']='0';
	$array['error']=$msg;

	echo json_encode($array);
	exit();

?>


