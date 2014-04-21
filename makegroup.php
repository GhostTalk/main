#!/usr/local/bin/php

<?php
	session_start();
	$user = $_SESSION['Username'];
	$friend = array();
	$friend = $_POST['friendlist'];
	$groupname = $_POST['groupName'];
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	$counter = 0;
	while($counter < count($friend)){
		if(!empty($friend[$counter])){
			$query = sprintf("INSERT INTO groups(name,creatorusername,memberusername) VALUES ('%s', '%s', '%s')",
				pg_escape_string($groupname),
				pg_escape_string($user),
				pg_escape_string($friend[$counter]));
				$result = pg_query($conn, $query);
		}
		$counter++;
	}	
?>
