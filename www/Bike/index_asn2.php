
<!-- Assignment 2 - Data Retrieving from database -->

<html>
  <head>
  
    <title>
      Road:Bike:BikePedia
    </title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <meta name="description"  		content="As fast as you can ride. Bike for a road" />
    <meta name="author"       		content="Eric Jang, janggyver@gmail.com" />
	<meta name="designer"       	content="JE Marriott, joe.marriott@nbcc.ca" />
	<meta name="keywords"			content="Bike, MTB, City bike, road bike, bike jacket"/>


	
    <link href="../Include/ProductPage.css" type="text/css" rel="stylesheet" />
	
	
  
  	<script language="javascript" src="../Include/menuitems.js" type="text/javascript"></script>
	<script language="javascript" src="../Include/menu.js" type="text/javascript"></script>
	<script language="javascript" src="../Include/PopUpImage.js" type="text/javascript"></script>
	
	<!--  Favicon  -->
	<link rel="shortcut icon" href="../bike/favicon.ico">

  </head>
  
  <body>
 
	<!-- Header -->
	<div id="Header">
	
  		 <div id="HeaderLeft">     
            <a href="../index.php"> <img height="30" alt="Home Page" src="../Images/BPlogo.gif" width="135" border="0" align="left" /> </a>
		 </div>
		 
		 <div id="HeaderRight">         
            <a href="../Cart/index.php" class="header">
			<img src="../Images/shoppingcart.gif" height="18" width="127" border="0" align="ABSMIDDLE" /> Contains 0 Items</a>
		 </div>
		          
    </div>
    <!-- End of Header  -->
	
	
	<!-- Menu Bar -->
	<div id="MenuBar">
   
   		 <div id="MenuBarLeft">
            <a href="../Reg/SignIn.php" class="headerbar">You are not signed in</a>
		 </div>
        
		 <div id="MenuBarRight">
            <a href="../Reg/SignIn.php" class="headerbar">| My Account</a> 
			<a href="../Cart/index.php" class="headerbar">| My Cart</a> 
			<a href="../Cart/Checkout.php" class="headerbar">| Checkout</a> 
			<a class="headerbar" href="../ContactUs.php">| Contact Us</a>
		</div>
         
	</div>
    <!-- End of Menu Bar -->
	
	
		<!-- "You Are Here" and Search -->
	<div id="Search"> 
   
   		 <div id="SearchLeft">
            <form action="../search/index.php" method="get">
				  <input type="text" name="txtsearch" value="Search" size="15" />
				  <input type="image" src="../images/go.gif" border="0" width="26" height="21"  align="middle" /> 
			</form>
		 </div>
        
		 <div id="YouAreHereList">		 	
			 <form action="">
				  <!-- Note how the appropriate menu item was selected -->
                  <select onchange="document.location=this.value" name="CatId">
                        <option value="index.php" selected="selected">Road</option>
                        <option value="mtb.php">MTB</option>
                        <option value="city.php">City</option>
                  </select>
             </form>
		 </div>
		
		 <div id="YouAreHereLinks">		 
		 	
			<a href="../index.php">Home</a> &raquo; 
			<a href="index.php">Bike</a> &raquo; &nbsp;
            
		 </div>
				         
	</div>	
	<!-- End of "You Are Here" and Search -->
	
		
	<!-- Main -->
	<div id="Main">	
	
	<?php
	// Database Connectivity 
	
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
	

	
	<?php
	//Retrieve Required record set
	
	//string of query for retrieve
	$strSQL = "SELECT ProductCode, ProductName, ProductDescription, Category, Department, ThumbnailHeight, RegularPrice, Option1Desc, Option1a, Option1b, Option1c, Option1d, Stock	
			FROM Products WHERE Category = 'Road' order by ProductCode";
				
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
	?>
	
	<!-- Debug Code -->
	<font color = "red"> Connected to :: <?php echo $db_name; ?> </font> <br />
	<font color = "green"> Using SQL :: <?php echo $strSQL; ?> </font> <br />
	<font color="blue"> Records Retrieved:: <?php echo $rows_returned; ?> <br/><br/>
	<!-- end of debug code -->
	
	
	<?php
	//Display individual products' information
	
	// Use loop for grabbing the each rows of data from the record set
	while($rowProd = $rsProd->fetch_array(MYSQLI_ASSOC)){

		echo '<div class="MainProduct">
				<!-- PopUpImage Script with internal label for linking to product code and name linking to large image -->
				<div class="MainProductImage">
					<a name = "'.$rowProd["ProductCode"].'"> </a> <a href="javascript:PopUpImage(\'Images/'.$rowProd["ProductCode"].'.jpg\', \''. $rowProd["ProductCode"].'\', 
								\''.$rowProd["ProductName"].'\')">
				<!-- Product code in thumbnail -->
				<img src="Images/'.$rowProd["ProductCode"].'_sm.jpg" border="0" height="93" width="100" hspace="25" /> </a>
				</div>
				<div class="MainProductText">
					<!-- Product Name linking to big image -->
					<b><a href="javascript:PopUpImage(\'Images/'.$rowProd["ProductCode"].'.jpg\', \''.$rowProd["ProductCode"].'\', \''.$rowProd["ProductName"].'\')">'.$rowProd["ProductName"].' </a></b>
					<br />
					<font class="small"> Product :: &nbsp; '.$rowProd["ProductCode"].' </font>
					<br/>
					<font class="price"> $ '.number_format($rowProd["RegularPrice"], 2, ".", ","). '</font>
					<br/>
					<p>'.$rowProd["ProductDescription"].' <br/><br/>';
					
					// Display Option1... currently changed to be dynamic, from database.													
					
					//Verify the options exist.
					
							
						if($rowProd["Option1Desc"]!=""){
							echo '
								<br clear=all /><br />'
								. $rowProd["Option1Desc"] . ' <br />
							<ul>';
						}
						else{
							echo ' <br />';
						}
						
						if($rowProd["Option1a"] !=""){
								echo '<li>'.
								$rowProd["Option1a"].'</li>';				
						}
						if($rowProd["Option1b"] !=""){
								echo '<li>'.
								$rowProd["Option1b"].'</li>';				
						}
						if($rowProd["Option1c"] !=""){
								echo '<li>'.
								$rowProd["Option1c"].'</li>';				
						}
						if($rowProd["Option1d"] !=""){
								echo '<li>'.
								$rowProd["Option1d"].'</li>';				
						}
						
						if($rowProd["Option1Desc"]!=""){
							echo '
							<br />
						</ul>' ;
						}
						echo	'
						
					
						
				<!--	// Display Option2... currently mostly hardcoded, but with some		-->					
				<!--	// provided code for inspiration. Change to be dynamic, from database.	-->				
               
								';	
				/*				
					if($rowProd["Option2Desc"]!=""){
							echo '
								<br clear=all /><br />'
								. $rowProd["Option2Desc"] . ' <br />
							<ul>';
						}
						else{
							echo ' <br /> <br />';
						}
						
						if($rowProd["Option2a"] !=""){
								echo '<li>'.
								$rowProd["Option2a"].'</li>';				
						}
						if($rowProd["Option2b"] !=""){
								echo '<li>'.
								$rowProd["Option2b"].'</li>';				
						}
						if($rowProd["Option2c"] !=""){
								echo '<li>'.
								$rowProd["Option2c"].'</li>';				
						}
						if($rowProd["Option2d"] !=""){
								echo '<li>'.
								$rowProd["Option2d"].'</li>';				
						}
						
						if($rowProd["Option2Desc"]!=""){
							echo '
						</ul>';		
						}
				*/
				echo '
				<!-- Note Product Code in URL parameter for shopping cart -->
				<a href="../Cart/index.php?product='.$rowProd["ProductCode"].'&quantity=1">
				<img alt="Add to Cart" src="../Images/addtocart.gif" border="0" align="right" width="74" height="21" /> </a>
				<br clear="ALL" /><br /><br />
				 <p  align="right"><a href="#Top" class="tiny">Back to Top</a></p>
				 <br /><br />
                 <hr width="80%" color="#3366cc" />
                 <br /><br /><br /><br />		
				
				
			</div>
		</div>';
					
	}
	
	//--end while loop
		?>		

		
		
		<!-- Footer -->
			<?php include ('../include/footer.php'); ?>		
	</div>
</div>  
	<!-- End of Main -->	
	
	<!-- Left Menu -->
	<!-- create_menu() is the "main engine" of the process to display the JavaScript-powered menu on the left 								-->
	<!-- The code is found in menu.js located in the Include directory 																		-->
	<!-- The actual menu items themselves are found in the array LeftMenuLinks found in menuitems.js located in the Include directory 		-->
	<!-- Note how LeftMenuLinks are passed to the function create_menu() as a paramter.														-->
	<!-- To create an entirely new menu (ie for an entirely different type of type), all you need to do is create another file of "links" 	-->
	<!-- and reference that instead.  There are other ways too if you think about it.														-->

	
<div id="LeftMenu">	
		 <script language="javascript" type="text/javascript">create_menu('LeftMenu', LeftMenuLinks, LeftMenuProps);</script >	
</div>
	<!-- End of Left Menu -->
	
	
	
	
	<!-- Left Ads -->
	
	<?php include ('../Include/LeftAds.php'); ?>
		
	<!-- End of Left Ads -->
	
	
	
	
  </body>
  
<!-- 2016.09.30 -->	
</html>