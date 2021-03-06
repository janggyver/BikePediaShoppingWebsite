
<!-- Assignment 2 - Data Retrieving from database -->
<!-- Second Department index Page -->


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

	<?php
	// get the page ID from parameter
	$PageID = empty($_GET['PageID'])? "" : $_GET['PageID'];

	if($PageID == 0){
		$PageID = 200;
	}
	?>	
	
	<?php
	//Retrieve Required record set
	
	//string of query for retrieve
	$strSQLPage = "SELECT PageID, Category, Department, MetaDesc	
			FROM pagedetails WHERE PageID like '$PageID' order by PageID";
				
	//declaring record set
	$rsPage = $db_connected->query($strSQLPage);
	
	//check whether the sql is right and how many data are
	
	if($rsPage == false){
		trigger_error("Wrong SQL: ".$strSQLPage. "Error".$db_connected->error, E_USER_ERROR);
	}
	else{
		$rows_returned = $rsPage->num_rows; // return the numbers of row
	}
	
	// if the returned rows value 0, then show this message
	if($rows_returned == 0){
		$PageID = 200;
		$strSQLPage = "SELECT PageID, Category, Department, MetaDesc	
			FROM pagedetails WHERE PageID = $PageID order by PageID";
		$rsPage = $db_connected->query($strSQLPage);
	//	die($db_name." : ".$strSQLPage. " : No records retrieved.");  // why "" used instead of ''
	//echo ' <h2> There is no page of '.$PageID. '. Please retry!!!';
	}
	
	//end of required record set retrieving
	?>


<html>


   <?php
	if($rowPage = $rsPage->fetch_array(MYSQLI_ASSOC)){
		// determine what the page is comparing to the value retrieved

		if ($PageID != $rowPage["PageID"]){
			echo ' The Page ID'.$PageID.' does not Exist ';
		}

		else{
			$strCategory = $rowPage["Category"];
			$strDepartment = $rowPage["Department"];
			$strMetaDesc = $rowPage["MetaDesc"];
		echo '
	<head>
	<title>'.

			$strCategory.' : '.$strDepartment.' : BikePedia
	</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <meta name="description"  		content="'.$strMetaDesc.'" />
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
				  ';
				  if ($PageID == 200){
				  		echo '		  
						<option value="/../clothing/index.php?PageID=200" selected="selected">'.$strCategory.'</option>
				        <option value="/../clothing/index.php?PageID=201"> Pants </option>
                        <option value="/../clothing/index.php?PageID=202"> Cap </option>';
				  }
				  else if ($PageID == 201){
				  		echo '		  

						<option value="/../clothing/index.php?PageID=200">Jacket</option>
				        <option value="/../clothing/index.php?PageID=201" selected="selected">'.$strCategory.'</option>
                        <option value="/../clothing/index.php?PageID=202">Cap</option>';
				  }
				  else if ($PageID == 202){
				  		echo '		  

						<option value="/../clothing/index.php?PageID=200">Jacket</option>
				        <option value="/../clothing/index.php?PageID=201" >Pants</option>
                        <option value="/../clothing/index.php?PageID=202" selected = "selected">'.$strCategory.'</option>';
				  }
				  				  
				  
				  
				  
				  echo '
						
                  </select>
             </form>
		 </div>
		
		 <div id="YouAreHereLinks">		 
		 	
			<a href="../index.php">Home</a> &raquo; 
			<a href="index.php">'.$rowPage["Department"].'</a> &raquo; &nbsp;
            
		 </div>
				         
	</div>	
	<!-- End of "You Are Here" and Search -->
	
		
	<!-- Main -->
	<div id="Main">	
	
		';
		/*
	<!-- Debug Code -->
	<font color = "red"> Connected to ::'.$db_name.' </font> <br />
	<font color = "green"> Using SQL ::'.$strSQLPage.'</font> <br />
	<font color="green"> Records Retrieved::'.$rows_returned.'<br/><br/>
	<!-- end of debug code -->
	*/


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
	while($rowProd = $rsProd->fetch_array(MYSQLI_ASSOC)){

		echo '<div class="MainProduct">
				<!-- PopUpImage Script with internal label for linking to product code and name linking to large image -->
				<div class="MainProductImage">
	<a name = "'.$rowProd["ProductCode"].'"> </a> <a href="javascript:PopUpImage(\'/../'.$rowProd["Department"].'/Images/'.$rowProd["ProductCode"].'.jpg\', \''. $rowProd["ProductCode"].'\', 
								\''.$rowProd["ProductName"].'\')">
				<!-- Product code in thumbnail -->
				<img src="/../'.$rowProd["Department"].'/Images/'.$rowProd["ProductCode"].'_sm.jpg" border="0" height="93" width="100" hspace="25" /> </a>
				</div>
				<div class="MainProductText">
					<!-- Product Name linking to big image -->
					<b><a href="javascript:PopUpImage(\'/../'.$rowProd["Department"].'/Images/'.$rowProd["ProductCode"].'.jpg\', \''.$rowProd["ProductCode"].'\', \''.$rowProd["ProductName"].'\')">'.$rowProd["ProductName"].' </a></b>
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
				echo		
				 '
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
	
	
		//<!-- Footer -->
		include ('/../include/footer.php');
		echo '
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
		 <script language="javascript" type="text/javascript">create_menu(\'LeftMenu\', LeftMenuLinks, LeftMenuProps);</script >	
</div>
	<!-- End of Left Menu -->
	
	
	
	
	<!-- Left Ads -->
	
	';
	include ('/../Include/LeftAds.php');
	
	echo '
		
	<!-- End of Left Ads -->
	
	
	
	
  </body>';
	} 
	//break;
	}?>
<!-- 2016.09.30 -->	
</html>