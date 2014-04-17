#!/usr/local/bin/php

<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' href='Search.css'/>
		<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
		<script src="http://thecodeplayer.com/uploads/js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function(){
				$("#accordian h3").click(function(){
					$("#accordian ul ul").slideUp();

					if(!$(this).next().is(":visible")) {
						$(this).next().slideDown();
					}
				});
			});
		</script>
	</head>
	<body>
		<div id="accordian">
			<ul>
				<li>
					<h3 id='home'>Home</h3>
					<script>
						$('#home').on("click", function(e) {
							window.location.href="HomePage.php";
						});
					</script>
				</li>
				<li>
					<h3>Friends List</h3>
				</li>
				<li>
					<h3 id="Groups">Groups</h3>
					<ul id="GroupsList">
						<script>
							jQuery(document).ready(function() {
								jQuery("#Groups").on("click", function(e) {									
									jQuery.ajax({
										type		: 'POST',
										url			: 'get_groups.php',
										dataType	: 'json'
									})

									.done(function(result) {
										jQuery('#GroupsList').empty();

										var counter=0;
										jQuery.each(result, function(index, value) {
											jQuery('#GroupsList').append(value.name);
										});
									})

									.fail(function() {
										jQuery('#GroupsList').empty();
										jQuery('#GroupsList').append('Error loading groups.');
									});
								});
							});
						</script>
					</ul>
				</li>
				<li>
					<h3>Search</h3>
				</li>
				<li>
					<h3>Requests</h3>
				</li>
			</ul>
		</div>
		<div id="mainlist" style="overflow:auto">
			<div id="title">
				<h1>REQUESTS</h1>
			</div>
			<div id="search">
				<form id="searchform">
					<input name="username" class="options" type="checkbox" value="username" id="username">Username</input>
					<input name="eml" class="options" type="checkbox" value="email" id="eml">Email</input>
					<input name="first" class="options" type="checkbox" value="first" id="first">First Name</input>
					<input name="last" class="options" type="checkbox" value="last" id="last">Last Name</input>
					<input name="bday" class="options" type="checkbox" value="bday" id="bday">Birthday</input>
					<input name="cy" class="options" type="checkbox" value="city" id="cy">City</input>
					<input name="sex" class="options" type="checkbox" value="gender" id="sex">Gender</input>
					<div class="felements" id="uname1"></div>
					<div class="felements" id="email1"></div>
					<div class="felements" id="fname1"></div>
					<div class="felements" id="lname1"></div>
					<div class="felements" id="birthday1"></div>
					<div class="felements" id="city1"></div>
					<div class="felements" id="gender1"></div>
				</form>

				<script>
					$(document).ready(function() {
						$(".options").click(function(e) {
							//alert(e.target.value);
							if(e.target.value == "username") {
								if($('#username').attr("checked"))
									$('#uname1').append("<label for='uname'>Username: </label><input type='text' id='uname' name='uname'></input>");
								else
									$('#uname1').empty();
							} else if(e.target.value == "city") {
								if($('#cy').attr("checked"))
									$('#city1').append("<label for='city'>City: </label><input type='text' id='city' name='city'></input>");
								else
									$('#city1').empty();
							} else if(e.target.value == "email") {
								if($('#eml').attr("checked"))
									$('#email1').append("<label for='email'>Email: </label><input type='text' id='email' name='email'></input>");
								else
									$('#email1').empty();
							} else if(e.target.value == "first") {
								if($('#first').attr("checked"))
									$('#fname1').append("<label for='fname'>First Name: </label><input type='text' id='fname' name='fname'></input>");
								else
									$('#fname1').empty();
							} else if(e.target.value == "last") {
								if($('#last').attr("checked"))
									$('#lname1').append("<label for='lname'>Last Name: </label><input type='text' id='lname' name='lname'></input>");
								else
									$('#lname1').empty();
							} else if(e.target.value == "bday") {
								if($('#bday').attr("checked"))
									$('#birthday1').append('<label for="Birthday">Birthday: </label><select name="dob_month" id="dob_month" class="input_pulldown"><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06" selected="selected">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select><select name="dob_day" id="dob_day" class="input_pulldown"><option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05" selected="selected">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option> </select><select name="dob_year" id="dob_year" class="input_pulldown"><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><				option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970" selected="selected">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1				955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="19				25">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option></select>');
								else
									$('#birthday1').empty();
							} else if(e.target.value == "gender") {
								if($('#sex').attr("checked"))
									$('#gender1').append("<label for='gender'>Gender: </label><input type='radio' value='M' id='gender' name='gender'>Male</input><input type='radio' value='F' id='gender'>Female</input>");
								else
									$('#gender1').empty();
							}
							if($("input:checked").length > 0 && $('#action').length == 0)
								$("#searchform").append("<button type='Submit' id='action'>Search</button>");
							else if(!($("input:checked").length>0))
								$('#action').remove();
						});

						$("#searchform").submit(function(e) {
							$.ajax({
								type	: 'POST',
								url		: 'searchUsers.php',
								data	: $('#searchform').serialize(),
								dataType: 'json'
							})

							.done(function(data) {
								$('#results').empty();
								$.each(data, function(index, value) {
									$('#results').append(value);
								});
							})

							.fail(function() {
								$('#results').empty();
								$('#results').append("<p>An error was encountered while searching, please try again.</p>");
							});

							e.preventDefault();
						});
					});
				</script>
			</div>
			<div id="results">
				<script>
					$(document).ready(function() {
						$(document).ajaxComplete(function () {
							$('.request').on("click", function(e) {
								alert(e.target.id);
							});
						});
					});
				</script>
			</div>
		</div>
	</body>
</html>
