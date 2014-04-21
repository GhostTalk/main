#!/usr/local/bin/php

<?php
	session_start();
	
	$query = sprintf("SELECT COUNT(*) AS mess_count FROM %s_messages_received WHERE read=false;",
		$_SESSION['Username']);
	$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');
	
	$result = pg_query($conn, $query);
	
	echo json_encode(pg_fetch_assoc($result));
?>