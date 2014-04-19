#!/usr/local/bin/php

<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	$user = $_SESSION['Username'];
	
	$query = sprintf("SELECT memberusername FROM groups WHERE name='%s' AND creatorUsername='%s'",
		pg_escape_string($_POST['group']),
		pg_escape_string($user));
	
	$result = pg_query($conn, $query);
	
	$list = array();
	$counter = 0;
	
	while($row = pg_fetch_assoc($result)) {
		$list[$counter] = "<div>".$row['memberusername']."</div>";
		$counter++;
	}

	echo json_encode($list);
?>
