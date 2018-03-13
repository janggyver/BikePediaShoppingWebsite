<!-- Assignment 2 - Display all pages with one page -->


<!-- Assignment 2 - Data Retrieving from database -->

<!-- Connecting to Database -->
<?php
	session_start();
	if(!isset($_SESSION['num_products'])){
		$_SESSION['num_products'] =0;
	}
	
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
			FROM pagedetails where PageID like '$PageID' order by PageID";
				
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
		$PageID = 100;
			$strSQLPage = "SELECT PageID, Category, Department, MetaDesc	
			FROM pagedetails where PageID = '$PageID' order by PageID";
		$detailPage = $db_connected -> query($strSQLPage);
		
//		die($db_name." : ".$strSQLPage. " : No records retrieved.");  // why "" used instead of ''
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
	<link rel="stylesheeet" type="text/css" href="../include/ajaxCommnet.css" />
	  
  	<script language="javascript" src="/include/menuitems2.js" type="text/javascript"></script>
	<script language="javascript" src="/include/menu.js" type="text/javascript"></script>
	<script language="javascript" src="/include/PopUpImage.js" type="text/javascript"></script>
	<script language="javascript" src="/include/PopUp.js" type="text/javascript"></script>
	<script type="text/javascript" src="/include/jquery-1.3.2.min.js"></script>
	
	
	<!-- Move this part to .js --> 
		<script language="javascript" type="text/javascript">
					
			function PopUp(url , w, h) {
			window.open ( url, \'PopUp\',
			\'width=\' + w + \',height=\' + h + \',toolbar=no,directories=no,status=no,scrollbars=no\' + \',resizable=no,menubar=no,location=no,copyhistory=no\'
			);
			}
			</script>
	
	
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
                  <select onchange="document.location=this.value" name="CatId">';
				  if ($PageID == 100){
				  		echo '						  
						<option value="/products.php?PageID=100" selected="selected">'.$strCategory.'</option>
				        <option value="/products.php?PageID=101"> MTB </option>
                        <option value="/products.php?PageID=102"> City </option>';	  

				  }
				  else if ($PageID == 101){
				  		echo '		  

						<option value="/products.php?PageID=100">Road</option>
				        <option value="/products.php?PageID=101" selected="selected">'.$strCategory.'</option>
                        <option value="/products.php?PageID=102">City</option>';
				  }
				  else if ($PageID == 102){
				  		echo '		  

						<option value="/products.php?PageID=100">Road</option>
				        <option value="/products.php?PageID=101" >MTB</option>
                        <option value="/products.php?PageID=102" selected = "selected">'.$strCategory.'</option>';
				  }
		


				  
				  else if ($PageID == 200){
				  		echo '		  
						<option value="/products.php?PageID=200" selected="selected">'.$strCategory.'</option>
				        <option value="/products.php?PageID=201"> Pants </option>
                        <option value="/products.php?PageID=202"> Cap </option>';
				  }
				  else if ($PageID == 201){
				  		echo '		  

						<option value="/products.php?PageID=200">Jacket</option>
				        <option value="/products.php?PageID=201" selected="selected">'.$strCategory.'</option>
                        <option value="/products.php?PageID=202">Cap</option>';
				  }
				  else if ($PageID == 202){
				  		echo '		  

						<option value="/products.php?PageID=200">Jacket</option>
				        <option value="/products.php?PageID=201" >Pants</option>
                        <option value="/products.php?PageID=202" selected = "selected">'.$strCategory.'</option>';
				  }
		

				
				  else if ($PageID == 300){
				  		echo '		  
						<option value="/products.php?PageID=300" selected="selected">'.$strCategory.'</option>
				        <option value="/products.php?PageID=301"> Eyewear </option>
                        <option value="/products.php?PageID=302"> Lights </option>';
				  }
				  else if ($PageID == 301){
				  		echo '		  

						<option value="/products.php?PageID=300">Helmet</option>
				        <option value="/products.php?PageID=301" selected="selected">'.$strCategory.'</option>
                        <option value="/products.php?PageID=302">Lights</option>';
				  }
				  else if ($PageID == 302){
				  		echo '		  

						<option value="/products.php?PageID=300">Helmet</option>
				        <option value="/products.php?PageID=301" >Eyewear</option>
                        <option value="/products.php?PageID=302" selected = "selected">'.$strCategory.'</option>';
				  }
				  			
			echo '				
                  </select>
             </form>
		 </div>
		
		 <div id="YouAreHereLinks">';

			 if ( $rowPage["PageID"][0] == 1){
					echo '		
					<a href="/index.php">Home</a> &raquo; 
					<a href="/products.php?PageID=100">'.$rowPage["Department"].'</a> &raquo; &nbsp; ';
			  }
			  
			  else if( $rowPage["PageID"][0] == 2){
					echo '			
		 	
						<a href="/index.php">Home</a> &raquo; 
						<a href="/products.php?PageID=200">'.$rowPage["Department"].'</a> &raquo; &nbsp; ';
			  }
			  
			  else if( $rowPage["PageID"][0] == 3){
					echo '			
		 	
						<a href="/index.php">Home</a> &raquo; 
						<a href="/products.php?PageID=300">'.$rowPage["Department"].'</a> &raquo; &nbsp; ';
			  }			  
			  echo '
		 </div>
				         
	</div>	
	<!-- End of "You Are Here" and Search -->
	
		
	<!-- Main -->
	<div id="Main">	
	
