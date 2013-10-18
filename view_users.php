<?php 

	//This code retrieves all the records from the users table.
	//The new version links to edit and delete pages.

	$page_title = 'View the Current Employees';
	
	include ('viewusers.html');

	//page header:
	echo "<h1>Employees</h1>\n";
	
	
	
	require_once ('mysqli_connect.php'); //Connect to the db

	//Set the number of records to display per page:
	$display = 20;
	
	//Determine how many pages there are...
	if (isset($_GET['p']) && is_numeric($_GET['p'])) { //If already been determined..
	
	$pages= $_GET['p'];
	
	}else { //Need to determine how many pages..
	
	//Count the number of records:
	$q = "SELECT COUNT(user_id) FROM employees";
		
	$r = @mysqli_query ($dbc, $q); //Run the query
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	
	//Calculate the number of pages...
	if ($records > $display) { //More than 1 page.
	$pages = ceil ($records/$display);
		} else {
			$pages = 1;
		}
	} // End of p IF
	
	//Determine where in the database to start returning results...
	if (isset($_GET['s']) && is_numeric($_GET['s'])) {
		$start = $_GET['s'];
		} else {
			$start = 0;
			}
	//Determine the sort:
	//Default is by registration date.
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'first_name';
	
	//Determine the sorting order:
	switch ($sort){
		case 'ln':
			$order_by = 'last_name ASC';
			break;
		case 'fn':
			$order_by = 'first_name ASC';
			break;
		case 'job':
			$order_by = 'job_title ASC';
			break;
		default:
			$order_by = 'dept ASC';
			$sort = 'dept';
			break;
			}
	//If statement to choose correct list.
	
	if (!isset($_REQUEST['dept_select'])){
		
		$q = "SELECT dept, job_title, bio, last_name, first_name, user_id FROM employees ORDER BY $order_by LIMIT $start, $display";
		
		}else {
		
		$d = $_REQUEST['dept_select'];
		
		if($d == 'Consulting'){
	
				$q = "SELECT dept, job_title, last_name, first_name, user_id FROM employees WHERE dept = 'Consulting' ORDER BY $order_by LIMIT $start, $display";
			
			} else if ($d == 'Development'){
			
				$q = "SELECT dept, job_title, last_name, first_name, user_id FROM employees WHERE dept = 'Development' ORDER BY $order_by LIMIT $start, $display";
			
			} else if ($d == 'Marketing'){
			
				$q = "SELECT dept, job_title, last_name, first_name, user_id FROM employees WHERE dept = 'Marketing' ORDER BY $order_by LIMIT $start, $display";

			} else if ($d == 'Operations'){
			
				$q = "SELECT dept, job_title, last_name, first_name, user_id FROM employees WHERE dept = 'Operations' ORDER BY $order_by LIMIT $start, $display";
			
			} else if ($d == 'Quality Assurance'){
		
				$q = "SELECT dept, job_title, last_name, first_name, user_id FROM employees WHERE dept = 'Quality Assurance' ORDER BY $order_by LIMIT $start, $display";
			
			} else if ($d == 'Sales'){
		
				$q = "SELECT dept, job_title, last_name, first_name, user_id FROM employees WHERE dept = 'Sales' ORDER BY $order_by LIMIT $start, $display";
			
			} else if ($d == 'Senior Management'){
		
				$q = "SELECT dept, job_title, last_name, first_name, user_id FROM employees WHERE dept = 'Senior Management' ORDER BY $order_by LIMIT $start, $display";
			
			} else if ($d == 'Solutions Center'){
		
				$q = "SELECT dept, job_title, last_name, first_name, user_id FROM employees WHERE dept = 'Solutions Center' ORDER BY $order_by LIMIT $start, $display";
			
			}else {
				
				$q = "SELECT dept, job_title, bio, last_name, first_name, user_id FROM employees ORDER BY $order_by LIMIT $start, $display";
			}
			}
			
			
		$r = @mysqli_query ($dbc, $q); //Run the query
		
		//Table Header.
		echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
		<tr>
		<td align="left"></td>
		<td align="left"></td>
		<td align="left"><b>First Name</b></td>
		<td align="left"><b>Last Name</b></td>
		<td align="left"><b>Department</b></td>
		<td align="left"><b>Job Title</b></td>
		
		</tr>';
		
		//Fetch and print all the records:
		$bg = '#eeeeee'; //Set the initial background color.
		
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		
		//Switch the background color:
		$bg = ($bg =='#eeeeee' ? '#ffffff' : '#eeeeee');
		
		echo '<tr bgcolor="' .$bg. '">
		<td align="left"><a href="user_single.php?id=' . $row['user_id']. ' ">View</a></td>
		<td align="left"><img src="../uploads/'.$row['first_name'].'_'.$row['last_name'].'.jpg" /></td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['last_name'] . '</td>
		<td align="left">' .$row['dept']. '</td>
		<td align="left">' . $row['job_title']. '</td>
		
		</tr>';
		}//End of While Loop
		
		echo '</table>'; //Close the table
		
		mysqli_free_result ($r); //Free up the resources.
		mysqli_close($dbc); //Close the db connection.
		
		//Make the links to other pages, if necessary.
		if ($pages > 1){
		
			//Add some spacing and start a paragraph
			echo '<br/><p>';
			
			//Determine what page the script is on:
			$current_page = ($start/$display) + 1;
			
			//IF it's not on the first page, make a Previous link:
			if ($current_page !=1){
				echo '<a href="view_users.php?s = '.($start - $display).'
				&p='.$pages.'&sort=' .$sort.'">Previous</a> ';
				}
				
			//Make all the numbered pages:
			for ($i = 1; $i <= $pages; $i++){
				if ($i != $current_page){
					echo '<a href="view_users.php?s=' .(($display * ($i-1))) .'
					&p=' .$pages.' &sort=' .$sort.'">'.$i. '</a> ';
					}else {
						echo $i . ' ';
						}
			}//End of FOR loop.

			//If it's not the last page, make a NEXT button:
			if ($current_page != $pages){
				echo '<a href="view_users.php?s=' .($start + $display). '&p=' .$pages. '&sort=' .$sort.'">Next</a>';
				}
					
			//Close the paragraph
			echo '</p>';
		}	//End the links IF section.
	?>
