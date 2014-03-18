#!/usr/local/bin/php

<?php
	
	$conn = pg_connect("user=cmoore host=postgres.cise.ufl.edu dbname=ghosttalk password=calvin#1");
	$query = sprintf("SELECT password FROM GTUser WHERE username='%s'",
		pg_escape_string($_POST['Username']));
	//$query1 = sprintf("INSERT INTO GTUser(username, password, firstName, lastName, email, currentCity, gender) VALUES ('cmoore', '%s', 'Calvin', 'Moore', 'cmoore@cise.ufl.edu', 'Gainesville', 'M')",
	//	crypt('calvin#1', 'so$&@2oranme0#$dom0ejfkjp-3489s023jktrin[90932;k]g%^&'));
	//$result1 = pg_query($conn, $query1);
	$result = pg_fetch_assoc(pg_query($conn, $query));
	
	if($result && crypt($_POST['Password'], $result['password']) == $result['password']) {
		header('Location: http://www.google.com/');
	} else {
		header('Location: http://cise.ufl.edu/~cmoore');
	}
?>
