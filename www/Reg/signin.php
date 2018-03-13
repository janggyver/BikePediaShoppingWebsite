<!-- Session Start -->
<?php
	session_start();
?>
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
		$PageID = 400;
		
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
			$rows_returned = $detailPage->num_rows; //return the numebers of row
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
				<option value="index.php" selected="selected">'.$rowPage["Category"].'</option>
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


<?php
	
if (isset($_SESSION["userLoggedIn"])) {
	// Check if the session variable has already been registered
						echo '<h1> Hi &nbsp;' . $_SESSION["FullName"] . ', ';
						echo 'you are already logged in! </h1>';
						echo'
							<form name = "signout" action="/reg/signout.php"
								onsubmit = "return confirm(\'Do you really want to sign out?\')"> 
								<input type = "submit" value="Sign Out" >
							</form>';
} 
else {
	// Check that the login form was submitted
		if (isset($_POST["username"])) {
		//Debug code
		//echo $_POST["username"];
		// check the username
		$strSQLLogin = "select EmailAddress, Password, FirstName, LastName, admin from Customer where EmailAddress = '".$_POST["username"]."'";
		$rsCust = $db_connected->query($strSQLLogin);
			if($rsCust->num_rows==0){
				echo '<h1> Your Email Address is not registered or incorrect.</h1><br>
							<form name = "retry" action="/reg/signin.php"> 
								<input type = "submit" value="Retry Sing In">
							</form>
						<h2>Please click above button to retry login. </h2>';
			}
			else
			{

				// Check the password
				$rowCust = $rsCust->fetch_array(MYSQLI_ASSOC);
				if (sha1($_POST["password"]) == $rowCust["Password"]) {
						//echo sha1($_POST['password']);
						$_SESSION["userLoggedIn"] = $_POST["username"];
						$_SESSION["FirstName"] = $rowCust["FirstName"];
						$_SESSION["LastName"] = $rowCust["LastName"];
						$_SESSION["FullName"] = $_SESSION["FirstName"]." ".$_SESSION["LastName"];
						$_SESSION["Admin"] = $rowCust["admin"];
					//	$_SESSION["FullName"] = $rowCust["FirstName"]." ".$rowCust["LastName"]; 

						echo '<h1> Hello &nbsp;' . $_SESSION["FullName"] . ', ';
						echo 'you\'ve successfully logged in! </h1>';
						echo'
							<form name = "signout" action="/reg/signout.php"
								onsubmit = "return confirm(\'Do you really want to sign out?\')"> 
								<input type = "submit" value="Sign Out" >
							</form>';
	
						
				}
				else {
				echo '<h1> Your Password is incorrect.</h1><br>
							<form name = "retrypassword" action="/reg/signin.php"> 
								<input type = "submit" value="Retry Sign In">
							</form>
						<h2>Please click above button to retry login. </h2>';
					}
			}
		}
		else {
		// Display login form
		echo '
		
		<!-- This page "loops back" onto itself when form is submitted because action is not set to any other page. -->
		<!-- method="POST" passes form control contents via local memory.                                           -->
		<h1> Please enter the "User Name" and "Password" you registered to log in. </h1>

			<form name="login_form" 
			action=""
			method="POST">

					<label for= "username" > User Name: </label>
					<input type="text" name="username" size="25">
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- User Name is a format of Email Address (ie  id@gmail.com)

				<p>

					<label for= "password" > Password: </label>
				&nbsp;	<input type="password" name="password" size="25" >

				<p>
						<input type="submit" value="Login" name="login">				
				<p>
				<p>
			</form>

			<form name="registration_form" 
			action="index.php"
			method="POST">

						<input type="submit" value="Registration" name="registration" onclick="javascript:window.location=http://localhost/reg/index.php">				
							- If you didn\'t register, please click "Registration" button. 
			</form>

		';
	}
	}
?>





	
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
