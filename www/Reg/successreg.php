
<!-- Connecting to Database -->
<?php
	session_start();
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

	
	
<!-- Retrieve the cookies written in registration form -->
<?php
 $strEmailAddress = $_COOKIE['EmailAddress'];
 $strPassword = sha1($_COOKIE['Password']);
 $strConfirmPassword = $_COOKIE['ConfirmPassword'];
 $strFirstName = $_COOKIE['FirstName'];
 $strLastName = $_COOKIE['LastName'];
 $strAreaCode = $_COOKIE['AreaCode'];
 $strLocalCode = $_COOKIE['LocalCode'];
 $strLastDigit = $_COOKIE['LastDigit'];
 $strAreaCode2 = $_COOKIE['AreaCode2'];
 $strLocalCode2 = $_COOKIE['LocalCode2'];
 $strLastDigit2 = $_COOKIE['LastDigit2'];
 $strAddressLine1 = $_COOKIE['AddressLine1'];
 $strAddressLine2 = $_COOKIE['AddressLine2'];
 $strCardHolderName = $_COOKIE['CardHolderName'];
 $strCreditCardNumber = sha1($_COOKIE['CreditCardNumber']); 
 
 $strLanguage = $_COOKIE['Language'];

// $strCreditCard = $_COOKIE['CreditCard'];

 $strTitleIndex = $_COOKIE['TitleIndex'];
 $strTitleText = $_COOKIE['TitleText']; 
 $strProvinceIndex = $_COOKIE['ProvinceIndex'];
 $strProvinceText = $_COOKIE['ProvinceText']; 
 $strCreditCardIndex = $_COOKIE['CreditCardIndex'];
 $strCreditCardText = $_COOKIE['CreditCardText']; 
 
 $strExpiryMonthIndex = $_COOKIE['ExpiryMonthIndex'];
 $strExpiryMonthText = $_COOKIE['ExpiryMonthText'];
 $strExpiryYearIndex = $_COOKIE['ExpiryYearIndex'];
 $strExpiryYearText = $_COOKIE['ExpiryYearText'];
 
?>



	
<html>
	<head>

		<!--Deafault Page Set up -->
		
		<?php
		$PageID = 402;
		
		//Retrieve from the database
		
		$strSQLPage = "select PageID, Category, Department, MetaDesc from 
						pagedetails where PageID like '$PageID'";
		$detailPage = $db_connected ->query($strSQLPage);
		$rowPage = $detailPage -> fetch_array(MYSQLI_ASSOC);  // fetch the data into a kind of record set
		
		//Error Checking
		if($detailPage == false){
			trigger_error("Wrong SQL: ".$strSQLPage. "Error". $db_connected-->error, E_USER_ERROR);
		}
		else{
			$rows_returned = $detailPage -> num_rows; //return the numebers of row
			// need some page when there is no page number
			
		}
		
		
		echo '
		<title>'.
			$rowPage["Category"]. ' : '.$rowPage["Department"].' : BikePedia 
		</title>
	
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
		<meta name="description"  		content="'.$rowPage["MetaDesc"].'" />
		<meta name="author"       		content="Eric Jang, janggyver@gmail.com" />
		<meta name="designer"       	content="JE Marriott, joe.marriott@nbcc.ca" />
		<meta name="keywords"			content="Bike, MTB, City bike, road bike, bike jacket"/>
		
		
		<link href="../include/ProductPage.css" type="text/css" rel="stylesheet" />  <!-- CSS for forms and footer -->
		<LINK href="../Include/Generic.css" TYPE="text/css" REL="STYLESHEET" />

		
		<script language = "javascript" src="../include/menuitems2.js" type = "text/javascript"> </script>
		<script language = "javascript" src="../include/menu.js" type="text/javascript"></script>
		<script language = "javascript" src="../include/popupimage.js" type="text/javascript"></script>
		
		<!--Favicon -->
		<link rel="shortcut icon" href="../bike/favicon.ico">
	
	</head>
		
	<body> ';
	
		//Same contents from the other pages

		
		//header
		include ('../include/header.php');
		
		// Menubar
		include ('../include/menubar.php');
	
	
	
		//Search & you are here
		include ('../include/search.php');
	echo '	
   
	<div id="YouAreHereList">
		<form action="">
			<select onchange="document.location=this.value" name="CatID">
				<option value="index.php" selected="selected">'.$rowPage["Department"].'</option>
				<option value="../products.php?PageID=100" > Bike</option>
				<option value="../clothing/index.php" > Clothing</option>
				<option value="../equipment/index.php" > Equipment</option>
			</select>
		</form>
	</div>
	
	<div id="YouareHereLinks">
		<a href="../index.php">Home </a> &raquo;
<!--		<a href="../reg/index.php">Registration </a> &raquo; &nbsp; -->
	</div>
</div>

<!-- End of "You Are Here" and Search -->';
		
		
		
	
	?>

	

	
<!--Main -->
<div id="Main">




	<!--Writing cookies into database "Customer" table -->
	<?php 
	$strSQLWriteDB = "INSERT INTO customer (EmailAddress, Password, TitleName, FirstName, LastName, AreaCode, LocalCode, LastDigit, AreaCode2, LocalCode2, LastDigit2, AddressLine1, AddressLine2, Province, CreditCardType, ExpiryMonth, CardHolderName, Language, ExpiryYear, CreditCardNumber) VALUES ('$strEmailAddress', '$strPassword', '$strTitleText', '$strFirstName', '$strLastName', '$strAreaCode', '$strLocalCode', '$strLastDigit', '$strAreaCode2', '$strLocalCode2', '$strLastDigit2', '$strAddressLine1', '$strAddressLine2', '$strProvinceText', '$strCreditCardText', '$strExpiryMonthText', '$strCardHolderName', '$strLanguage', '$strExpiryYearText', '$strCreditCardNumber')";

	$writeResult = $db_connected ->query($strSQLWriteDB);

	if (!$writeResult)
      {
      die('Error: ' . mysqli_error($db_connected));
      }
	    mysqli_close($db_connected);
    echo '<h1> Thanks for your registration,&nbsp;'.$strTitleText.'&nbsp;'.$strLastName;

    ?>

	 <a href = "http://localhost/reg/signin.php"> <h1><font color = "red"> Please click here to Sign In <Click!!!> </font> </h1></a>
	
		  <!-- Footer -->
		  <?php include('../include/footer.php') ?>
</div>		

<!-- End of Main -->


	
	
	
	


		<?php
		
			//Left Menu
			include ('../include/leftmenu.php');
			
			//Left Ads
			include ('/../Include/LeftAds.php');
			
			echo '
				
			<!-- End of Left Ads -->';
			
		
		?>
		
	</body>
</html>
