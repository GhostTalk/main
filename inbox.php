#!/usr/local/bin/php

<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");

	$user = $_SESSION['Username'];
	$query = sprintf("SELECT * FROM %s_messages_received WHERE read=false OR expirationTime IS NULL ORDER BY postTime DESC",
		$user);
	$result = pg_query($conn, $query);
	
	$message = array();
	$counter = 0;
	
	//Loop through all rows in query and echo their values into the inbox div
	while($row = pg_fetch_assoc($result)) {
		if($row['expirationtime']) {
			$expires = $row['expirationtime']/1000;
			$expires2 = $row['expirationtime']/1000;
			$expires = $expires . ' sec';
		} else {
			$expires = 'Unlimited';
			$expires2=00;
		}
		
		if($row['pic'] == "f") {
			$message[$counter] = "<div class='messagebox'> <div id='expires'>".$expires."</div><img class='save' src='http://icons.iconarchive.com/icons/cornmanthe3rd/plex/512/Communication-gmail-icon.png' width='100' height='100'><p id='sender'>".$row['creatorusername']."</p><p id='posttime'>".substr($row['posttime'], 0, 16)."</p><p id='postt' style='display:none'>".$row['posttime']."</p><p id='expirationtime' style='display:none'>".$row['expirationtime']."</p><div class ='dialog' style='display:none'><p id='time'>00:".$expires2."</p>".$row['body']."</div></div>";
		} else {
			$message[$counter] = "<div class='messagebox'> <div id='expires'>".$expires."</div><img class='save' src='http://icons.iconarchive.com/icons/cornmanthe3rd/plex/512/Communication-gmail-icon.png' width='100' height='100'><p id='sender'>".$row['creatorusername']."</p><p id='posttime'>".substr($row['posttime'], 0, 16)."</p><p id='postt' style='display:none'>".$row['posttime']."</p><p id='expirationtime' style='display:none'>".$row['expirationtime']."</p><div class ='dialog' style='display:none'><p id='time'>00:".$expires2."</p><img src='".$row['body']."' /></div></div>";
		}
		$counter++;
	}

	echo json_encode($message);
?>
