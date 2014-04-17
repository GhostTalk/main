#!/usr/local/bin/php

<?php
	session_start();
	
	$conn = pg_connect("host=postgres.cise.ufl.edu dbname=ghosttalk user=cmoore password=calvin#1");
	
	$query = sprintf("INSERT INTO Requests(senderUsername, receiverUsername) VALUES ('%s', '%s');",
		pg_escape_string($_SESSION['Username']),
		pg_escape_string($_POST['username']));
		
	$result = pg_query($conn, $query);
?>