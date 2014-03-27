#!/usr/local/bin/php

<?php
	
	$conn = pg_connect("user=cmoore host=postgres.cise.ufl.edu dbname=ghosttalk password=calvin#1");
	$query = sprintf("SELECT password FROM GTUser WHERE username='%s'",
		pg_escape_string($_POST['Username']));
	$result = pg_fetch_assoc(pg_query($conn, $query));
	if($result && crypt($_POST['Password'], $result['password']) == $result['password']) {
		header('Location: http://www.google.com/');
	} else {
		header('Location: http://cise.ufl.edu/~cmoore');
	}
?>