';


	
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
				<img src="/../'.$rowProd["Department"].'/Images/'.$rowProd["ProductCode"].'_sm.jpg" border="0" height="'.$rowProd["ThumbnailHeight"].'" width="100" hspace="25" /> </a>
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

				?>
				<?php
				if(($rowProd["Stock"] > 0) && ($_SESSION['num_products'] >0) ){
					echo		
								 '
								<!-- Note Product Code in URL parameter for shopping cart -->
								<a href="../Cart/index.php?product='.$rowProd["ProductCode"].'&quantity=1">
								<img alt="Add to Cart" src="../Images/addtocart.gif" border="0" align="right" width="74" height="21" /> </a>
								<br clear="ALL" /><br /><br />';		
						
						if (isset($_SESSION['num_products'])){
						
						for($i=0; $i<$_SESSION['num_products'];$i++){
							if ($_SESSION['cart'][$i]['name'] 	== 	$rowProd["ProductCode"]){

								$InStock = $rowProd["Stock"]-$_SESSION['cart'][$i]["qty"];
								//$rowProd["Stock"]=$inStock;
								if($InStock >0 ){

									echo $InStock.'   in Stock <br>';
								}
								if($_SESSION['cart'][$i]["qty"]>0){
										echo $_SESSION['cart'][$i]['qty'].' in cart';	
								}
								else{
	
							//	echo $_SESSION['cart'][$i]['qty'].' in cart <br>';
									echo '<h3>Sorry. This product is temporarily out of stock.</h3>';						
									
								}
							}
							else{
									echo $rowProd["Stock"].'  in Stock <br>';								
							}
						}
						}

				}
				else if(($rowProd["Stock"] > 0) && ($_SESSION['num_products'] <=0) ){
					echo		
								 '
								<!-- Note Product Code in URL parameter for shopping cart -->
								<a href="../Cart/index.php?product='.$rowProd["ProductCode"].'&quantity=1">
								<img alt="Add to Cart" src="../Images/addtocart.gif" border="0" align="right" width="74" height="21" /> </a>
								<br clear="ALL" /><br /><br />';		
						echo $rowProd["Stock"].'  in Stock <br/><br/>';
						
				}
						
								
				else if(($rowProd["Stock"] <= 0)){
					echo '<h3>Sorry. This product is currently out of stock.</h3> <br>';								
				}
				/*
				if (isset($_GET['product']) and isset($_GET['quantity'])) {
				if(isst)
				echo $_SESSION['cart'][$i]["qty"].

		if ($_SESSION['cart'][$i]['name'] 	== 	$_GET['product']) {
			$_SESSION['cart'][$i]['qty']	+=	$_GET['quantity'];
							
			*/

			//For Ratings part
			$prodCode = $rowProd["ProductCode"];
			$strSQLRating = "SELECT Rating from reviews where ProductCode = '$prodCode'";
			$rsRating = $db_connected->query($strSQLRating);
			$sum=0;
			

			//check whether the sql is right and how many data are
			if($rsRating == false){
				trigger_error("Wrong SQL: ".$strSQLRating. "Error".$db_connected->error, E_USER_ERROR);
			}
			else{
				$rows_returned = $rsRating->num_rows; // return the numbers of row
			}

			echo '<h3> Reviews (<a href=javascript:PopUp("/reviews.php?ProdCode='.$rowProd["ProductCode"].'",600,500) method=get>'.$rows_returned.'</a>) </h3>';
			
			
			// if the returned rows value 0, then show this message
			if($rows_returned == 0){
			//Display Comments(Reviews) part
			echo '<hr><img src="/Images/stars_rating_00.gif" height=19 width=91 align=left> </p><br>
					<br/><a href=javascript:PopUp("/reviews.php?ProdCode='.$rowProd["ProductCode"].'",600,500) method=get> Go to Review </a><hr>';
			}
			//end of required record set retrieving
			
			else{
				// Use loop for grabbing the each rows of data from the record set
				//Display Comments(Reviews) & Rating part
				while($rowRating = $rsRating->fetch_array(MYSQLI_ASSOC)){
					$sum += $rowRating["Rating"];
				}
				    $average = $sum/$rows_returned;
				//Display Stars

				switch($average){
					case ($average <= 1):
						echo '<hr><img src="/Images/stars_rating_01.gif" height=19 width=91 align=left> </p>';
						break;
					case ($average <= 1.5):
						echo '<hr><img src="/Images/stars_rating_01_5.gif" height=19 width=91 align=left> </p>';
						break;
					case ($average <= 2):
						echo '<hr><img src="/Images/stars_rating_02.gif" height=19 width=91 align=left> </p>';
						break;
					case ($average <= 2.5):
						echo '<hr><img src="/Images/stars_rating_02_5.gif" height=19 width=91 align=left> </p>';
						break;	
					case ($average <= 3):
						echo '<hr><img src="/Images/stars_rating_03.gif" height=19 width=91 align=left> </p>';
						break;	
					case ($average <= 3.5):
						echo '<hr><img src="/Images/stars_rating_03_5.gif" height=19 width=91 align=left> </p>';
						break;	
					case ($average <= 4):
						echo '<hr><img src="/Images/stars_rating_04.gif" height=19 width=91 align=left> </p>';
						break;							
					case ($average <= 4.5):
						echo '<hr><img src="/Images/stars_rating_04_5.gif" height=19 width=91 align=left> </p>';
						break;	
					case ($average <= 5):
						echo '<hr><img src="/Images/stars_rating_05.gif" height=19 width=91 align=left> </p>';
						break;							
						}

				
				//Display Comments(Reviews) part
				echo '<br/><a href=javascript:PopUp("/reviews.php?ProdCode='.$rowProd["ProductCode"].'",600,500) method=get> Go to Review </a> <hr>';


			}

		
			
			
			
			//Display to the top message
			echo '
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
<!-- 2016.10.30 -->	
</html>