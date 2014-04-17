<?php
	//session_start();
	
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	$query = sprintf("SELECT memberUsername FROM Groups WHERE name='Friends' AND creatorUsername='%s'",
		pg_escape_string("cmoore"));//$_SESSION['Username']));

	$result = pg_query($conn, $query);
	$message = array();
	$counter = 0;
		
		while ($row = pg_fetch_row($result)) {
		$message[$counter] = "<option>$row[0]</option>";
		$counter++;
 	  
		}
 	 echo json_encode($message);
?>
