#!/usr/local/bin/php

<!DOCTYPE HTML>
<html>
	<head>
		<link rel='stylesheet' href='SignUp.css'/>
		<script src='script.js'></script>
		<title>Sign Up for GhostTalk</title>
	</head>
	<body>
		<?php
			if(isset($_GET['error'])) {
				if($_GET['error'] === 'connection')
					echo "<p>There was an error connecting to the server.  Please try again.</p>";
				else
					echo "<p>Could not create user account.<br>Error: ".$_GET['error']."</p><p>Please try again.</p>";
			}
		?>
		<form action="create_accounttest.php" method="post">
		<div id = "required">
			<table>
				<tr>
					<td>
						<label for="Username">Username: </label> <input type="text" name="Username" id="Username" maxlength="15">
					</td>
				</tr>
				<tr>
					<td>
						<label for="Password">Password: </label> <input type="password" name="Password" id="Password">
					</td>
				</tr>
				<tr>
					<td>
						<label for="RPassword">Retype Password: </label> <input type="password" name="RPassword" id="RPassword">
					</td>
				</tr>
				<tr>
					<td>
						<label for="Email">Email: </label> <input type="Email" name="Email" id="Email">
					</td>
				</tr>
				<tr>
					<td>
						<label for="First">First Name: </label> <input type="text" name="First" id="First">
					</td>
				</tr>
				<tr>
					<td>
						<label for="Last">Last Name: </label> <input type="text" name="Last" id="Last">
					</td>
				</tr>
			</table>
		</div>
		<div id = "notrequired">
			<table>
				<tr>
					<td>
						<label for="City">In what city are you currently living? </label><input type="text" name="City" id="City">
					</td>
				</tr>
				<tr>
					<td>
						<label for="Bday">When were you born?</label> <input type="text" name="First" id="First">
					</td>
				</tr>
				<tr>
					<td>
						<!---Sex--->
					</td>
				</tr>
				<tr>
					<td>
						<!---Picture--->
					</td>
				</tr>
			</table>
			<button type="Submit" name="Submit">Submit</button>
		</div>
		</form>
	</body>
</html>
