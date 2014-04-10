<?php
/*session_start();
require("logininDB.php");

$user = $_SESSION['user'];
if(isset($_POST['inbox'])) {
$user = $_SESSION['user'];
$query = sprintf("SELECT * FROM %s_messages_received",$_POST['Username']);
//Loop through all rows in query and echo their values into the inbox div
while($row = pg_fetch_array($query))
{
      echo "<div id="messagebox">";
	  echo "<img id="save" src="http://icons.iconarchive.com/icons/cornmanthe3rd/plex/512/Communication-gmail-icon.png" width="100" height="100">";
	  echo "<p id="sender">";
	  echo $row['creatorusername'];
      echo "</p>";
	  echo "<p id="posttime">";
	  echo $row['creatorusername'];
	  echo "</p>";
	  echo	$row['body'];
 	  echo $row['expirationtime'];
	  echo "</br>";
}
*/

	  echo "<div class='messagebox'>";
	  echo "<img class='save' src='http://icons.iconarchive.com/icons/cornmanthe3rd/plex/512/Communication-gmail-icon.png' width='100' height='100'>";
	  echo "<p id='sender'>";
	  echo "sender";
      echo "</p>";
	  echo "<p id='posttime'>";
	  echo "1/10/2014";
	  echo "</p>";
	  echo "<div class ='dialog'>";
	  echo "<p id='body'>";
	  echo "message 1";
	  echo "</p>";
	  echo "</div>";
	  echo "</div>";
	  
	  
	  
	/*  	<div class="messagebox">
					<img class='save' src='http://icons.iconarchive.com/icons/cornmanthe3rd/plex/512/Communication-gmail-icon.png' width='100' height='100'>
					<p id='sender'>
						Sender
					</p>
					<p id='posttime'>
						1/06/14
					</p>
					<div class='dialog'>
					<p id='body'>
						message 1
					</p>
					</div>
				</div>
				
				<div class="messagebox">
					<img class='save' src='http://icons.iconarchive.com/icons/cornmanthe3rd/plex/512/Communication-gmail-icon.png' width='100' height='100'>
					<p id='sender'>
						Sender
					</p>
					<p id='posttime'>
						1/09/14
					</p>
					<div class='dialog'>
					<p id='body'>
						message 2
					</p>
					</div>
				</div>
				
				
				<div class="messagebox">
					<img class='save' src='http://icons.iconarchive.com/icons/cornmanthe3rd/plex/512/Communication-gmail-icon.png' width='100' height='100'>
					<p id='sender'>
						Sender
					</p>
					<p id='posttime'>
						1/12/14
					</p>
					<div class='dialog'>
					<p id='body'>
						message 3
					</p>
					</div>
				</div>
				*/
?>
