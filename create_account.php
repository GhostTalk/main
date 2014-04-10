#!/usr/local/bin/php

<?php
	function ctype_alnum_portable($text) {
		return (preg_match('~^[0-9a-z_]*$~iu', $text) > 0);
	}
	
	$status = array();
	
	$validChars = array('0','1','2', '3', '4', '5', '6', '7', '8', '9','?','-','_', '/', '%','<', '>', ',', '.', '|', '[', ']', '{', '}', '`', '~', '!', '@', '#', '$', '^', '&', '*', '(', ')', 'A',  'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
	$validCharsCount = count($validChars);

	$str = '';
	for ($i=0; $i<86; $i++) {
		$str .= $validChars[rand(0,$validCharsCount - 1)];
	}

	$salt = '$6$rounds=5000'.$str; 
	$password = crypt($_POST['Password'], salt);
	
	if(!ctype_alnum_portable($_POST['Username'])) {
		header('Location: http://cise.ufl.edu/~cmoore/signup.php?error=badusername');
		exit();
	}
	
	$bdate = $_POST['dob_year'] . '-' . $_POST['dob_month'] . '-' . $_POST['dob_day'];

	if(!isset($_POST['City'])) {
		$createuser = sprintf("INSERT INTO GTUser(username, password, firstName, lastName, email, gender, bdate) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			pg_escape_string($_POST['Username']),
			pg_escape_string($password),
			pg_escape_string($_POST['First']),
			pg_escape_string($_POST['Last']),
			pg_escape_string($_POST['Email']),
			pg_escape_string($_POST['gender']),
			pg_escape_string($bdate));
	} else {
		$createuser = sprintf("INSERT INTO GTUser(username, password, firstName, lastName, email, gender, bdate, currentCity) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			pg_escape_string($_POST['Username']),
			pg_escape_string($password),
			pg_escape_string($_POST['First']),
			pg_escape_string($_POST['Last']),
			pg_escape_string($_POST['Email']),
			pg_escape_string($_POST['gender']),
			pg_escape_string($bdate),
			pg_escape_string($_POST['City']));
	}
	
	$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');
	
	$result = pg_query($conn, $createuser);
	
	if($result) {
		$createviews = sprintf("CREATE VIEW %s_groups AS SELECT username, name, firstname, lastname, picture FROM GTUser JOIN Groups ON username=memberUsername WHERE creatorUsername='%s';
		CREATE VIEW %s_messages_received AS SELECT creatorUsername, picture, postTime, expirationTime, body FROM Posts JOIN GTUser ON creatorUsername=username WHERE receiverUsername = '%s';
		CREATE VIEW %s_requests_received AS SELECT username, firstname, lastname, picture FROM GTUser JOIN Requests ON senderUsername=username WHERE receiverUsername = '%s';
		CREATE VIEW %s_requests_sent AS SELECT username, firstname, lastname, picture FROM GTUser JOIN Requests ON receiverUsername=username WHERE senderUsername='%s';
		CREATE VIEW %s_messages_sent AS SELECT receiverUsername, picture, postTime, expirationTime, body FROM Posts JOIN GTUser ON receiverUsername=username WHERE creatorUsername = '%s';
		CREATE VIEW %s_pictures_sent AS SELECT receiverUsername, picture, postTime, expirationTime, body, filePath FROM Picture JOIN GTUser ON receiverUsername=username WHERE creatorUsername = '%s';
		CREATE VIEW %s_pictures_received AS SELECT creatorUsername, picture, postTime, expirationTime, body, filePath FROM Picture JOIN GTUser ON creatorUsername=username WHERE receiverUsername = '%s';",
			$_POST['Username'],
			pg_escape_string($_POST['Username']),
			$_POST['Username'],
			pg_escape_string($_POST['Username']),
			$_POST['Username'],
			pg_escape_string($_POST['Username']),
			$_POST['Username'],
			pg_escape_string($_POST['Username']),
			$_POST['Username'],
			pg_escape_string($_POST['Username']),
			$_POST['Username'],
			pg_escape_string($_POST['Username']),
			$_POST['Username'],
			pg_escape_string($_POST['Username']));
			
		$result = pg_query($conn, $createviews);
		
		if($result) {
			$status['Redirect'] = 'http://cise.ufl.edu/~cmoore';
		} else{
			$deleteacc = sprintf("DELETE FROM GTUser WHERE username='%s'",
				pg_escape_string($_POST['Username']));
			
			pg_query($conn, $deleteacc);
			
			$status['Redirect'] = 'http://cise.ufl.edu/~cmoore/signup.php?error=' . pg_result_status($result);
		}
	} else {
		$status['Redirect'] = 'http://cise.ufl.edu/~cmoore/signup.php?error=' . pg_result_status($result);
	}
	
	echo json_encode($status);
?>
