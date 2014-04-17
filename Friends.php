#!/usr/local/bin/php

<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' href='Friends.css'/>
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
				<h1>FRIENDS</h1>
			</div>
			<div id="friedslist">
		

				<script>
					$.ajax({
					url	: "loadFriends.php",
					type	: "POST",
					dataType: "json"
					})
				
					.done(function(response){
						$.each(response, function(index, value) {
							$('#friendslist').append(value);
						});
					});
					
				</script>
			</div>
		
		</div>
	</body>
</html>
