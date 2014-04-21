#!/usr/local/bin/php

<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	$user = $_SESSION['Username'];
	
	$query = sprintf("SELECT username, firstname, lastname, picture FROM %s_groups WHERE name='%s'",
		pg_escape_string($user),
		pg_escape_string($_POST['group']));
	
	$result = pg_query($conn, $query);
	
	$list = array();
	$counter = 0;
	
	while($row = pg_fetch_assoc($result)) {
		$list[$counter] = "<div class='groupmember' id='groupmember$counter'><img src='" . $row['picture'] . "' height='100px' width='100px' /><p id='name'>" . $row['firstname'] . " " . $row['lastname'] . "</p><p id='mem'>" . $row['username'] . "</p><button class='removemember'>Remove</button></div>";
		$counter++;
	}

	echo json_encode($list);
?>
