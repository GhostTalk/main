#!/usr/local/bin/php

<?php
	function validate_email($email) {
		$query = sprintf("SELECT email FROM GTUser WHERE email='%s'",
			pg_escape_string($email));
		$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');

		$result = pg_query($conn, $query);

		if($result && pg_fetch_result($result, 'email') == $email)
			return false;
		else
			return true;
	}
	
	function validate_username($username) {
		$query = sprintf("SELECT username FROM GTUser WHERE username ILIKE '%s'",
			pg_escape_string($_POST['Username']));
		$conn = pg_connect('host=postgres.cise.ufl.edu user=cmoore password=calvin#1 dbname=ghosttalk');

		$result = pg_query($conn, $query);

		if($result && pg_fetch_result($result,'username') == $_POST['Username'])
			return false;
		else if(!$result)
			return false;
		else
			return true;
	}
	
	$errors = array();
	$data = array();
	$err = false;
	
	if(!empty($_POST['Username'])) {
		$username = $_POST['Username'];
	} else {
		$errors['Username'] = '*Username required.';
		$err = true;
	}

	if(!empty($_POST['Password'])) {
		$password = $_POST['Password'];
	} else {
		$errors['Password'] = 'Password required.';
		$err = true;
	}

	if(!empty($_POST['RPassword'])) {
		$Rpassword = $_POST['RPassword'];
	} else {
		$err = true;
	}

	if(!empty($_POST['Email'])) {
		$email = $_POST['Email'];
	} else {
		$errors['Email'] = '*Email required.';
		$err = true;
	}

	if(!empty($_POST['First'])) {
		$first = $_POST['First'];
	} else {
		$errors['First'] = '*Full name required.';
		$err = true;
	}

	if(!empty($_POST['Last'])) {
		$last = $_POST['Last'];
	} else {
		$errors['Last'] = '*Full name required.';
		$err = true;
	}

	if(!empty($_POST['gender'])) {
		$gender = $_POST['gender'];
	} else {
		$errors['gender'] = '*Gender is required';
		$err = true;
	}

	//Checking Username is filled,correct, and not taken
	if(!preg_match('/^[A-Za-z0-9_]+$/', $username)){
		$errors['Username'] = 'A valid username is required';
		$err = true;
	}
	
	if(!validate_username($username) && !empty($_POST['Username'])) {
		$errors['Username'] = 'This username is already taken.';
		$err = true;
	}

	//Checking email is filled,correct, and not taken
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errors['Email'] = 'A valid email is required';
		$err = true;
	}
	
	if(!validate_email($email) && !empty($_POST['Email'])) {
		$errors['Email'] = 'This email is already in use.';
		$err = true;
	}

	//Confirm password is the same as the retyped password.
	if($password != $Rpassword){
		$errors['passwordMatch'] = 'Passwords do not match';
		$err = true;
	}

	//Checking first name is filled and correct
	if(!preg_match('/^[A-Za-z]+$/', $first)){
		$errors['First'] = 'A valid first name is required';
		$err = true;
	}

	//Checking last name is filled and correct
	if(!preg_match('/^[A-Za-z]+$/', $last)){
		$errors['Last'] = 'A valid last name is required';
		$err = true;
	}

	if($err){
		$data['success'] = false;
		$data['errors'] = $errors;
	} else{
		//There are no errors
		//Insert Form data into database here

		$data['success'] = true;
	}

	echo json_encode($data);
?>
	
