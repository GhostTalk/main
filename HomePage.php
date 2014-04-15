#!/usr/local/bin/php

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
			$.ajax({
				url		: "inbox.php",
				type	: "POST",
				dataType: "json"
			})
				
			.done(function(response){
				$.each(response, function(index, value) {
					$('#tab1').append(value);
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
		
				jQuery(document).ajaxComplete(function () {
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
								
									//var timer = expires;
									//setInterval(function() {
									//	if(timer < expires)
									//		$(this).find('#timer').empty();
									//	$(this).html(timer);
									//	timer--;
									//}, 1000);
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
					</div>
					<div id = "tab2">
						<p>NO YOU</p>
					</div>
					<div id = "tab3">
						<p>Getting real tired of your shit html</p>
					</div>
				</div>
		</div>
		<div class="alsofade">
    
			<img id="f3" src="http://imgur.com/VJ6iKzk.jpg"	height="100px" width="100px">
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
		<div class="fadein">
			<img id="f1" src="http://imgur.com/VJ6iKzk.jpg"	height="200px" width="200px">
			<img id="f2" src="http://imgur.com/vcNd1PS.jpg" height="200px" width="200px">
		</div>
	</body>
</html>
