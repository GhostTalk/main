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
			
			$(document).ready(function() {
				$(document).ajaxComplete(function() {
					$('#addMember').on('click', function(e) {
						e.preventDefault();
						//var group = <?php echo $_GET['group'];?>;
						var gdata = $('#memberList').serialize();
						<?php session_start(); $_SESSION['group']=$_GET['group'];?>
						//gdata[0] = $('#memberList').serialize();
						//gdata[1] = <?php echo $_GET['group']; ?>;
						$.ajax({
							type		: "POST",
							url			: "addmember.php",
							data		: gdata,
							async		: false
						})
						
						.done(function() {
							var url = "group.php?group=" + <?php echo "\"".$_SESSION['group']."\"";?>;
							window.location.assign(url);
						})
						
						.fail(function() {
							var url = "group.php?group=" + <?php echo "\"".$_SESSION['group']."\"";?>;
							window.location.assign(url);
						});
					});
					
					$('.removemember').on('click', function(e) {
						e.preventDefault();
						var member = $($(e.target).parent()).find('#mem').html();//$(this).closest("#mem").html();
						//var groupdata = {group : <?php echo $_GET['group']; ?>, member : member};
						<?php session_start(); $_SESSION['group']=$_GET['group']; ?>;
						$.ajax({
							type		: "POST",
							url			: "removemember.php",
							data		:  {'member' : member}
						})
						
						.done(function() {
							var url = "group.php?group=" + <?php echo "\"".$_SESSION['group']."\"";?>;
							window.location.assign(url);
						})
						
						.fail(function() {
							var url = "group.php?group=" + <?php echo "\"".$_SESSION['group']."\"";?>;
							window.location.assign(url);
						});
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
				<h1>GROUPS</h1>
			</div>
			<div id="grouplist">
		

				<script>
					var data = {group : <?php $st = "'".$_GET['group']."'"; echo $st; ?>};
					$.ajax({
						url		: "loadgroup.php",
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
					<select class="friendlist" multiple id="friendlist" name="friendlist[]">
					</select>
					<button id="addMember">Add</button>
				</form>
				<br />
				<br />
			</div>
		
		</div>
	</body>
</html>
