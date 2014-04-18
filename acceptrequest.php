<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");

	$user = $_SESSION['Username'];
	
	$query1 = sprintf("INSERT INTO groups(name,creatorusername,memberusername) VALUES ('Friends', '%s', '%s');",
		pg_escape_string($_SESSION['Username']),
		pg_escape_string($_POST['sender']));
	
	$query2 = sprintf("INSERT INTO groups(name,creatorusername,memberusername) VALUES ('Friends', '%s', '%s');",
		pg_escape_string($_POST['sender']),
		pg_escape_string($_SESSION['Username']));
	
	$query3 = sprintf("DELETE FROM requests WHERE senderusername='%s' AND receiverusername='%s'",
		pg_escape_string($_POST['sender']),
		pg_escape_string($_SESSION['Username']));
					
		
	$result1 = pg_query($conn, $query1);
	$result2 = pg_query($conn, $query2);
	$result3 = pg_query($conn, $query3);
	$message = "Request has been accepted";

	
	
	echo json_encode($message);

?>
