<?php

// DB Connection 
	$hostname="localhost";
	$username="root";
	$password="";
	$dbname = "vts";
	$conn=mysql_connect($hostname,$username,$password);
	$db=mysql_select_db($dbname,$conn);
	if(!$db)
		echo "Not connected";

?>
