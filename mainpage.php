#!/usr/local/bin/php

<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='HomePage.css'/>
	<script src='script.js'></script>
<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
<script src="http://thecodeplayer.com/uploads/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
//append all html content formed by PHP into the id specified using AJAX
	$.ajax({url:"inbox.php"}).done(function(html){
		$("#tab1").append(html);
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
		
	 
	 $(".messagebox").click(function(e) {
		var box = $(this);
		var sentBy = $(this).find("#sender").html();
		var time = $(this).find("#posttime").html();
		$(this).find(".dialog").dialog({
			title:'dialog',
			width: 600,
			height: 400,
			modal:true,
			resizable:false,
			draggable:false,
		
			close: function (ev, ui) {
				var dataObject = {sender: sentBy, posttime: time};
				
				$.ajax({
				url:"deleteMessage.php",
				type: "POST",
				data: dataObject,
				dataType: "JSON",
				success: successCall
				});
				
				
				
				$(this).dialog("destroy");
				$(this).remove();
				$(box).remove();
			}
			
		});
		
	});
	
		setTimeout(function(){
			$('.dialog').dialog('close');
		}, 3000);
		
		
		
		function successCall(){
			console.log("Message was deleted");
		
		}	
		
});
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
