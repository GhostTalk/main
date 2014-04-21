#!/usr/local/bin/php
<?php
	session_start();
	$user = $_SESSION['Username'];
	$member = $_POST['member'];
	$group = $_SESSION['group'];
	
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	
	$query = sprintf("DELETE FROM groups WHERE name = '%s' AND creatorusername = '%s' AND memberusername = '%s'",
		pg_escape_string($group),
		pg_escape_string($user),
		pg_escape_string($member));
	$result = pg_query($conn, $query);
?>
