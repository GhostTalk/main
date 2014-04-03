#!/usr/local/bin/php

<?php
	$query = sprintf("SELECT * FROM %s_messages_received",
		$_POST['Username']);
	$conn = pg_connect("host=cise.postgres.ufl.edu username=cmoore password=calvin#1 dbname=ghosttalk");
	
	$result = pg_query($conn, $query);
	
	echo json_encode(pg_fetch_all($result));
?>