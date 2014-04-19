<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	$user = $_SESSION['Username'];
	$query = sprintf("SELECT creatorusername,memberusername FROM groups WHERE name='%s'",
			pg_escape_string($_GET['group']));
	$result = pg_query($conn, $query);
	
	$list = array();
	$counter = 0;
	
	while($row = pg_fetch_assoc($result)) {
		$list[$counter] = "<div>".$row['memberuser']."</div>";
		$counter++;
	}

	echo json_encode($list);
?>
