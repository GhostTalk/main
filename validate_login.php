#!/usr/local/bin/php

<?php
	$contents = file_get_contents('kwLGY7rgDt9IiLtLe36Q0iA2YpDiNiuM5hoYiX9lpvmnGSFbTyG49I5wbLovydcGFD11seSetnzUuBhb.txt');
	$jsond = json_decode($contents, true);
	$conn = pg_connect('host='.$jsond['database']['host'].' user='.$jsond['database']['user'].' password='.$jsond['database']['password'].' dbname='.$jsond['database']['dbname']);
	$username = pg_escape_string($_POST['Username']);
	
	$query = sprintf("SELECT lasttime FROM Security WHERE username='%s'",
		$username);
	$result = pg_fetch_assoc(pg_query($conn, $query));
	if($result['lasttime']) {
		$elapsed = strtotime($result['lasttime']);
		$elapsed = time() - $elapsed;
		if(($elapsed/60)>10) {
			$query = sprintf("UPDATE Security SET lasttime = NULL, attempts=0 WHERE username='%s'",
				$username);
			pg_query($conn, $query);
		}
	}
	
	$query = sprintf("SELECT locked FROM Security WHERE username='%s'",
			$username);
	$result = pg_fetch_assoc(pg_query($conn, $query));
	if($result && $result['locked'] == 't') {
		$message="Your account has been locked.  Check your email for instructions on how to unlock account.";
		echo json_encode($message);
		exit();
	}
	
	$query = sprintf("SELECT password FROM GTUser WHERE username='%s'",
		$username);
	$result = pg_fetch_assoc(pg_query($conn, $query));
	
	if($result && crypt($_POST['Password'], $result['password']) == $result['password']) {
		session_start();
		$_SESSION['Username'] = $_POST['Username'];
		$message='true';
		echo json_encode($message);
		exit();
	} else {
		$query = sprintf("SELECT attempts FROM Security WHERE username='%s'",
			$username);
		$result = pg_fetch_assoc(pg_query($conn, $query));
		$attempts = intval($result['attempts']) + 1;
		
		$now = new DateTime;
		$now = $now->format('Y-m-d H:i:s');
		if($_POST['timezone']>=0)
			$now = $now . " +" . $_POST['timezone'];
		else
			$now = $now . " " . $_POST['timezone'];
		
		$query = sprintf("UPDATE Security SET lasttime='%s', attempts=%s WHERE username='%s'",
			$now,
			$attempts,
			$username);
		pg_query($conn, $query);
		
		if($attempts > 5) {
			$query = sprintf("UPDATE Security SET locked=true WHERE username='%s'",
				$username);
			pg_query($conn, $query);
			
			$message="This account has been locked.  Check your email for further instructions.";
			echo json_encode($message);
			exit();
		} else {
			$message="The username entered does not exist or your password is incorrect. Try again.";
			echo json_encode($message);
			exit();
		}
	}
?>
