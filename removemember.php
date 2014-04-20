#!/usr/local/bin/php
<?php
	session_start();
	$user = $_SESSION['Username'];
	$member = $_POST['member'];
	$group = $_POST['group']
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	
			$query = sprintf("DELETE FROM groups WHERE group = '%s' AND creatorusername = '%s' AND memberusername = '%s')",
			pg_escape_string($group),
			pg_escape_string($user),
			pg_escape_string($member);
			$result = pg_query($conn, $query);




?>
