<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");

	$user = $_SESSION['Username'];
	$query = sprintf("DELETE FROM requests WHERE senderusername='%s' AND receiverusername='%s'",
			pg_escape_string($_POST['sender']),
			pg_escape_string($_SESSION['Username']));
					
			
	$result = pg_query($conn, $query);
	
	$message = "Request has been declined";

	echo json_encode($message);

?>
