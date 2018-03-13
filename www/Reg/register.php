
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
 $strPassword = $_COOKIE['Password'];
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
 $strCreditCardNumber = $_COOKIE['CreditCardNumber']; 
 
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
		$PageID = 401;
		
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
	<h1> Please confirm your information you entered. </h1>

	<!-- Registration Form -->
	
	<!-- Description of FORM tag :: 																				-->
	<!-- Unique NAME is necessary for each form on your page						  								-->
	<!-- ACTION tells form what page it goes to when form is submitted.  											-->
	<!-- METHOD "GET" passes the form elements and their values through URL parameters  							-->
	
		
	<form 	name="frmCustReg"
			onsubmit="return Confirm('Your registration is completed. Please enjoy the shopping')" 
			action="successreg.php" 
			onreset="return confirm('Do you really want to reset and modify the form?')" 
			action ="index.php"
			method="post">
		
		<div id="RegForm" >
		
			<div class="RegFormFullColFirst">
				Email Address:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtEmailAddress" size = "25" maxlength="25" value="<?php echo $strEmailAddress ?>">
			</div>
		
			<br><br>
			
			<div class="RegFormFullColFirst" >
			Password:			
			</div>
			
			<div class="RegFormFullColSecond">
				<input type="password" name="txtPassword" size="25" maxlength="25" value="<?php echo $strPassword ?>">
			</div>
			
			<br><br>
			<div class="RegFormFullColFirst">
			Confirm Password:
			</div>
			<div class="RegFormFullColSecond">
				<input type="password" name="txtConfirmPassword" size="25" maxlength="25" value="<?php echo $strConfirmPassword ?>">
			</div>

			<br><br><br>
			<div class="RegFormFullColFirst">
			Title:
			</div>
			<div class="RegFormFullColSecond">

				<select type ="text" size="1" name="cboTitle"> 
							<?php 
								// I adopted below from the demo form code.
								for ($i=0; $i<4; $i++) {
									echo "<OPTION";
									if ($strTitleIndex==$i) 
										echo ' selected="yes"';
									echo ">";
									switch ($i) {
										case 0:
											echo "Mr.";
											break;
										case 1:
											echo "Miss";
											break;
										case 2:
											echo "Mrs.";
											break;
										case 3:
											echo "Ms.";
											break;
										default:
											echo "No Title is found";
											break;
										
									}
									echo "</OPTION>";
								}

							?>
				</select>
				
			</div>
			
			<br><br>
			<div class="RegFormFullColFirst">
			First Name: 
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtFirstName" size="25" maxlength="25" value="<?php echo $strFirstName ?>">
			</div>

			<br><br>
			<div class="RegFormFullColFirst">
			Last Name:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtLastName" size="25" maxlength="25" value="<?php echo $strLastName ?>">
			</div>

			<br><br>
			<div class="RegFormLeftCol">
			Home Telephone: 
			</div>
			<div class="RegFormLeftColSecond">
			<input type="text" name="txtArea" size="2" maxlength="3" value="<?php echo $strAreaCode ?>"> 
				<input type="text" name="txtLocal" size="2" maxlength="3" value="<?php echo $strLocalCode ?>">
				<input type="text" name="txtLastDigit" size="3" maxlength="4" value="<?php echo $strLastDigit ?>">
			</div>
			<div class="RegFormRightCol">
			Work Telephone: 
			</div>
			<div class="RegFormRightColSecond">
				<input type="text" name="txtArea2" size="2" maxlength="3" value="<?php echo $strAreaCode2 ?>">
				<input type="text" name="txtLocal2" size="2" maxlength="3" value="<?php echo $strLocalCode2 ?>">
				<input type="text" name="txtLastDigit2" size="3" maxlength="4" value="<?php echo $strLastDigit2 ?>">
			</div>			
			
			<br><br>
			<div class="RegFormFullColFirst">
			Address Line 1:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtAddressLine1" size="25" maxlength="50" value="<?php echo $strAddressLine1 ?>">
			</div>
			
			<br><br>
			<div class="RegFormFullColFirst">
			Address Line 2:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtAddressLine2" size="25" maxlength="50" value="<?php echo $strAddressLine2 ?>">
			</div>
			
			<br><br>
			<div class="RegFormFullColFirst">
			Province: 
			</div>
			<div class="RegFormFullColSecond">
				<select type ="text" size="1" name="cboProvince"> 
							<?php 
								// I adopted below from the demo form code.
								for ($i=0; $i<9; $i++) {
									echo "<OPTION";
									if ($strProvinceIndex==$i) 
										echo ' selected="yes"';
									echo ">";
									switch ($i) {
										case 0:
											echo "Alberta";
											break;
										case 1:
											echo "British Columbia";
											break;
										case 2:
											echo "Manitoba";
											break;
										case 3:
											echo "New Brunswick";
											break;
										case 4:
											echo "Nova Scotia";
											break;
										case 5:
											echo "Newfoundland and Labrador";
											break;
										case 6:
											echo "Ontario";
											break;
										case 7:
											echo "Prince Edward Island ";
											break;
																				
										case 8:
											echo "Saskatchewan";
											break;
										
									}
									echo "</OPTION>";
								}

							?>
				</select>
				

				
			</div>
			
			<br><br><br>
			<div class="RegFormLeftCol">
			Credit Card Type: 
			</div>
			<div class="RegFormLeftColSecond">

				<select type ="text" size="1" name="cboCreditCard"> 
							<?php 
								// I adopted below from the demo form code.
								for ($i=0; $i<3; $i++) {
									echo "<OPTION";
									if ($strCreditCardIndex==$i) 
										echo ' selected="yes"';
									echo ">";
									switch ($i) {
										case 0:
											echo "AMEX";
											break;
										case 1:
											echo "VISA";
											break;
										case 2:
											echo "Master";
											break;
								
									}
									echo "</OPTION>";
								}

							?>
				</select>
			</div>
			<div class="RegFormRightCol">
			Card Number: 
			</div>
			
			<div class="RegFormRightColSecond">
			<input type="text" name="txtCreditCardNumber" size="20" maxlength="16" value="<?php echo $strCreditCardNumber ?>"> &nbsp;
			</div>

			<br><br>
			<div class="RegFormLeftCol">
			Expiry Date Month: 
			</div>
			
			<div class="RegFormLeftColSecond">
				<select type ="text" size="1" name="cboProvince"> 
							<?php 
								// I adopted below from the demo form code.
								for ($i=0; $i<12; $i++) {
									echo "<OPTION";
									if ($strExpiryMonthIndex==$i) 
										echo ' selected="yes"';
									echo ">";
									switch ($i) {
										case 0:
											echo "January";
											break;
										case 1:
											echo "February";
											break;
										case 2:
											echo "March";
											break;
										case 3:
											echo "April";
											break;
										case 4:
											echo "May";
											break;
										case 5:
											echo "June";
											break;
										case 6:
											echo "July";
											break;
										case 7:
											echo "August";
											break;
																				
										case 8:
											echo "September";
											break;
										case 9:
											echo "October";
											break;
										case 10:
											echo "November";
											break;
																				
										case 11:
											echo "December";
											break;
																				
									}
									echo "</OPTION>";
								}

							?>
				</select>
			</div>

			<div class="RegFormRightCol">
			Expiry Date Year: 
			</div>
			
			<div class="RegFormRightColSecond">

				<select type ="text" size="1" name="cboYear"> 
							<?php 
								// I adopted below from the demo form code.
								for ($i=0; $i<4; $i++) {
									echo "<OPTION";
									if ($strExpiryYearIndex==$i) 
										echo ' selected="yes"';
									echo ">";
									switch ($i) {
										case 0:
											echo "2016";
											break;
										case 1:
											echo "2017";
											break;
										case 2:
											echo "2018";
											break;
										case 3:
											echo "2019";
											break;
																				
									}
									echo "</OPTION>";
								}
										?>
				</select>
			</div>
			
			<br><br> <br>
			<div class="RegFormFullColFirst">
			Card Holder Name: 
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtCardHolderName" size="25" maxlength="25" value="<?php echo $strCardHolderName ?>">
			</div>

			<br><br><br>
			<div class="RegFormFullColFirst">
			Language Preference:
			</div>
			<div class="RegFormFullColSecond">
				<input type="radio" name="optLanguage" value="English" <?php echo ($strLanguage=='English')?('CHECKED="CHECKED"'):('') ?> > English 
			<input type="radio" name="optLanguage" value="Francais" <?php echo ($strLanguage =='Francais') ? ('checked="CHECKED"') : ('') ?>>  Francais	
			<input type="radio" name="optLanguage" value="Espanol" <?php echo ($strLanguage==='Espanol') ? ('checke="CHECKED"') :('') ?> > Espanol 
			</div>
			
			<div class="RegFormButtons">
					<input type="submit" value="Confirm" name="cmdConfirmButton" onclick="javascript:window.location='http://localhost/reg/successreg.php'">
					<input type="reset" value="Modify" name="cmdModifyButton" onclick="javascript:window.location='http://localhost/reg/index.php'" >
			</div>
		</div>

		</form>	
	<!-- End of Form -->			


	
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
