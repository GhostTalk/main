<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	$user = $_SESSION['Username'];
	$friend = $_POST['friendList'];
	$expiration = $_POST['expiration'];
	$message = $_POST['message'];
	$pic = $_POST['picture'];
	$date = date('Y-m-d H:i:s');
	
	
	
	
	function sendemail($user,$friend){
		$subject = 'Message received';
		$emailmessage = $user .'has sent you a message'
		
		for($i=0; $i<count($friend);++$i){
		mail($friend[$i],$subject,$emailmessage)
		}
	}
	
	

?>
