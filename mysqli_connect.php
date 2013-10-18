<?php

/* This code contains the database access information.
	This code also establishes a connection to MySQL, selects the 
	database, and sets the encoding. */
	
//Set the database access information as constants:
DEFINE ('DB_USER', 'USER');
DEFINE ('DB_PASSWORD', 'PASSWORD');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'database');

//Make the connection to the database:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Could not connect
	to MySQL: ' . mysqli_connect_error() );
	
//Set the encoding of the php script to the database:
mysqli_set_charset($dbc, 'utf-8');	
