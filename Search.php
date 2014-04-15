<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='Search.css'/>
	<script src='script.js'></script>
	<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
<script src="http://thecodeplayer.com/uploads/js/jquery-1.7.1.min.js" type="text/javascript"></script>
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
</head>
<body>
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
<div id="mainlist" style="overflow:auto">
    <div id="title">
    <h1>SEARCH</h1>
    </div>
    <p>hi there</p>
   <!--FRIENDS GO HERE-->
</div>
</body>
</html>
