#!/usr/local/bin/php
<?php
	session_start();
	
	$user = $_SESSION['Username'];
	$friend = array();
	$friend = $_POST['friendlist'];
	$group = $_SESSION['group'];
	
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	
	$counter = 0;
	while($counter < count($friend)){
		if(!empty($friend[$counter])){
			$query = sprintf("INSERT INTO groups(name,creatorusername,memberusername) VALUES ('%s', '%s', '%s')",
				pg_escape_string($group),
				pg_escape_string($user),
				pg_escape_string($friend[$counter]));
			$result = pg_query($conn, $query);
		}
		$counter++;
	}
	
	//unset($_SESSION['group']);
?>
