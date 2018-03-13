<?php
session_start();

/*
		4U2Do HERE!... add database connectivity code...   <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- 
*/

//Database Connection
	//Server
	$db_server = "localhost";
	//Database user name
	$db_user = "root";
	//Database password
	$db_pwd = "";
	//Database name
	$db_name="ericjang";
	
	//1. create the connection to the local database
	$db_connected = new mysqli($db_server, $db_user, $db_pwd, $db_name);
	//2. check db connection
	if($db_connected->connect_error){
		trigger_error('DB Connection Failed: '.$db_connected->connect_error, E_USER_ERROR);
		
	}
// end of database connectiviy	



/*
 * 	INITIALIZE CART (only done first time here)
 *	The cart is actually just an array storing the product codes and cumulative quantities.
 *  We also have 2 variables to keep track of total number of items in the cart,
 *  and number of products.
 */

if (!isset($_SESSION['cart'])) {	// Does the cart exist?  If not, create the session variables that represent it...

	$_SESSION['cart'] = array();	//  Create (declare) cart and initialize as an empty array.                       
	$_SESSION['num_items'] = 0;		//  Declare num_items and initialize to zero.                                     
	$_SESSION['num_products'] = 0;	//  Declare num_products and initialize to zero.                                  

}


/*
 * Want to "see" your actual cart?  The print_r($_SESSION) code found later on this page dumps the raw contents
 */
 

/**************************************************************************************************************************************
 *	ADD ITEM TO CART (via URL parameters product and quantity... requires both)
 *************************************************************************************************************************************/

 // isset() checks for the existence of a variable                                
 // Only attempt to update cart if both of these URL parameters have been provided
if (isset($_GET['product']) and isset($_GET['quantity'])) {

	// Check whether the item is already in the cart by searching the array for a particular product code
	// If so, add to the corresponding qty                                                               
	for ($i=0; $i<$_SESSION['num_products']; $i++) {
		if ($_SESSION['cart'][$i]['name'] 	== 	$_GET['product']) {
			$_SESSION['cart'][$i]['qty']	+=	$_GET['quantity'];
			$in_cart = true;
		}
	}
	
	// If item is not in cart, add it
	if (!isset($in_cart)) {
		$_SESSION['cart'][$_SESSION['num_products']]['name'] 	= $_GET['product'];
		$_SESSION['cart'][$_SESSION['num_products']]['qty'] 	= $_GET['quantity'];
		$_SESSION['num_products']++;

	}
	
	// Increment the total number of cart items
	$_SESSION['num_items']+=$_GET['quantity'];
} 

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
		<script language = "javascript" src="../cart/PopUp.js" type="text/javascript"></script>

	
		<script language="javascript" type="text/javascript">
					
			function PopUp(url , w, h) {
			window.open ( url, \'PopUp\',
			\'width=\' + w + \',height=\' + h + \',toolbar=no,directories=no,status=no,scrollbars=no\' + \',resizable=no,menubar=no,location=no,copyhistory=no\'
			);
			}
			</script>
			
		<!--Favicon -->
		<link rel="shortcut icon" href="../bike/favicon.ico">


</head>

<body>';
?>
<?php

			
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
<!--Start to Display Cart Contents-->
<!--Main -->
<div id="Main">	
	<td><h1>Shopping Cart List </h1></td>
     <br /><hr width=60% align="left" /><br />					 
