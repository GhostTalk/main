#!/usr/local/bin/php

<?php
	$bool = false;
	if(($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['action']))):
		$bool = true;
		if(isset($_POST['Username'])) {
			$username = $_POST['Username'];
		}
		
		if(isset($_POST['Password'])) {
			$password = $_POST['Password'];
		}
		
		if(isset($_POST['RPassword'])) {
			$Rpassword = $_POST['RPassword'];
		}
		
		if(isset($_POST['Email'])) {
			$email = $_POST['Email'];
		}
		
		if(isset($_POST['First'])) {
			$first = $_POST['First'];
		}
		
		if(isset($_POST['Last'])) {
			$last = $_POST['Last'];
		}
		
		//Checking Username is filled,correct, and not taken
		if($username === '' || !preg_match('/^[a-z0-9.-_]+$/', $username)){
			$errUser = '<div class ="error">Please enter a valid username</div>';
			$bool=false;
		}

		//Checking email is filled,correct, and not taken
		if($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errEmail = '<div class="error">Please enter a valid e-mail</div>';
			$bool=false;
		}

		//checking password is valid and that the passwords match
		if($password === '' || !preg_match('/^[a-z0-9.-_]+$/', $password)){
			$errPass ='<div class="error">Please enter a valid password</div>';	
			$bool=false;
		}
	
		if($password !== $Rpassword){
			$errPassMatch = '<div class="error">The passwords do not match</div>';
			$bool=false;
		}

		//Checking first name is filled and correct
		if($first === ''||!preg_match('/^[A-Za-z]+$/', $first)){
			$errFirst = '<div class="error">Please enter a valid first name</div>';
			$bool=false;
		}

		if(!preg_match('/^[A-Za-z]+$/', $first)){
			$errFirstValid = '<div class="error">Sorry, your first name is not valid</div>';
			$bool=false;
		}
		
		//Checking last name is filled and correct
		if($last === '' ||!preg_match('/^[A-Za-z]+$/', $last)){
			$errLast = '<div class="error">Please enter a valid last name</div>';
			$bool=false;
		}
	endif;//form submitted
	
	return $bool;
?>