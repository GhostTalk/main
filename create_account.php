#!/usr/local/bin/php

<?php
	$validChars = array('0','1','2', '3', '4', '5', '6', '7', '8', '9','?','-','_', '/', '%','<', '>', ',', '.', '|', '[', ']', '{', '}', '`', '~', '!', '@', '#', '$', '^', '&', '*', '(', ')', 'A',  'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
	$validCharsCount = count($validChars);

	$str = '';
	for ($i=0; $i<86; $i++) {
		$str .= $validChars[rand(0,$validCharsCount - 1)];
	}

	$salt = '$6$rounds=5000'.$str; 
	$password = crypt($_POST['Password'], salt);
	
	if(!ctype_alnum($_POST['Username'])) {
		header('Location = http://cise.ufl.edu/~cmoore/signup.php?error=badusername');
	}
	
	$createuser = sprintf("INSERT INTO GTUser(username, password, firstName, lastName, email, currentCity, gender, age) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%i');",
		pg_escape_string($_POST['Username']),
		pg_escape_string($password),
		pg_escape_string($_POST['First']),
		pg_escape_string($_POST['Last']),
		pg_escape_string($_POST['Email']),
		pg_escape_string($_POST['City']),
		pg_escape_string($_POST['Gender']),
		$_POST['age']);
	
	$conn = pg_connect('host=postgres.cise.ufl.edu username=cmoore password=calvin#1 dbname=ghosttalk');
	
	$result = pg_query($conn, $createuser);
	
	if($result) {
		$createviews = sprintf("CREATE MATERIALIZED VIEW %s_groups AS SELECT memberUsername FROM Groups WHERE '%s'=creatorUsername; CREATE VIEW %s_received_view AS SELECT senderUsername, postTime, expirationTime, body FROM Posts WHERE receiverUsername = '%s'; CREATE VIEW %s_requests_view AS SELECT name, username FROM GTUser JOIN Requests ON senderUsername=username WHERE receiverUsername = '%s'; CREATE VIEW %s_sent_requests AS SELECT name, username FROM GTUser JOIN Requests ON receiverUsername=username WHERE senderUsername='%s'; CREATE VIEW %s_sent_view AS SELECT receiverUsername, postTime, expirationTime, body FROM Posts WHERE senderUsername = '%s';",
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']),
			pg_escape_string($_POST['Username']));
			
		$result = pg_query($conn, $createviews);
		
		if($result)
			header('Location = http://cise.ufl.edu/~cmoore/');
		else{
			if(pg_connection_status($conn) === PGSQL_CONNECTION_BAD){
				$deleteacc = sprintf("DELETE FROM GTUser WHERE username='%s'",
					pg_escape_string($_POST['Username']));
				
				pg_query($conn, $deleteacc);
				
				header('Location = http://cise.ufl.edu/~cmoore/signup.php?error=connection');
			} else {
				$deleteacc = sprintf("DELETE FROM GTUser WHERE username='%s'",
					pg_escape_string($_POST['Username']));
				
				pg_query($conn, $deleteacc);
				
				header('Location = http://cise.ufl.edu/~cmoore/signup.php?error=' . pg_result_status($result)); 
			}	
		}
	}
	else {
		if(pg_connection_status($conn) === PGSQL_CONNECTION_BAD){
			header('Location = http://cise.ufl.edu/~cmoore/signup.php?error=connection');
		} else {
			header('Location = http://cise.ufl.edu/~cmoore/signup.php?error=' . pg_result_status($result)); 
		}
	}
?>
