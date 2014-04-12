#!/usr/local/bin/php

<?php
	session_start();
	
	$query = sprintf("UPDATE Posts SET read=true WHERE creatorUsername='%s' AND receiverUsername='%s' AND posttime='%s'",
		pg_escape_string($_POST['sender']),
		pg_escape_string($_SESSION['Username']),
		pg_escape_string($_POST['posttime']));
	
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	
	$result = pg_query($conn, $query);
?>
