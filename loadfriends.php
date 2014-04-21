#!/usr/local/bin/php

<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	$user = $_SESSION['Username'];
	$query = sprintf("SELECT * FROM %s_groups WHERE name='Friends'" , pg_escape_string($user));
	
	$result = pg_query($conn, $query);
	
	$list = array();
	$counter = 0;
	
	while($row = pg_fetch_assoc($result)) {
		$list[$counter] = "<div><img src='".$row['picture']."' width='100px' height='100px' /><h4>".$row['username']."</h4><p class=fname>".$row['firstname']. " " .$row['lastname']."</p></div>";
		$counter++;
	}

	echo json_encode($list);
	
?>


