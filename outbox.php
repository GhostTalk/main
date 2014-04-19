#!/usr/local/bin/php

<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");

	$user = $_SESSION['Username'];
	$query = sprintf("SELECT * FROM %s_messages_sent ORDER BY postTime DESC",
		$user);
	$result = pg_query($conn, $query);

	$message = array();
	$counter = 0;

	//Loop through all rows in query and echo their values into the inbox div
	while($row = pg_fetch_assoc($result)) {
		$expires = $row['expiration']/1000;
		if($row['pic'] == "f")
			$message[$counter] = "<div class='sentbox'><img class='save' src='".$row['picture']."' width='100' height='100'><p id='sender'>".$row['receiverusername']."</p><p id='posttime'>".substr($row['posttime'], 0, 16)."</p><p id='expirationtime'>".$expires."</p><div class ='dialog'>".$row['body']."</div></div>";
		else
			$message[$counter] = "<div class='sentbox'><img class='save' src='".$row['picture']."' width='100' height='100'><p id='sender'>".$row['receiverusername']."</p><p id='posttime'>".substr($row['posttime'], 0, 16)."</p><p id='expirationtime'>".$expires."</p><div class ='dialog'><img src='".$row['body']."' height='50' width='50'></div></div>";
		$counter++;
	}

	echo json_encode($message);
?>
