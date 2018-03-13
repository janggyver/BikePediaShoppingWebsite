<?php

// This PHP page is *called from* ajaxClient.php (STEP.4, Parameter 1) on the CLIENT side.  										
//																																	
// It receives the data you entered in your form via URL parameters. (STEP.4, Parameter 2)											
//																																	
// This page is *executed on* the SERVER side.  So, if "you" (the client) are located in Saint John, and the actual					
// YeS website (the server) is located in California, this page is executed IN California, not IN Saint John.						
//  																																
// This page is not designed to be shown on with your browser!  It will never be "sent" to your browser!
// It should NOT contain any HTML.  Trying to place HTML into this page will usually cause it to stop working, 
// and you will not receive any indication of that (ie error message, etc).				
//																																	
// Basically then, this page receives data from ajaxClient.php, inserts it into a database table, retrieves it back (to make sure 	
// it's in the table), "encodes" it, and returns it to ajaxClient.php , which then displays it.										
//																																	
															
	
	// Connect to database - Ref YeSV4.8.30 
	$db_name = "ericjang";
	
	$db_connected = new mysqli("localhost","root", "", $db_name);	
	
	// Check for any connection errors
	if ($db_connected->connect_error){	
		trigger_error("Failed connecting to the database: ".$db_connected->connect_error, E_USER_ERROR);	
	}                                
		
	

	
	

// STEP.6 -- Build an SQL string, insert new comment into the database.												
//																													
// Be VERY CAREFUL building this string... an invalid or misspelled name, 											
// or a missing ' or , will cause this page	to stop working!														
//																													
// Ref YeSV4.8.40 , .50						

// http://php.net/manual/en/mysqli.real-escape-string.php  escapes special characters in a string for use in an SQL statement.
// Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.

// For example, in a comment such as "It's a wonderful product", the ' in It's would totally screw up the SQL statement you're 
// trying to build, much in the same way that mismatching quotes gave you such grief in previous labs.
// real_escape_string fixes this problem.

$db_connected->query("INSERT INTO ajaxdemo (name, comment) VALUES ('" 

					. $db_connected->real_escape_string($_GET['name']) . 
					
					"', '" 
					
					. $db_connected->real_escape_string($_GET['comment']) . 
					
					"')"
		   );
					
		

			
			
			
// Retrieves the ID generated for an AUTO_INCREMENT column by the previous query (usually INSERT). 	
$insert_id = $db_connected->insert_id;

// Ref YeSV4.8.60 ... Can you SELECT the newly inserted comment?	Proves it was inserted correctly!	
$rs = $db_connected->query("SELECT name, comment FROM ajaxdemo WHERE id={$insert_id}");

// Ref YeSV4.8.70 ... Retrieve the newly inserted comment from recordset, encode into JSON.									
// You don't really need a loop here since only 1 record should be in the recordset.										
// The loop is included only to show you the functionality required for other scenarios that may involve multiple records.	
// In this case, the loop should only execute 1 time.																		

while($row = $rs->fetch_array(MYSQL_ASSOC)) {
	$json_out = json_encode($row);
}



// STEP.7 -- return the JSON data to the ajaxClient.php page, which will display it in STEP.4, Parameter 3.			
// Ref YeSV4.8.80																									
echo $json_out;

				
?>