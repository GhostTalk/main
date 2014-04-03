#!/usr/local/bin/php

<?php
	$query = sprintf("INSERT INTO Posts(creatorUsername, receiverUsername, postTime, expirationTime, body, filepath) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')"
		pg_escape_string($_POST['Username']),
		pg_escape_string($_POST['Receiver']),
		pg_escape_string($_POST['PostTime']),
		pg_escape_string($_POST['ExpirationTime']),
		pg_escape_string($_POST['Body']),
		pg_escape_string($_POST['Filepath']));
	$conn = pg_connect("host=cise.postgres.ufl.edu username=cmoore password=calvin#1 dbname=ghosttalk");
	
	$result = pg_query($conn, $query);
	
	echo $result;
?>