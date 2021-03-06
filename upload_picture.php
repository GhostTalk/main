#!/usr/local/bin/php

<?php
	if(empty($_FILES['picture']['name'])) {
		header("Location: http://www.cise.ufl.edu/~cmoore");
		exit();
	}
	$user = $_POST['Username'];
	
	$base_path = "Pictures/$user";
	
	if(!is_dir($base_path)) {
		$old = umask(0);
		mkdir($base_path, 0777);
		umask($old);
	}
	
	$path = $_FILES['picture']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	
	$target = $base_path . "/" . $user . "profilepictureavatatabc." . $ext;
	
	//echo "<script>alert('Target: ". $target ."');</script>";
	//echo "<script>alert('Name: ". $_FILES['picture']['name'] ."');</script>";
	//echo "<script>alert('Errors: ". $_FILES['picture']['error'] ."');</script>";
	
	$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');
	
	if(move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
		//echo "<script>alert('Uploaded: True');</script>";
		$query = sprintf("UPDATE GTUser SET picture='%s' WHERE username='%s'",
			pg_escape_string($target),
			pg_escape_string($user));
			
		$result = pg_query($conn, $query);
		
		if($result) {
			header("Location: http://www.cise.ufl.edu/~cmoore");
			exit();
		}
		else {
			echo "Error changing picture path in database.";
			$deleteviews = sprintf("DROP VIEW %s_groups;
				DROP VIEW %s_messages_received;
				DROP VIEW %s_requests_received;
				DROP VIEW %s_requests_sent;
				DROP VIEW %s_messages_sent;",
					$user,
					$user,
					$user,
					$user,
					$user);
			
			$deleteAcc = sprintf("DELETE FROM GTUser WHERE username='%s';",
				$user);
			
			$result = pg_query($conn, $deleteviews);
			$result = pg_query($conn, $deleteAcc);
			
			header("Location: signup.php?error=picture");
			exit();
		}
	} else {		
		//echo "<script>alert('Uploaded: False');</script>";
		$deleteviews = sprintf("DROP VIEW %s_groups;
			DROP VIEW %s_messages_received;
			DROP VIEW %s_requests_received;
			DROP VIEW %s_requests_sent;
			DROP VIEW %s_messages_sent;",
				$user,
				$user,
				$user,
				$user,
				$user);
			
		$deleteAcc = sprintf("DELETE FROM GTUser WHERE username='%s';",
			$user);
			
		$result = pg_query($conn, $deleteviews);
		$result = pg_query($conn, $deleteAcc);
			
		header("Location: signup.php?error=picture");
		exit();
	}
?>
