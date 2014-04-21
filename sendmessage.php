#!/usr/local/bin/php
<?php
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");
	
	session_start();
	
	$user = $_SESSION['Username'];
	$returnvals = array();
	$sent = true;
	$friend = array();
	$group = array();

	$friend = $_POST['friendlist'];
	if(count($friend) !== count(array_unique($friend))) {
		$returnvals['sent'] = false;
		$returnvals['message'] = "One or more users are repeated.  Choose different users.";
		echo json_encode($returnvals);
		return;
	}
	
	$group = $_POST['grouplist'];
	$counter = 0;
	$t = count($group);
	while($counter < count($group)) {
		$query = sprintf("SELECT username FROM %s_groups WHERE name='%s'",
			$_SESSION['Username'],
			pg_escape_string($group[$counter]));
		
		$result = pg_query($conn, $query);
		
		while($row = pg_fetch_assoc($result)) {
			$friend[$t] = $row['username'];
			$t++;
		}
		
		$counter++;
	}

	$pic = $_POST['picture'];
	$expiration = $_POST['expiration'];

	if($expiration==0)
		$expiration = 'NULL';

	if($pic=="false") {
		$message = $_POST['message'];
	} else {
		$target_path = "Pictures/$user/" . basename($_FILES['picmessage']['name']);
		echo $target_path;
		if(!is_dir("Pictures/$user")) {
			$old = umask(0);
			mkdir("Pictures/$user", 0777);
			umask($old);
		}
								//$t = $_FILES['picmessage']['type'];
								//if(!($t)) {
								//			$returnvals['sent'] = false;
								//			$returnvals['message'] = "Unacceptable file format.  Upload only images.";
								//			echo json_encode($returnvals);
								//			return;
								//}
		if(!(move_uploaded_file($_FILES['picmessage']['tmp_name'], $target_path))) {
			$returnvals['sent'] = false;
			$returnvals['message'] = "Error uploading image.  Please try again.";
			echo json_encode($returnvals);
			return;
		}
		$message = $target_path;
	}

	$date = date('Y-m-d H:i:s T');

	$counter=0;
	while($counter < count($friend)) {
		if(!empty($friend[$counter])) {
			$query = sprintf("INSERT INTO Posts(posttime, creatorUsername, receiverUsername, expirationTime, body, pic) VALUES ('%s', '%s', '%s', %s, '%s', %s)",
				pg_escape_string($date),
				pg_escape_string($user),
				pg_escape_string($friend[$counter]),
				$expiration,
				pg_escape_string($message),
				pg_escape_string($pic));
				$result = pg_query($conn, $query);
				if(!$result)
					$sent=false;
		}
		$counter++;
	}

	$friendsemails = array();
	$counter=0;
	$count=0;
	while($counter < count($friend)) {
		if(!empty($friend[$counter])) {
		$query = sprintf("SELECT email FROM GTUser WHERE username='%s'",
			pg_escape_string($friend[$counter]));
			$result = pg_query($conn, $query);
			$friendsemails[$count] = pg_fetch_result($result, 0, 0);
			$count++;
		}
		$counter++;
	}

	sendemail($user, $friendsemails);
	$returnvals['sent'] = $sent;

	if(!$sent)
		$returnvals['message'] = "Error sending messages.  Please try again.";

		echo json_encode($returnvals);

	if($pic=="true") {
		header("Location: HomePage.php");
	}

	function sendemail($user,$friend){
		$subject = 'Message received';
		$emailmessage = $user ." has sent you a message on GhostTalk!\n\nVisit www.cise.ufl.edu/~cmoore/HomePage.php to view it.";
		for($i=0; $i<count($friend);++$i){
			mail($friend[$i],$subject,$emailmessage);
		}
	}
?>
