<!-- Assignment 2 - Display all pages with one page -->


<!-- Assignment 2 - Data Retrieving from database -->

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
		<!-- Default Page Set up -->
<!--	<base href="/products.php?PageID=100" target="_blank">  -->
	
		<?php
	// get the page ID from parameter
	$PageID = empty($_GET['PageID'])? "" : $_GET['PageID'];
	if($PageID ==0){
		$PageID = 100;
	//or $PageID != 'PageID'
	}
	?>	
	
		
	<?php
	//Retrieve Required record set
	
	//string of query for retrieve
	$strSQLPage = "SELECT PageID, Category, Department, MetaDesc	
			FROM pagedetails where PageID = '$PageID' order by PageID";
				
	//declaring record set (or sql result)
	$detailPage = $db_connected->query($strSQLPage);
	
	//check whether the sql is right and how many data are
	
	if($detailPage == false){
		 trigger_error("Wrong SQL: ".$strSQLPage. "Error".$db_connected->error, E_USER_ERROR);
		// '/ 			echo '        <script type="text/javascript"/
  //         window.location.href = "/products.php?PageID=100"
//       </script>';
	}
	else{
		$rows_returned = $detailPage->num_rows; // return the numbers of row
	}
	
	// if the returned rows value 0, then show this message
	if($rows_returned == 0){

		
		die($db_name." : ".$strSQLPage. " : No records retrieved.");  // why "" used instead of ''
 //			echo '        <script type="text/javascript">
 //          window.location.href = "/products.php?PageID=100"
 //      </script>';
	}
	
	//end of required record set retrieving
	?>
	
	
	
   <?php
	if($rowPage = $detailPage->fetch_array(MYSQLI_ASSOC)){
		// determine what the page is comparing to the value retrieved
/*
		if ($PageID != $rowPage["PageID"]){
			echo '        <script type="text/javascript">
            window.location.href = "/products.php?PageID=100"
        </script>';
		}

		else{  */
			$strCategory = $rowPage["Category"];
			$strDepartment = $rowPage["Department"];
			$strMetaDesc = $rowPage["MetaDesc"];   
			
		echo '
	
	<title>'.
	$strCategory.' : '.$strDepartment.' : BikePedia
	</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <meta name="description"  		content="'.$strMetaDesc.'" />
    <meta name="author"       		content="Eric Jang, janggyver@gmail.com" />
	<meta name="designer"       	content="JE Marriott, joe.marriott@nbcc.ca" />
	<meta name="keywords"			content="Bike, MTB, City bike, road bike, bike jacket"/>


	
    <link href="../Include/ProductPage.css" type="text/css" rel="stylesheet" />
	
	  
  	<script language="javascript" src="/Include/menuitems2.js" type="text/javascript"></script>
	<script language="javascript" src="/Include/menu.js" type="text/javascript"></script>
	<script language="javascript" src="/Include/PopUpImage.js" type="text/javascript"></script>
	
	<!--  Favicon  -->
	<link rel="shortcut icon" href="../bike/favicon.ico">
  </head>
  
  <body> ';
   
  //Header
	include ('/include/header.php');

 // Menubar
	include ('/include/menubar.php');	
	
//"You Are Here" and Search 
		include ('/include/search.php');
		echo '
	
        
		
		 <div id="YouAreHereList">
		
			 <form action="">
				  <!-- Note how the appropriate menu item was selected -->
                  <select onchange="document.location=this.value" name="CatId">
	
				
				  ';
				  /*
				  if ($rsPage["PageID" = $PageID]){
					  		$destID = $rowPageID;
							$destCategoryName = $rowPage["Cagegory"];
							break;
					  
				  }
				  */
			echo'
				  
				  
				  
				  
				  
				  
				  
		<option value="/../clothing/index_clothing.php?PageID='.$rowPage["PageID"].'  selected="selected">'.$strCategory.'</option>  <!--I will change the path later -->
				  
                        <option value="/../clothing/index_clothing.php?PageID='.$rowPage["PageID"].'"> MTB</option>
                        <option value="/../clothing/index_clothing.php?PageID='.$rowPage["PageID"].'"> City</option>
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
			echo $strCategory;
			echo $strDepartment;
			echo $strMetaDesc;   
			
	
	
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
		include ('/include/footer.php');
		echo '
	</div>
</div>  
	<!-- End of Main -->	';
	
	
	//Left Menu
	include ('/include/leftmenu.php');
	
	//Left Ads
	include ('/Include/LeftAds.php');
	
	echo '
		
	<!-- End of Left Ads -->
	
	
	
	
  </body>';
//	} 
	//break;
	}?>
<!-- 2016.09.30 -->	
</html>