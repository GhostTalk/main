<?php
	$conn = pg_connect('user=cmoore host=postgres.cise.ufl.edu dbname=ghosttalk password=calvin#1');
	$query = sprintf("SELECT password FROM GTUser WHERE username='%s'",
		pg_escape_string($_POST(['Username'])));
	$result = pg_fetch_assoc(pg_query($conn, $query));
	
	if($row && crypt($_POST(['Password']), $row['password']) == $result['password']) {
		
	} else {
		$doc = new DomDocument;
		$doc->Load('SignIn.html');
		getElementById("Error").write("Username and/or password incorrect.");
	}
?>