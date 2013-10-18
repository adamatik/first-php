<?php 
$page_title = 'Register';


//Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	require ('mysqli_connect.php'); //Connect to the db
	
	$errors = array();  //Initialize the error array
	
	//Check for a first name:
	if (empty($_POST['first_name'])){
		$errors[] = 'You forgot to enter your First Name.';
	}else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
		/* The mysqli_real_escape_string function makes submitted data safe to use in a
			query.
			*/
	}
	
	//Check for last name:
	if (empty($_POST['last_name'])){
		$errors[] = 'You forgot to enter your Last Name.';
	}else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	//Check for department:
	if (empty($_POST['dept'])){
		$errors[] = 'You forgot to enter your Department.';
	} else {
		$dpt = mysqli_real_escape_string($dbc, trim($_POST['dept']));
	}

	//Check for Job Title:
	if (empty($_POST['job_title'])){
		$errors[] = 'You forgot to enter your Job Title.';
	} else {
		$jt = mysqli_real_escape_string($dbc, trim($_POST['job_title']));
		}
	
	//Check for Biography:
	if (empty($_POST['bio'])){
		$errors[] = 'You forgot to enter your Biography.';
	} else {
		$bg = mysqli_real_escape_string($dbc, rtrim($_POST['bio']));
		}
		
	//Condition if everything is fine:	
	if (empty($errors)) {

		//Register the user in the database..
		
		$q = "INSERT INTO employees (dept, job_title, first_name, last_name, bio) VALUES
		('$dpt', '$jt', '$fn', '$ln', '$bg')";  //Make the query
		
		$r = @mysqli_query ($dbc, $q);  //Run the query
	
		//If query ran okay.
		if ($r){
	
		//Print a message confirming everything ran well.
		echo '<h1>Thanks!</h1>
		<p>You are now registered.</p>
		<p><br/></p>';
		
		echo '<p><a href="register.php">Register New User</a></p>';
		
		}else { //If not okay run well....

		//Public message:
		echo '<h1>System Error</h1>
		<p class="error">You could not be registered due to a system error.  We apologize for
		any inconvenience.</p>';
		
		//Debugging the message:
		echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' .$q. '</p>';
		
		} //End of if ($r) IF.
		
		//Close the database connection
		mysqli_close($dbc);
		
		exit();
		
	} else { //Report the errors.
		echo '<h1>Error!</h1>
		<p class ="error">The following error(s) occurred: <br/>';
		foreach ($errors as $msg) { //Print each error.
			echo " - $msg<br/> \n";
			}
		echo '</p><p>Please try again.</p><p><br/></p>';
		} //End of if (empty($errors)) IF
		
		mysqli_close($dbc); //Close the database connection.
		
} //End	of main Submit conditional.
?>

<!-- Create the HTML form -->
<h1>Register</h1>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name = "first_name" size = "20" maxlength = "30" value ="<?php if
	(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /> </p>
	<p>Last Name: <input type="text" name = "last_name" size = "30" maxlength = "40" value ="<?php if
	(isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /> </p>
	<p>Department: <input type="text" name = "dept" size = "20" maxlength = "60" value ="<?php if
	(isset($_POST['dept'])) echo $_POST['dept']; ?>" /> </p>
	<p>Job Title: <input type="text" name = "job_title" size = "30" maxlength = "35" value ="<?php if
	(isset($_POST['job_title'])) echo $_POST['job_title']; ?>" /> </p>
	<p>Biography: <textarea name = "bio" rows = "5" cols = "40" ><?php if
	(isset($_POST['bio'])) echo $_POST['bio']; ?></textarea> </p>
	<p><input type="submit" name ="submit" value="Register" /></p>
	</form>
	<p><br/></br></p>
	<p><a href="upload_image.php">Upload an Image</a></p>
	
		
		
		
