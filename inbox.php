<?php
session_start();
$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");

$user = 'Christian123';//$user = $_SESSION['user'];
if(isset($_POST['inbox'])) {
$query = sprintf("SELECT * FROM %s_messages_received",$user);
$result = pg_query($conn, $query);
//Loop through all rows in query and echo their values into the inbox div
$counter = 0;
$row = pg_fetch_row($result, $counter);
while($row)
{
  $message = "<div class='messagebox'> <img class='save' src='http://icons.iconarchive.com/icons/cornmanthe3rd/plex/512/Communication-gmail-icon.png' width='100' height='100'><p id='sender'>".$row[creatorusername]."</p><p id='posttime'>".$row[posttime]"</p><div class ='dialog'><p id='body'>message 1</p></div></div>";
  $counter++;
  $row = pg_fetch_row($result, $counter);
}

	  echo json_encode($message);
  
	
?>
