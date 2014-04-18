#!/usr/local/bin/php

<?php
	session_start();
	
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk");
	$query = sprintf("SELECT picture FROM GTUser WHERE username='%s'",
		pg_escape_string($_SESSION['Username']));
	
	$result = pg_query($conn, $query);
	
	$path = pg_fetch_assoc($result);
	$path = $path['picture'];
	
	$tag = "<img src='$path' height='100px' width='100px' id='f3' />";
	
	$array = array();
	$array['tag'] = $tag;
	
	echo json_encode($array);
?>
