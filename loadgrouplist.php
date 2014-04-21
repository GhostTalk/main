#!/usr/local/bin/php
<?php
	session_start();
	
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	$query = sprintf("SELECT DISTINCT name FROM %s_groups",
			$_SESSION['Username']);

	$result = pg_query($conn, $query);
	
	$message = array();
	$message[0] = "<option></option>";
	$counter = 1;

	while ($row = pg_fetch_assoc($result)) {
		$message[$counter] = "<option>".$row['name']."</option>";
		$counter++;
	}

    echo json_encode($message);
?>
