#!/usr/local/bin/php

<?php
	if(isset($_POST['username'])) {
		if(!empty($_POST['uname']))
			$query = sprintf("SELECT * FROM GTUser WHERE username ILIKE '%%%s%%'",
				pg_escape_string($_POST['uname']));
	}
	if(isset($_POST['eml'])) {
		if(!empty($_POST['email'])) {
			if(isset($query)) {
				$query = $query . sprintf(" INTERSECT SELECT * FROM GTUser WHERE email ILIKE '%%%s%%'",
					pg_escape_string($_POST['email']));
			} else {
				$query = sprintf("SELECT * FROM GTUser WHERE email ILIKE '%%%s%%'",
					pg_escape_string($_POST['email']));
			}
		}
	}
	if(isset($_POST['first'])) {
		if(!empty($_POST['fname'])) {
			if(isset($query)) {
				$query = $query . sprintf(" INTERSECT SELECT * FROM GTUser WHERE firstname ILIKE '%%%s%%'",
					pg_escape_string($_POST['fname']));
			} else {
				$query = sprintf("SELECT * FROM GTUser WHERE firstname ILIKE '%s'",
					pg_escape_string($_POST['fname']));
			}
		}
	}
	if(isset($_POST['last'])) {
		if(!empty($_POST['lname'])) {
			if(isset($query)) {
				$query = $query . sprintf(" INTERSECT SELECT * FROM GTUser WHERE lastname ILIKE '%%%s%%'",
					pg_escape_string($_POST['lname']));
			} else {
				$query = sprintf("SELECT * FROM GTUser WHERE lastname ILIKE '%%%s%%'",
					pg_escape_string($_POST['lname']));
			}
		}
	}
	if(isset($_POST['bday'])) {
		$bdate = $_POST['dob_year'] . '-' . $_POST['dob_month'] . '-' . $_POST['dob_day'];
		if(isset($query)) {
			$query = $query . sprintf(" INTERSECT SELECT * FROM GTUser WHERE birthdate='%s'",
				pg_escape_string($bdate));
		} else {
			$query = sprintf("SELECT * FROM GTUser WHERE bdate='%s'",
				pg_escape_string($bdate));
		}
	}
	if(isset($_POST['cy'])) {
		if(!empty($_POST['city'])) {
			if(isset($query)) {
				$query = $query . sprintf(" INTERSECT SELECT * FROM GTUser WHERE currentcity ILIKE '%%%s%%'",
					pg_escape_string($_POST['city']));
			} else {
				$query = sprintf("SELECT * FROM GTUser WHERE currentcity ILIKE '%%%s%%'",
					pg_escape_string($_POST['city']));
			}
		}
	}
	if(isset($_POST['sex'])) {
		if(!empty($_POST['gender'])) {
			if(isset($query)) {
				$query = $query . sprintf(" INTERSECT SELECT * FROM GTUser WHERE gender='%%%s%%'",
					pg_escape_string($_POST['gender']));
			}
		}
	}
	
	$results = array();
	
	if(!empty($query)) {
		$conn = pg_connect("host=postgres.cise.ufl.edu dbname=ghosttalk user=cmoore password=calvin#1");
		
		$result = pg_query($conn, $query);
		
		if($result) {
			$counter = 0;
			while($row = pg_fetch_assoc($result)) {
				$results[$counter] = "<div class='searchresults".$counter."'><img src='".$row['picture']."' width='100' height='100'><p id='un'>".$row['username']."</p><p id='n'>".$row['firstname']." ".$row['lastname']."</p><p id='cc'>".$row['currentcity']."</p><p id='bd'>".$row['bdate']."</p><button type='Submit' id=$counter class='request'>Request Friendship</button></div>";
				$counter++;
			}
		} else {
			$results[0] = "div class='searcherror'><p>No results returned for your search.</p></div>";
		}
	} else {
		$results[0] = "div class='searcherror'><p>No search criteria entered.  Please search again.</p></div>";
	}
	
	echo json_encode($results);
?>
