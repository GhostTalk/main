#!/usr/local/bin/php

<?php
	$query = sprintf("SELECT username FROM GTUser WHERE username='%s'",
		pg_escape_string($_POST['Username']));
	$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');

	$result = pg_query($conn, $query);

	if($result && $result['username'] == $_POST['Username'])
		return false;
	else if(!$result)
		return false;
	else
		return true;
?>