<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang ="en"
lang="en">

<head>
	<meta http-equiv="Content-Type"	content="text/html;	charset=utf-8" />
	
<title>Images</title>
<!--Include the JavaScript file:-->
<script type="text/javascript" charset="utf-8" src="js/function.js"></script>
</head>

<body>
<p>Click on an Image to view in a seperate window:</p>

<ul>

	<?php
		//This code lists the specific image in the uploads directory:
				
		$dir = '../uploads';  //Define the directory to pull the images to view
		
		$files = scandir($dir); //Read all of the images into the array, $files
		
		//Display each image caption as a link to the JavaScript function:
		foreach ($files as $image){
			
			if (substr($image, 0, 1) !='.'){ //Ignore anything starting with a period.
			
				//Get the image's size in pixels:
				$image_size = getimagesize("$dir/$image");
				
				//Make the image's name URL-safe:
				$image_name = urlencode($image);
				
				//Print the information 
				echo "<li><a href=\"javascript:create_window('$image_name',$image_size[0], $image_size[1])\">$image</a></li>\n";
				} //End of the IF.
				
			}//End of the foreach loop
		?>
		</ul>
		</body>
		</html>
