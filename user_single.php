<?php  #Script to show User Picture, Name, and Bio
		//user_single.php

	$page_title = 'Employee Profile';
	echo '<h1>Employee Profile';
	
	//Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ){ //From view_users.php
		$id= $_GET['id'];
		}elseif  //Form Submission:
			( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ){
			$id = $_POST['id'];
			} else { //No Valid ID, kills the script.
			echo '<p class="error">This page has been accessed in error.</p>';
			include('includes/footer.html');
			exit();
			}
	
	
	//Connect to the DB:
	require_once ('mysqli_connect.php');
	
		
	//Define the SQL query:
	$q = "SELECT first_name, last_name, bio, user_id FROM employees WHERE user_id=$id";
	//Retrieve the User's Information:
	$r = @mysqli_query($dbc, $q);
	
	//Get the user's information:
	$row = mysqli_fetch_array($r, MYSQLI_NUM);
				
		echo '<p><a href="view_users.php"><h4>Back to Employee List</h4></a></p>';
		//Create the form for the user's information and link to image
		echo '<p><img src="../uploads/'.$row[0].'_'.$row[1].'.jpg" /></p><p>
			<h2>Name: '.$row[0].'  '.$row[1].'</h2></p>
			<p><h3>Biography: '.$row[2] .'</h3></p>';
	
	mysqli_close($dbc); //Close the db connection.
	
	?>

	
