

<!-- Connecting to Database -->
<?php

	//server
	$db_server = "localhost";
	
	//database user name
	$db_user = "root";
	
	//database password
	$db_pwd = "";
	
	//database name
	$db_name ="ericjang";
	
	//1. create the connection to the local database
	$db_connected = new mysqli($db_server, $db_user, $db_pwd, $db_name);
	
	//2. check db connection
	if($db_connected->connect_error){
		trigger_error('Database connection Failed: '. $db_connected -> connect_error, E_USER_ERROR); // what is the difference from E_USER_NOTICE
	}
		
	// end of database connectiviy	

		
	//Display individual products' information
	
		//Retrieve Required record set
	
	//string of query for retrieve
	$strSQL = "SELECT ProductCode, ProductName, ProductDescription, products.Department, ThumbnailHeight, RegularPrice, 
				Option1Desc, Option1a, Option1b, Option1c, Option1d, Stock
			FROM Products WHERE Category = '$strCategory'  order by ProductCode";
				
	//declaring record set
	$rsProd = $db_connected->query($strSQL);
	

	//check whether the sql is right and how many data are
	if($rsProd == false){
		trigger_error("Wrong SQL: ".$strSQL. "Error".$db_connected->error, E_USER_ERROR);
	}
	else{
		$rows_returned = $rsProd->num_rows; // return the numbers of row
	}

	// if the returned rows value 0, then show this message
	if($rows_returned == 0){
		die($db_name." : ".$strSQL. " : No records retrieved.");  // why "" used instead of ''
	}
	//end of required record set retrieving
	
	// Use loop for grabbing the each rows of data from the record set
	
	?>

