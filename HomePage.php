#!/usr/local/bin/php

<!DOCTYPE html>
<html>
	<head>
		<title>Home Page</title>
		<link rel='stylesheet' href='HomePage.css'/>
		<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
		<script src="http://thecodeplayer.com/uploads/js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script>
			$(document).ready(function(){
				$("#accordian h3").click(function(){
					$("#accordian ul ul").slideUp();
		
					if(!$(this).next().is(":visible"))
					{
						$(this).next().slideDown();
					}
				});
			});
		</script>
		<script>
			$(function() {
				$("#tabs").tabs();
			});
		</script>
	</head>
	<body>
		<?php
			session_start();
			if(!isset($_SESSION['Username'])) {
				echo '<script>window.location.href="http://cise.ufl.edu/~cmoore";</script>';
				exit();
			}
		?>
		
		<div id ="header">
			<h2>Ghost Talk</h2>
		</div>
		<div id="tabs">
				<ul>
					<li><a href="#tab1"><span class="icon-envelope"></span>Inbox</a></li>
					<li><a href="#tab2"><span class ="icon-mail-forward"></span>Send</a></li>
					<li><a href="#tab3"><span class ="icon-folder-open"></span>Sent</a></li>
				</ul>
				<div id = "right" style="overflow:auto">
					<div id = "tab1">
						<p>wtf mate</p>
					</div>
					<div id = "tab2">
						<p>NO YOU</p>
					</div>
					<div id = "tab3">
						<p>Getting real tired of your shit html</p>
					</div>
				</div>
		</div>
		<div id="accordian">
			<ul>
				<li>
					<h3>Home</h3>
				</li>
				<li>
					<h3>Friends List</h3>
				</li>
				<li>
					<h3 id="Groups">Groups</h3>
					<ul id="GroupsList">
						<!--<li><a href="#">School</a></li>
						<li><a href="#">Work</a></li>
						<li><a href="#">People</a></li>-->
						<script>
							$(document).ready(function() {
								$("#Groups").on("click", function(e) {									
									$.ajax({
										type		: 'POST',
										url			: 'get_groups.php',
										dataType	: 'json'
									})
									
									.done(function(result) {
										$('#GroupsList').empty();
										
										var counter=0;
										$.each(result, function(index, value) {
											$('#GroupsList').append(value.name);
										});
									})
									
									.fail(function() {
										$('#GroupsList').empty();
										$('#GroupsList').append('Error loading groups.');
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
	</body>
</html>
