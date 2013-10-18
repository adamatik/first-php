<?php  #Meant to call an image as the proper size.

	//Connect to the DB:
	require_once ('mysqli_connect.php');
	
		
	//Define the SQL query:
	$q = "SELECT last_name, user_id FROM employees";
	//Retrieve the User's Information:
	$r = @mysqli_query($dbc, $q);
	
	//Get the user's information:
	$row = mysqli_fetch_array($r, MYSQLI_NUM);
		
	//Get Image:
	$ln= $row[0];
	$image = "../uploads/$ln.jpg";
	$name = '$ln.jpg';
	//Get the image information:
		$info = getimagesize($image);
		$fs = filesize($image);
		
	//Send the content information:
	header ("Content-Type: {$info['mime']}\n");
	header ("Content-Disposition: inline; filename=\"$name\"\n");
	header ("Content-Length: $fs\n");
	readfile($image);
	?>
