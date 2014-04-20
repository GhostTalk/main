#!/usr/local/bin/php

<?php
	session_start();
	if(!isset($_SESSION['Username'])) {
		echo '<script>window.location.href="http://cise.ufl.edu/~cmoore";</script>';
		exit();
	}
?>
	
<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' href='Request.css'/>
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
			
			
			
				$(document).ready(function() {
					$.ajax({
						url : "loadlist.php",
						type : "POST",
						dataType: "json"
					})
					.done(function(response) {
						$.each(response, function(index, value) {
						$('#friendlist').append(value);
						});
					});
						
					var data = {group : <?php echo $_GET['group']; ?>};
					$('#addMember').on('click', function(e) {
						alert('hello');
						$.ajax({
							type		: "POST",
							url		: "addmember.php",
							data		: {$('#memberList').serialize(), data},
							dataType	: 'json'
						})
					});
					
				
					$('.removeMember').on('click', function(e) {
					var member = $(this).closest("#groupmember").html();
						$.ajax({
							type		: "POST",
							url		: "removemember.php",
							data		: {member : member, data},
							dataType	: 'json'
						})
					
						
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
								window.location.href="http://www.cise.ufl.edu/~cmoore";
							});
						});
					</script>
				</li>
			</ul>
		</div>
		<div id="mainlist" style="overflow:auto">
			<div id="title">
				<h1>GROUPS</h1>
			</div>
			<div id="grouplist">
		

				<script>
					var data = {group : <?php echo $_GET['group']; ?>};
					$.ajax({
					url	: "loadgroup.php",
					type	: "POST",
					data	: data,
					dataType: "json"
					})
				
					.done(function(response){
						$.each(response, function(index, value) {
							$('#grouplist').append(value);
						});
					});
					
				</script>
				<p>Add Friends</p>
				<form id="memberList">
					<select class="friendlist" multiple>
								
					</select>
					<button id="addMember">Add</button>
				
				</form>
			</div>
		
		</div>
	</body>
</html>
