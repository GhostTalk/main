<?php
	session_start();
	$conn = pg_connect("host=postgres.cise.ufl.edu user=cmoore dbname=ghosttalk password=calvin#1");

	$user = $_SESSION['Username'];
	$query = sprintf("SELECT * FROM groups WHERE name=friends AND creatorusername = $user" , $user);
	$result = pg_query($conn, $query);
	
	$list = array();
	$counter = 0;
	
	while($row = pg_fetch_assoc($result)) {
		$list[$counter] = "<div>".$row['friend']."</div>";
		$counter++;
	}

	echo json_encode($list);
	
?>

//Load Friends
<script>	
	$.ajax({
				url		: "loadFriends.php",
				type	: "POST",
				dataType: "json"
			})
				
			.done(function(response){
				$.each(response, function(index, value) {
					$('#appendToHTMLElement').append(value);
				});
			});
</script>
