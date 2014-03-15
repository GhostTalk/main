<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<title>
			GhostTalk
		</title>
	</head>
	<body>
		<?php
			if($_GET['error']) {
				if($_GET['error'] === 'connection')
					echo "<p>There was an error connecting to the server.  Please try again.</p>";
				else
					echo "<p>Could not create user account.  Error: " . $_GET['error'] . "</p>";
			}
		?>
		<div class = "formstyle">
		<form action="create_account.php" method="post">
		  <fieldset>
			<legend>Create an account</legend>
			Choose your username 
			<input type="text" name="username"/>
			<br>
			Create a password 
			<input type="text" name="password"/>
			<br>
			Confirm your password
			<input type="text" name="password"/>
			<br>
			Firstname
			<input type="text" name="firstname"/>
			<br>
			Last name 
			<input type="text" name="lastname"/>
			<br>
			Email
			<input type="text" name="email"/>
			<br>
			Birthday
			<input type="text" name="birthday"/>
			<br>
			City
			<input type="text" name="city"/>
			<br>
			Male
			<input type="radio" name="gender" value="Male"/> 
			Female
			<input type="radio" name="gender" value="Female"/>
			<br>
			<input type="submit" value="Submit"/>
		   </fieldset>
		</form> 
		</div>
	</body>
<html>
