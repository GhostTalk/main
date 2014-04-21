#!/usr/local/bin/php

<?php
	session_start();
	
	$query = sprintf("SELECT COUNT(*) as count_requ FROM %s_requests_received;",
		$_SESSION['Username']);
	$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');
	
	$result = pg_query($conn, $query);
	
	echo json_encode(pg_fetch_assoc($result));
?>