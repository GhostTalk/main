#!/usr/local/bin/php

<?php
	$query = sprintf("SELECT COUNT(*) FROM %s_requests_received;",
		$_POST['Username']);
	$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');
	
	$result = pg_query($conn, $query);
	
	return $result;
?>