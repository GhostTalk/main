#!/usr/local/bin/php

<?php
	$query = sprintf("SELECT email FROM GTUser WHERE email='%s'",
		pg_escape_string($_POST['Email']);
	$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');

	$result = pg_query($conn, $query);

	if($result && $result['email'] == $_POST['Email'])
		return false;
	else
		return true;
?>