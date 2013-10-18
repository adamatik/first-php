<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional/EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang ="en"
lang="en">

<head>
	<meta http-equiv="Content-Type"
	content="text/html;
	charset=utf-8" />
	
<title>Upload an Image</title>
<style type="text/css" title="text/css" media="all">
	.error{
		font-weight:bold;
		color:#C00;
		}
</style>
</head>
<body>
<?php

	//Check if the file/form has been submitted:
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_FILES['upload'])) { //Check that the file is the proper type:
		$allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG',
			'image/PNG', 'image/png', 'image/x-png');
			if (in_array($_FILES['upload'] ['type'], $allowed)){
			
			//Copy the file to a new location on the server:
			if (move_uploaded_file ($_FILES ['upload']['tmp_name'],
				"../uploads/{$_FILES['upload']['name']}")){
				echo '<p><em>The file has been uploaded!</em></p>';
				} //End of move...IF
				
			}else { //Invalid file type, etc.
				echo '<p class="error">Please upload a JPEG image.</p>';
				}
				}//End of isset($_FILES['upload']) if
				
	//Check for any errors and report on them:
		if ($_FILES['upload']['error'] > 0) {
		echo '<p class="error">The file could not be uploaded because: <strong>';
		
		//Switch that prints a detailed error message
		switch ($_FILES['upload']['error']){
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini.';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
				break;
			case 3:
				print 'The file was only partially uploaded.';
				break;
			case 4:
				print 'No file was uploaded.';
				break;
			case 6:
				print 'No temporary folder was available.';
				break;
			case 7:
				print 'Unable to write to the disk.';
				break;
			case 8:	
				print 'File upload stopped.';
				break;
			default:
				print 'A system error occurred.';
				break;
			} //End of switch
		print '</strong></p>'; //end of echo statement
		} //end of IF statement
		
		//Delete the temporary file if it still exists
		if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) )
		{
		unlink ($_FILES['upload']['tmp_name']);
		} 
		}//End of the submitted conditional.
		?>
		
<!-- Create the HTML form -->
	<form enctype="multipart/form-data" action="upload_image.php" method="post">
	
	<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
	
	<fieldset>
	<legend>Select a JPEG of 512 KB or smaller to be uploaded: </legend>
	<p><b>File:</b> <input type="file" name="upload" /></p>
	</fieldset>
	
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>
	
	</form>
	<p></br></br>
	<a href="register.php">Back to Register</a></p>
	<p></br><a href="view_users.php">View Users</a></p>
	</body>
	</html>
			
		
