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
		<title>Home Page</title>
		<link rel='stylesheet' href='HomePage.css'/>
		<!--<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>-->
		<script src="http://thecodeplayer.com/uploads/js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<!--<script src="//code.jquery.com/jquery-1.9.1.js"></script>-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script>
			function getMessages(){
				$.ajax({
					url		: "inbox.php",
					type	: "POST",
					dataType: "json"
				})

				.done(function(response){
					$('#tab1').empty();
					$.each(response, function(index, value) {
						$('#tab1').append(value);
					});
				});
			}
			
			getMessages();
			
			setInterval(getMessages(), 1000*60*2);
			
			$.ajax({
				url		: "loadlist.php",
				type	: "POST",
				dataType: "json"
			})
			
			.done(function(response) {
				$.each(response, function(index, value) {
					$('#friendlist').append(value);
				});
			});
			
			$.ajax({
				url	: "loadgrouplist.php",
				type	: "POST",
				dataType: "json"
			})
			
			.done(function(response) {
				$.each(response, function(index, value) {
					$('#grouplist').append(value);
				});
			});
			
			$.ajax ({
				url		: "outbox.php",
				type	: "POST",
				dataType: "json"
			})
			
			.done(function(response) {
				$.each(response, function(index, value) {
					$('#tab3').append(value);
				});
			});
		</script>
		<script>
			$(document).ready(function(){
				$("#accordian h3").click(function(){
					$("#accordian ul ul").slideUp();
		
					if(!$(this).next().is(":visible"))
					{
						$(this).next().slideDown();
					}
				});
				
				
				$('#sendButton').on('click', function(e) {
					var comment = $.trim($('#message').val());
					if(comment.length==0 && $('#message').is(":visible")) {
						alert("Message field empty.");
						e.preventDefault();
						return;
					} else if(!($('#picmessage').val()) && $('#picmessage').is(":visible")) {
						alert("Picture not selected.");
						e.preventDefault();
					} else if(comment.length > 0 && $('#message').is(":visible")){
						$.ajax({
							type		: "POST",
							url			: "sendmessage.php",
							data		: $('#sendmessageform').serialize(),
							dataType	: 'json'
						})
						.done(function(data) {
							if(data.sent) {
								alert("Message sent!");
								window.location.href="http://www.cise.ufl.edu/~cmoore";
							} else
								alert(data.message);
						});
						
						e.preventDefault();
						return false;
					} else {
					}
				});
		
				jQuery(document).ajaxComplete(function () {
					$('.picture').on("click", function(e) {
						if(e.target.id == "picturet") {
							$('#message').hide();
							$('#picmessage').show();
							$('#filelabel').show();
						} else {
							$('#picmessage').hide();
							$('#filelabel').hide();
							$('#message').show();
						}
					});
					
					$(".messagebox").click(function(e) {
						var box = $(this);
						var sentBy = $(this).find("#sender").html();
						var time = $(this).find("#postt").html();
						var expires = $(this).find("#expirationtime").html();
						$(this).find(".dialog").dialog({
							title: sentBy + '\'s Message:',
							width: 600,
							height: 400,
							modal:true,
							resizable:false,
							draggable:false,
							open: function(event, ui) {
								if(!(expires=='')) {
									setTimeout("$('.dialog').dialog('close')", expires);
									
									var thisDialog = $(this);
									var interval = setInterval(function() {
										var timer = $(this).children('#time').html();
										var timera = timer.split(':');
										var minutes = parseInt(timera[0], 10);
										var seconds = parseInt(timera[1], 10);
										seconds -= 1;
										if (minutes < 0)
											return clearInterval(interval);
										if (minutes < 10 && minutes.length != 2)
											minutes = '0' + minutes;
										if (seconds < 0 && minutes != 0) {
											minutes -= 1;
											seconds = 59;
										} else if (seconds < 10 && length.seconds != 2)
											seconds = '0' + seconds;
										$(this).children('#time').html(minutes + ':' + seconds);
		
										if (minutes == 0 && seconds == 0){
											thisDialog.dialog('close');
											clearInterval(interval);
										}
									}, 1000);
									
								}
							},
							
							close: function (ev, ui) {
								var dataObject = {sender: sentBy, posttime: time};
				
								$.ajax({
									url:"setMessageRead.php",
									type: "POST",
									data: dataObject
								})
								
								.done(function() {
									console.log("Message deleted successfully.");
								})
								
								.fail(function() {
									console.log("Encountered error deleting message.");
								});
								
								if(!(expires=='')) {
									$(this).dialog("destroy");
									$(this).remove();
									$(box).remove();
								} else {
									$(this).dialog("hide");
								}
							}
						});
					});
				});
			});
		</script>
		<script>
			jQuery(function() {
				jQuery("#tabs").tabs();
			});
		</script>
	</head>
	<body>
		<div id ="header">
			<img src = "http://i.imgur.com/ASTbZIp.png" width="50%" height="130px">
		</div>
		<div id="tabs">
				<ul>
					<li><a href="#tab1"><span class="icon-envelope"></span>Inbox</a></li>
					<li><a href="#tab2"><span class ="icon-mail-forward"></span>Send</a></li>
					<li><a href="#tab3"><span class ="icon-folder-open"></span>Sent</a></li>
				</ul>
				<div id = "right" style="overflow:auto">
					<div id = "tab1">
					</div>
					<div id = "tab2">
						<form id="sendmessageform" action="sendmessage.php" method="POST" enctype="multipart/form-data">
							<!--Dropdown menu for friends list-->
							<div id="friends">
								<p>Send To:</p>
								<select id="friendlist" name="friendlist[]" multiple>
								</select>
								<P>Groups to send:</p>
								<select id = "grouplist" name="grouplist[]" multiple>
								</select>
							</div>
							<br />
							<!--Dropdown menu for expiraion time-->
							<label for="expiration">Expiration Time: </label>
							<select id="expiration" name="expiration">
								<option value="0">No expiration</option>
								<option value="10000">10 seconds</option>
								<option value="30000">30 seconds</option>
								<option value="60000">60 seconds</option>
							</select>
							<br />
							<input type="radio" id="picturef" class="picture" name="picture" value="false" checked>Post</input>
							<input type="radio" id="picturet" class="picture" name="picture" value="true">Picture</input>
							<!--Body for the message-->
							<br>
							</br>
							<div id='messagebox'>
								<textarea id="message" rows="10" cols="60" name="message"></textarea>
								<label for='picmessage' id='filelabel' style="display:none">File: </label><input type='file' style="display:none" id='picmessage' name="picmessage"></input>
							</div>
							<button id="sendButton">Send</button>
						</form>
					</div>
					<div id = "tab3">
					</div>
				</div>
		</div>
		<div class="alsofade">
			<!--<img id="f3" src="http://imgur.com/VJ6iKzk.jpg"	height="100px" width="100px">-->
			<script>
					$.ajax({
						url		: "get_user_pic.php",
						dataType: "json"
					})
					
					.done(function(pic) {
						$('.alsofade').append(pic.tag);
					});
			</script>
		</div>
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
		<!--<div class="fadein">
    
			<img id="f1" src="http://imgur.com/VJ6iKzk.jpg"	height="150px" width="150px">
    
			<img id="f2" src="http://imgur.com/vcNd1PS.jpg" height="150px" width="150px">

		</div>-->
	</body>
</html>