<?php
if ($_SESSION['num_items'] != 0) {
	echo'
<table width="100%" HEIGHT = "100%" BGCOLOR = "#FFFFFF">

	<tr valign = "middle" align="left">
		<th> Product Thumbnail </th>
		<th> Product Name </th>
		<th> In Stock </th>
		<th> Product Code </th>
		<th> Product Price </th>
		<th> Order Quantiy </th>
		<th> Total Price </th>
	 </tr>';

/**************************************************************************************************************************************
 *	DISPLAY CART CONTENTS
 *************************************************************************************************************************************/
	 $GrandTotal=0;
 // Loop through the array based on the number of products currently in it
for ($i=0; $i<$_SESSION['num_products']; $i++) {
	echo '<tr valign = "middle" align="left">';
		$strCartQuery = "SELECT ProductCode, ProductName, ProductDescription, RegularPrice, Department, Stock, ThumbnailHeight 
						from products where ProductCode = '".$_SESSION['cart'][$i]['name']."'";
		$rsCart = $db_connected->query($strCartQuery);
		$rowCart = $rsCart->fetch_array(MYSQLI_ASSOC);
		
		//Formula for Price
		$ProductTotal = $_SESSION['cart'][$i]['qty']*$rowCart["RegularPrice"];
		$GrandTotal += $ProductTotal;
		$CurrentStock = $rowCart["Stock"]-$_SESSION['cart'][$i]["qty"];
		
		

		// find directories of thumbnail
			 if ( $rowCart["ProductCode"][0] == "B"){
					echo '<td>
						<img src="../bike/images/'.$rowCart["ProductCode"].'_sm.jpg" width="100", height ="'.$rowCart["ThumbnailHeight"].'">';
			  }
			 else if ( $rowCart["ProductCode"][0] == "C"){
					echo '<td>
						<img src="../Clothing/images/'.$rowCart["ProductCode"].'_sm.jpg" width="100", height ="'.$rowCart["ThumbnailHeight"].'">';
			  }

			 else if ( $rowCart["ProductCode"][0] == "E"){
					echo '<td>
						<img src="../equipment/images/'.$rowCart["ProductCode"].'_sm.jpg" width="100", height ="'.$rowCart["ThumbnailHeight"].'">';
			  }

				echo '</td>';
			  

	echo '<td>';

	echo '<a href=javascript:PopUp("../Cart/PopUpProdDesc.php?ProdID='.$rowCart["ProductCode"].'",300,300) method="get">'.$rowCart["ProductName"]. '</a></td>';  // Product Name
	echo '<td>'.$rowCart["Stock"].'</td>';  // Stock	
	echo '<td>'.$rowCart["ProductCode"].' </td>'; // Product Code
    echo '<td>$'.number_format($rowCart["RegularPrice"], 2, ".", ",").' </td>';  // Regular Price
	
						
	echo '<td>'.$_SESSION['cart'][$i]["qty"];
	
	//add up, subtract related
		if($CurrentStock>0){
				echo '( <a href=index.php?product=' . $_SESSION['cart'][$i]['name'] . '&quantity=1>+</a> )  ';
		}
		if($_SESSION['cart'][$i]['qty'] >0 ){
			//subtract
			echo '( <a href=index.php?product='.$_SESSION['cart'][$i]['name'].'&quantity=-1>- </a>) ';
		}
		echo '</td>';  // Order quantity
    echo '<td>$'.number_format($ProductTotal, 2, ".", ",").' </td>';  // Product Subtotal
	echo '</tr>';
	
	
	
	
	/*
	
	// Simple quantity modification mechanism                                                                 
	// This link "loops" back to this page with the product pulled from the array, and quantity hardcoded to 1
	echo '( <a href=index.php?product=' . $_SESSION['cart'][$i]['name'] . '&quantity=1>+</a> )  ';
	
	// Since these items are stored in a database,                          
	// we only need to store the product code (primary key?) in the session.
	echo $_SESSION['cart'][$i]['name'] . ' - ' . $_SESSION['cart'][$i]['qty'] . '<br />';
	
	/*
		4U2Do HERE!... Do some database lookups and stuff to display product details... <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- <--- 
	*/

}

echo '

		<tr>
			<td> <hr> </td><td> <hr> </td><td> <hr> </td><td> <hr> </td><td> <hr> </td><td> <hr> </td><td> <hr> </td>
	</tr>
		<tr>
			<td> Grand Total </td> <td> </td> <td> </td> <td> </td><td> </td><td> '.$_SESSION['num_items'].'  </td><td>$ '.number_format($GrandTotal, 2, ".", ",").'  </td>
	</tr>
	<tr>
			<td> <hr> </td><td> <hr> </td><td> <hr> </td><td> <hr> </td><td> <hr> </td><td> <hr> </td><td> <hr> </td>
	</tr>
</table>';
?>
					 
<?php

/**************************************************************************************************************************************
 *	CART FOOTER
 *************************************************************************************************************************************/

	


   echo '<a href="javascript: history.go(-1)"><img src="../images/continueshopping.jpg" widith="100" height="50">';
   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Checkout.php"><img src="../images/checkout.jpg" widith="100" height="50"></a>';
}
else {
   echo '<br /><br /><a href="../products.php"><h2>Cart is empty now. Please pick happy goods first please. </h2><img src="../images/continueshopping2.jpg" ></a>';
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
