#!/usr/local/bin/php

<?php
	session_start();
	if(!isset($_SESSION['Username'])) {
		echo '<script>window.location.href="login.html";</script>';
		exit();
	}
?>
	
<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' href='creategroup.css'/>
		<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
		<script src="http://thecodeplayer.com/uploads/js/jquery-1.7.1.min.js" type="text/javascript"></script>
		
		<script>
				$.ajax({
				url		: "loadlist.php",
				dataType: "json"
			})
			.done(function(response) {
				$.each(response, function(index, value) {
					$('#friendlist').append(value);
				});
			});
			
		</script>
		<script>
			$(document).ready(function(){
				$("#accordian h3").click(function(){
					$("#accordian ul ul").slideUp();

					if(!$(this).next().is(":visible")) {
						$(this).next().slideDown();
					}
				});
		
				$(document).ajaxComplete(function() {
					$('#groupform').submit(function(e){
						e.preventDefault();
						var name = $('#groupName').val();
						if(name.length == 0){
							alert('Group name has not been entered');
						} else {
							$.ajax({
								type     : 'POST',
								url   	 : 'makegroup.php',
								data  	 : $('#groupform').serialize()
							})
							.done(function() {
								alert("Group created.");
							})
							.fail(function() {
								alert("Error creating group.");
							});
						}
					});
				});
			});
		</script>
	</head>
	<body>
		<div id="accordian">
			<ul>
				<li>
					<h3 id='homeElement'>Home</h3>
					<script>
						$('#homeElement').on("click", function(e) {
							window.location.href="http://www.cise.ufl.edu/~cmoore";
						});
					</script>
					<script>
						setInterval(function() {
							$.ajax({
								url		: "count_messages.php",
								dataType: "json"
							})
						
							.done(function(data) {
								if(!(data.mess_count == 0)) {
									$('#mess_count').remove();
									$('#homeElement').append("<div id='mess_count'> " + data.mess_count + "</div>");
								}
							});
						}, 1000*60*5);
					</script>
				</li>
				<li>
					<h3 id='friendpage'>Friends List</h3>
					<script>
						$('#friendpage').on("click", function(e) {
							window.location.href="Friends.php";
						});
					</script>
				</li>
				<li>
					<h3 id="Groups">Groups</h3>
					<ul id="GroupsList">
						<!--<li><a href="#">School</a></li>
						<li><a href="#">Work</a></li>
						<li><a href="#">People</a></li>-->
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
											//jQuery('#GroupsList').append("<li>" + value.name + "</li>");
											jQuery('#GroupsList').append("<li><a href=\"group.php?group=" + value.name + "\">"+value.name+"</a></li>");
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
					<h3 id='searchpage'>Search</h3>
					<script>
						$('#searchpage').on("click", function() {
							window.location.href="Search.php";
						});
					</script>
				</li>
				<li>
					<h3 id='requestpage'>Requests</h3>
					<script>
						$('#requestpage').on("click", function() {
							window.location.href="Request.php";
						});
					</script>
					<script>
						$.ajax({
							url		: "count_requests.php",
							dataType: "json"
						})
						
						.done(function(data) {
							if(!(data.count_requ == 0))
								$('#requestpage').append("<div id='count_requ'> " + data.count_requ + "</div>");
						});
					</script>
				</li>
				<li>
					<h3 id='creategroup'>Create Group</h3>
					<script>
						$('#creategroup').on("click", function() {
							window.location.href="creategroup.php";
						});
					</script>
				</li>
				<li>
					<h3 id='logout'>Logout</h3>
					<script>
						$('#logout').on("click", function() {
							$.ajax({
								url	: 'logout.php'
							})
							.done(function() {
								window.location.href="http://www.cise.ufl.edu/~cmoore/login.html";
							});
						});
					</script>
				</li>
			</ul>
		</div>
		<div id="mainlist" style="overflow:auto">
			<div id="title">
				<h1>CREATE GROUP</h1>
			</div>
			
			<form id="groupform" method="POST">
				<label for="groupName">Group Name:</label>
				<input id="groupName" type="text" name="groupName"><br />
				<label for='friendlist'>Members:</label><br />
				<select id="friendlist" name="friendlist[]" multiple>
				</select><br />
				<button type='submit' id="createbutton">Create Group</button>
			</form>
		</div>
	</body>
</html>
