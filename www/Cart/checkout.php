
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




	
<html>
	<head>

		<!--Deafault Page Set up -->
		
		<?php
		$PageID = 405;
		
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
	 	if (isset($_GET['checkout'])) {	

		// Write data to a order table
		


		
	   /*
		   * CHECKOUT
		   */
		   // unset variables
		   $_SESSION['cart'] = array();	//  empty array
		   unset($_SESSION['num_items']);
		   unset($_SESSION['num_products']);
		   // destroy the session
			session_destroy();	
	 	   echo '<br clear="all" />	<h1> Checked out successfully. Thank you very much.</h1><br />
		   		<!-- This page is return to shopping page after checking out.-->';
				session_start();
				$_SESSION['num_products'] =0;
			echo '	<p>
					<form name="shoppingagain_form" 
					action = "../products.php"
					method="POST">

						<input type="submit" value="Continue Shopping" name="continueshopping" >

					</form> ';


		}
		else {
			
				if ($_SESSION['num_items'] != 0) {
			
			echo '

				
				<!-- This page is to check out or return to shopping cart page.-->
				<h1> Are you sure to check out ?</h1>
				<p>
					<form name="checkout_form" 
					action = "checkout.php?checkout=1"
					method="POST">

								<a href="/../products.php"><input type="button" value="Continue Shopping" name="continueshopping"></a>
								<input type="submit" value="Check Out" name="checkout" onclick="javascript:window.location=Checkout.php?checkout=1">							
					</form> ';
				}
				else{
					echo '
							<br /><br /><a href="../products.php"><h2>Cart is empty now. Please pick happy goods first please. </h2>
							<img src="../images/continueshopping2.jpg" ></a>';
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
