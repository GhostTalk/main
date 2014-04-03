<?php
if(isset($_POST['Username'])) { $username = $_POST['Username'];}
if(isset($_POST['Password'])) { $password = $_POST['Password'];}
if(isset($_POST['RPassword'])) { $Rpassword = $_POST['RPassword'];}
if(isset($_POST['Email'])) { $email = $_POST['Email'];}
if(isset($_POST['First'])) { $first = $_POST['First'];}
if(isset($_POST['Last'])) { $last = $_POST['Last'];}
if(isset($_POST['gender'])) { $gender = $_POST['gender'];}

$errors = array();
$data = array();

//Checking Username is filled,correct, and not taken
if($username === '' || !preg_match('/^[a-z0-9.-_]+$/', $username)){
	$errors['Username'] = 'A valid username is required';
}

//Checking email is filled,correct, and not taken
if($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)){
	$errors['Email'] = 'A valid email is required';
}

//checking password is valid and that the passwords match
if($password === '' || !preg_match('/^[a-z0-9.-_]+$/', $password)){
	$errors['password'] = 'A valid password is required';
}

if($password != $Rpassword){
	$errors['passwordMatch'] = 'Passwords do not match';
}

//Checking first name is filled and correct
if($first === ''||!preg_match('/^[A-Za-z]+$/', $first)){
	$errors['First'] = 'A valid first name is required';
}

//Checking last name is filled and correct
if($last === '' ||!preg_match('/^[A-Za-z]+$/', $last)){
	$errors['Last'] = 'A valid last name is required';
}

if(empty($_POST['gender'])){
	$errors['gender'] = 'Gender is required';
}

if(!empty($errors)){

	$data['success'] = false;
	$data['errors'] = $errors;
}

else{
	//There are no errors
	//Insert Form data into database here
	
	include 'create_account.php';
	$data['success'] = true;
	$data['message'] = 'Form has been submitted';
}

echo json_encode($data);
?>
	
