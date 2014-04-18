#!/usr/local/bin/php

<!DOCTYPE HTML>
<html>
	<head>
		<link rel='stylesheet' href='SignUp.css'/>
		<title>Sign Up for GhostTalk</title>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
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
		<form id="signupform">
		<div id = "required">
		<fieldset>
			<table>
				<tr>
					<td>
						<label for="Username">*Username: </label> <input type="text" name="Username" id="Username" maxlength="15">
						<div id="UsernameErr" class="Error"></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for="Password">*Password: </label> <input type="password" name="Password" id="Password">
						<div id="PasswordErr" class="Error"></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for="RPassword">*Retype Password: </label> <input type="password" name="RPassword" id="RPassword">
						<div id="RPasswordErr" class="Error"></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for="Email">*Email: </label> <input type="Email" name="Email" id="Email">
						<div id="EmailErr" class="Error"></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for="First">*First Name: </label> <input type="text" name="First" id="First">
						<div id="FirstErr" class="Error"></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for="Last">*Last Name: </label> <input type="text" name="Last" id="Last">
						<div id="LastErr" class="Error"></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for="Birthday">*Birthday: </label> 
						<select name="dob_month" id="dob_month" class="input_pulldown"> 
						<option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06" selected="selected">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>
						</select>
						<select name="dob_day" id="dob_day" class="input_pulldown">
						<option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05" selected="selected">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option> 
						</select>
						<select name="dob_year" id="dob_year" class="input_pulldown">
						<option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><				option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970" selected="selected">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1				955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="19				25">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="gender">Gender:</label>
						<input type="radio" name="gender" id="gender" value="M"/> Male</input>
						<input type="radio" name="gender" id="gender" value="F"/>Female</input>
						<div id="genderErr" class="Error"></div>
			
					</td>
				<tr>
				<tr>
					<td>
						<label for="City">Current City: </label><input type="text" name="City" id="City">
					</td>
				</tr>
				<tr>
					<td>
					<label for = "picture">Upload a Picture: </label><input type = "file" name = "picture" id = "picture">
					</td>
				</tr>
			</table>
			<button type="Submit" name="action">Submit</button>
			</fieldset>
		</div>
		</form>
		
		<script>
			$(document).ready(function() {
				$("#signupform").submit(function(e){

					$.ajax({
						type   		: 'POST',
						url	   		: 'process.php',
						data   		: $('#signupform').serialize(),
						dataType 	: 'json'
					})
		
					.done(function(data){
						$(".Error").empty();
						
						if(!data.success){
							if(data.errors.Username){
								$('#UsernameErr').append(data.errors.Username);
							}
								
							if(data.errors.Email){
								$('#EmailErr').append(data.errors.Email);
							}
									
							if(data.errors.Password){
								$('#PasswordErr').append(data.errors.Password);
							}
									
							if(data.errors.passwordMatch){
								$('#RPasswordErr').append(data.errors.passwordMatch);
							}
									
							if(data.errors.First){
								$('#FirstErr').append(data.errors.First);
							}
									
							if(data.errors.Last){
								$('#LastErr').append(data.errors.Last);
							}
									
							if(data.errors.gender){
								$('#genderErr').append(data.errors.gender);
							}
						} else {
							$.ajax({
								type   		: 'POST',
								url	   		: 'create_account.php',
								data   		: $('#signupform').serialize(),
								dataType 	: 'json'
							})
							
							.done(function(status) {
								window.location.href = status.Redirect;
							})
							.fail(function(status) {
								window.location.href = status.Redirect;
							});
						}
					})
		
					.fail(function(data){
						alert("Error!");
						//window.location.href = 'http://cise.ufl.edu/~cmoore/signup.php?error=connection';
					});
				
					e.preventDefault();

				});
			});
		</script>
		
	</body>
</html>
