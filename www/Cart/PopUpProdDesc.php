
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
	?> 

	
	
	



	
<html>
	<head>

		<!--Deafault Page Set up -->
		
		<?php
		
		$PageID = 405;
		//Retrieve from the database
		$strPopUpSQL = "SELECT ProductCode, ProductName, ProductDescription, RegularPrice, Department, Stock, 
						ThumbnailHeight from products where ProductCode = '".$_GET["ProdID"]."'";
		$detailPage = $db_connected->query($strPopUpSQL);
		
		
		//Error Checking
		if($detailPage == false){
			trigger_error("Wrong SQL: ".$strPopUpSQL. "Error". $db_connected-->error, E_USER_ERROR);
		}
		else{
			$rows_returned = $detailPage->num_rows; //return the numebers of row
			// need some page when there is no page number
			
		}

		$rowPage = $detailPage->fetch_array(MYSQLI_ASSOC);  // fetch the data into a kind of record set

		echo '
		<title>'.
			$rowPage["ProductCode"].' 
		</title>
	
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
		<meta name="author"       		content="Eric Jang, janggyver@gmail.com" />
		<meta name="designer"       	content="JE Marriott, joe.marriott@nbcc.ca" />
		<meta name="keywords"			content="Bike, MTB, City bike, road bike, bike jacket"/>
		
		
		<link href="../include/ProductPage.css" type="text/css" rel="stylesheet" />  <!-- CSS for forms and footer -->
		<LINK href="../Include/Generic.css" TYPE="text/css" REL="STYLESHEET" />

		
		<script language = "javascript" src="../include/menuitems.js" type = "text/javascript"> </script>
		<script language = "javascript" src="../include/menu.js" type="text/javascript"></script>
		<script language = "javascript" src="../include/popupimage.js" type="text/javascript"></script>
		<script language = "javascript" src="../cart/PopUp.js" type="text/javascript"></script>		
		<!--Favicon -->
		<link rel="shortcut icon" href="../bike/favicon.ico">
	
	</head>
		
	<body>
	  ';
	  echo '<h3>'.$rowPage["ProductDescription"].'</h3>';
	  

?>		
	</body>
</html>
