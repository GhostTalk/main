#!/usr/local/bin/php

<?php
	session_start();
	if(!isset($_SESSION['Username']))
		header('Location: http://cise.ufl.edu/~cmoore');
		exit();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='HomePage.css'/>
	<script src='script.js'></script>
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
	})
})
</script>
<script>
  $(function() {
    $("#tabs").tabs();
  });
</script>
</head>
<body>
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
			<h3>Groups</h3>
			<ul>
				<li><a href="#">School</a></li>
				<li><a href="#">Work</a></li>
				<li><a href="#">People</a></li>
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
