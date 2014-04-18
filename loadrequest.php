<?php

	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");

	$user = $_SESSION['Username'];
	$query = sprintf("SELECT * FROM %s_requests_received ORDER BY postTime DESC",
		$user);
	$result = pg_query($conn, $query);

	$request = array();
	$counter = 0;

	//Loop through all rows in query and echo their values into the inbox div
	while($row = pg_fetch_assoc($result)) {
	$request[$counter] = "<div class='request'><p id='user'>".$row['username']."</p>has sent you a friend request <button class='accept' type='button'>Accept</button><button class='decline' type='button'>Decline</button></div>";
	$counter++;
	}

	echo json_encode($request);



?>
