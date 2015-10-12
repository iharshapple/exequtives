<?php 

			$errordic=array('message_heading' =>$heading,
							'message_body' => strip_tags($message) );
			$error=array('status' => '400',
						'success' => '0',
						'error'	=> $errordic,
						'type'	=> '1');	

			echo json_encode($error);
					


?>
