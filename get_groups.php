#!/usr/local/bin/php

<?php
	session_start();
	$query = sprintf("SELECT DISTINCT ON (name) name FROM %s_groups WHERE name<>'Friends';",
		$_SESSION['Username']);
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	
	$result = pg_query($conn, $query);
	echo json_encode($result = pg_fetch_all($result));
?>