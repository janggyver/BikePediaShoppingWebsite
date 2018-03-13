

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
		$PageID = 501;
		
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
		

<script language="javascript" type="text/javascript">
	
	function setDeptCatOptions(DeptChosen) {
			 
			 var catbox = document.frmAddProdduct.optCat;
 
 			 catbox.options.length = 0;
			 
			 switch (DeptChosen) {
			 
			 		default  :
			 		case " " :
  			 			 catbox.options[catbox.options.length] = new Option(\'--Category--\',\' \');
 						 break; 			
			 
			 		case "Bike" : 
  			 			 catbox.options[catbox.options.length] = new Option(\'Road\',\'Bike\');
  						 catbox.options[catbox.options.length] = new Option(\'MTB\',\'Bike\');
  						 catbox.options[catbox.options.length] = new Option(\'City\',\'Bike\');
						 break;
			
					case "Clothing" :
  			   			 catbox.options[catbox.options.length] = new Option(\'Jacket\',\'Clothing\');
  			   			 catbox.options[catbox.options.length] = new Option(\'Pants\',\'Clothing\');
						 catbox.options[catbox.options.length] = new Option(\'Cap\',\'Clothing\');
			   			 break;
			
					case "Equipment" :
  			   			 catbox.options[catbox.options.length] = new Option(\'Helmet\',\'Equipment\');
  			   			 catbox.options[catbox.options.length] = new Option(\'Eyewear\',\'Equipment\');
  			   			 catbox.options[catbox.options.length] = new Option(\'Lights\',\'Equipment\');
			   			 break;
			}

	}
	
</script>		
					

		
		<!--Favicon -->
		<link rel="shortcut icon" href="../bike/favicon.ico">';
		?>


</HEAD>

<BODY>



<!-- Header -->
   <?php 
     include ('../include/header.php');
   ?>
<!-- End of Header -->

<!-- Menu Bar -->
   <?php 
     include ('../include/menubar.php');
   ?>
<!-- End of Menu Bar -->

<!-- "You Are Here" and Search -->
   <?php 
     include ('../include/search.php');
   ?>
   
	<div id="YouAreHereList">
		<form action="">
			<select onchange="document.location=this.value" name="CatID">
				<option value="index.php" selected="selected"> Modify Products</option>
				<option value="../products.php?PageID=100" > Bike</option>
				<option value="../clothing/index.php" > Clothing</option>
				<option value="../equipment/index.php" > Equipment</option>
			</select>
		</form>
	</div>
	
	<div id="YouareHereLinks">
		<a href="../admin/index.php">Admin Home </a> &raquo;
<!--		<a href="../reg/index.php">Registration </a> &raquo; &nbsp; -->
	</div>
</div>

<!-- End of "You Are Here" and Search -->


<!--Main -->
<div id="Main">
	<h1> You can manage products information. </h1>

	<?php
	
	
	
	
	
	
	
	
	
	
	
	
	//These code will be executed when the file is chosen and links back itself

	if ( isset($_FILES["uploadedfile"]) ) {
		
		// Note the appearance of this message, showing you when this block of code is executed.
		// It is included for debug purposes only.												
		echo 'I detect you are attempting to upload a Product.  Here are the results...<br/><br/>';

		// I'm just proving other form controls come along with the uploaded file.			
		echo ( isset($_POST['txtProdID']) ? 'Product ID : ' . $_POST['txtProdID'] . '<br>' : " " );
		
		// Where our fullsized image is going .
		$target_path = "../Demos/Images/";

		
		
		// Where our thumbnail is going 							 	
		 $thumbnail_path = "../Demos/Images/";

			
			
		// The name of our file, extracted from the original filename of the image you uploaded.   	
		$filename = basename($_FILES["uploadedfile"]["name"]);
		
		
		// Try to upload the file.			
		if( move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $target_path . $filename) ) {
			echo 'File uploaded successfully.<br />';
			
			// Check filetype to determine if uploaded file is an image.							
			$acceptable_filetypes = array(".jpeg", ".jpg", ".png");
			$filetype = strtolower( substr($filename, strrpos($filename, ".")) );		
			if ( in_array($filetype, $acceptable_filetypes) ) {			
				// Try to create the thumbnail by calling the function provided below.		
				if ( CreateThumbnail($thumbnail_path , $target_path . $filename , $filetype) ) {
					echo 'Thumbnail created successfully.<br />';
				} 
				else {
					echo 'There was an error creating the thumbnail.<br />';
				}
			} 
			else {
				echo 'File must be jpeg, jpg, or png to create a thumbnail.<br />';
			}
			
		} 
		else {
			echo 'There was an error uploading the file.<br />';
		}
	}

	?>




<?php
// This function is only executed by the logic above.  The PHP engine ***does not*** "automatically" drop into it.


function CreateThumbnail($thumb_dir, $file, $filetype, $thumb_width = 100, $thumb_height = 6000 ) {
// Incoming parameters : 	Thumbnail Directory Path														
//							Name of fullsize image															
//							Type of image ( .jpg, .jpeg, .png )												
//							Desired thumbnail width (defaults to maximum 100 if nothing is passed)			
//							Desired thumbnail height (defaults to maximum 6000 if nothing is passed)		
//
// Responsibilities :		Creates a thumbnail of size 100x? in format FullsizeName_sm.??? , 				
//							where ??? is the original extension , and places into the specified directory	
//
// Return Value :			TRUE if thumbnail successfully created, FALSE otherwise.							


	// Create image handle using GD functions.																		
	// ImageCreateFromPNG() returns an image identifier representing the image obtained from the given filename. 	
	// Ref http://ca.php.net/manual/en/function.imagecreatefrompng.php												
	// ImageCreateFromJPEG() returns an image identifier representing the image obtained from the given filename.	
	// Ref http://ca.php.net/manual/en/function.imagecreatefromjpeg.php												
    if( $filetype == ".png" ) {
        $base_img = ImageCreateFromPNG($file);
    }
    else if( ($filetype == ".jpeg") || ($filetype == ".jpg") ) {
        $base_img = ImageCreateFromJPEG($file);
    } 

    // If the image is broken, cancel the operation.								
    if ( !$base_img ) return false;

    // Get image sizes (width/height) from the image object we just created.		
    $img_width = imagesx($base_img);
    $img_height = imagesy($base_img);


    //  Resize the image, maintaining aspect ratio.																	
	//  Because we want thumbnails of width 100, we forced the situation											
	//  by making $thumb_height ridiculously large above (6000).  For most circumstances, your thumbnails should	
	//  generate at 100 wide.   If you encounter odd situations which do not work, you may want to resize			
	//  the fullsized image before using this.																		
    $img_width_per  = $thumb_width / $img_width;
    $img_height_per = $thumb_height / $img_height;	

    if ($img_width_per <= $img_height_per)  {
		// Resize per the desired width (100) , and the appropriate height.									
        $thumb_width = $thumb_width;
        $thumb_height = intval($img_height * $img_width_per);
    }
    else {
		// Resize per the desired height.  This code should not be executed, but has been provided FYI.		
        $thumb_width = intval($img_width * $img_height_per);
        $thumb_height = $thumb_height;
    }

	// Create a new true color image using GD function.														
	// ImageCreateTrueColor() returns an image identifier representing a black image of the specified size. 
	// Ref http://php.net/manual/en/function.imagecreatetruecolor.php										
    $thumb_img = ImageCreateTrueColor($thumb_width, $thumb_height);

	// Copy our original image into our new thumbnail-sized image using GD function.						
	// ImageCopyResampled() copies a rectangular portion of one image to another image, smoothly 			
	// interpolating pixel values so that, in particular, reducing the size of an image still retains		
	// a great deal of clarity.																				
	// Ref http://ca.php.net/manual/en/function.imagecopyresampled.php										
    ImageCopyResampled($thumb_img, $base_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $img_width, $img_height);

	// Put the newly created thumbnail in the specified directory from the incoming parameter list.			
	// The site we have been developing only uses JPEGS (if you're been following specs).	
	// The PNG code is provided for your information only.									
    if ( $filetype == ".png" )   {
        // Inject "_sm" into the filename to adhere to our thumbnail naming convention.						
		// str_replace() replaces all occurrences of the search string with the replacement string,			
		// and returns the newly constructed string.														
		// Ref http://php.net/manual/en/function.str-replace.php											
		// We're saying " in the filename xyz.png, replace '.png' with '_sm.png' , resulting in xyz_sm.png "
		$tmb = "_sm";	
		$ext = ".png";
		$file = str_replace($ext , $tmb.$ext , $file);
		
		// ImagePNG() - Output a PNG image to either the browser or a file.									
		// Ref http://php.net/manual/en/function.imagepng.php												
		ImagePNG($thumb_img, $thumb_dir . basename($file));
    }
    else if ( ($filetype == ".jpeg") || ($filetype == ".jpg") )   {        
		// Inject "_sm" into the filename to adhere to our thumbnail naming convention.						
		// See above for further explanation.																
		$tmb = "_sm";
		$ext = ($filetype==".jpg")? ".jpg" : ".jpeg";
		$file = str_replace($ext , $tmb.$ext , $file);
			
		// ImageJPEG() - Output a JPEG image to either the browser or a file.								
		// Ref http://php.net/manual/en/function.imagejpeg.php												
		ImageJPEG($thumb_img, $thumb_dir . basename($file));		
    }
	
	// And a little housekeeping...																			
	// ImageDestroy() frees any memory associated with image.												
	// Ref http://php.net/manual/en/function.imagedestroy.php												
    ImageDestroy($base_img);
    ImageDestroy($thumb_img);

    return true;
}

// function CreateThumbnail() ends here.																	
?>





	
	
	<?php
	

	if ((isset($_POST['txtProductCode']))){
	
	$ProdSearchID = isset($_POST['txtProdSearchID'])?$_POST['txtProdSearchID']:"TEMP1";
	$ProdDeleteID = isset($_POST['txtProdDeleteID'])?$_POST['txtProdDeleteID']:"TEMP1";
	$ProductCode =isset($_POST['txtProductCode'])?$_POST['txtProductCode']:"TEMP2";
	$ProductName =isset($_POST['txtProductName'])?$_POST['txtProductName']:"Temp3";
	$ProductDescription =isset($_POST['txtProductDescription'])?$_POST['txtProductDescription']:"Temp4";
	$Department =isset($_POST['txtDepartment'])?$_POST['txtDepartment']:"Temp5";
	$Category =isset($_POST['txtCategory'])?$_POST['txtDepartment']:"Temp6";
	$RegularPrice =isset($_POST['txtRegularPrice'])?$_POST['txtRegularPrice']:0.00;
	$SalePrice =isset($_POST['txtSalePrice'])?$_POST['txtSalePrice']:0.00;
	$SaleStartDate =isset($_POST['txtSaleStartDate'])?$_POST['txtSaleStartDate']:2016-12-01;
	$SaleEndDate =isset($_POST['txtSaleEndDate'])?$_POST['txtSaleEndDate']:"2016-12-31";
	$Option1Description =isset($_POST['txtOption1Desc'])?$_POST['txtOption1Desc']:"Temp9";
	$Option1a =isset($_POST['txtOption1aDesc'])?$_POST['txtOption1aDesc']:"Temp10";
	$Option1b =isset($_POST['txtOption1bDesc'])?$_POST['txtOption1bDesc']:"Temp11";
	$Option1c =isset($_POST['txtOption1cDesc'])?$_POST['txtOption1cDesc']:"Temp12";
	$Option1d =isset($_POST['txtOption1dDesc'])?$_POST['txtOption1dDesc']:"Temp13";
	$Stock =isset($_POST['txtStock'])?$_POST['txtStock']:0;
	$_FILES["uploadedfile"]["name"]= $_POST['txtProductCode'].'".jpg"';
	
	$strSearchProductID = "select ProductCode from products";


	$resultRegisteredProdID = $db_connected->query($strSearchProductID);
	if($resultRegisteredProdID = $ProductCode){
		echo '<script type="text/javascript">alert(\'Product ID is duplicated. Please input new ID.\')</script>';
		echo $resultRegisteredProdID." jang ";
		echo $ProductCode;
	}
	else{
	$strAddProductSQL = "insert into products (ProductCode, ProductName, ProductDescription, Category, Department, ThumbnailHeight, RegularPrice, SalePrice, SaleStartDate, SaleEndDate, Option1Desc, Option1a, Option1b, Option1c, Option1d, Stock) values('$ProductCode','$ProductName', '$ProductDescription', '$Category', '$Department', 100, '$RegularPrice', '$SalePrice', '$SaleStartDate', '$SaleEndDate', '$Option1Description', '$Option1a', '$Option1b', '$Option1c', '$Option1d', '$Stock')";
	
	//$addProduct = $db_connected -> mysqli_query($strAddProductSQL);
	$addProduct = $db_connected -> query($strAddProductSQL);
	if($addProduct){
		echo '<script type="text/javascript">alert(\'New Product was added successfully!\')</script>"';
	}
	else{
		echo '<script type="text/javascript">alert(\'Failed to add a New Product. Please check the fields information!\')</script>"';

	}
	
		}
	}
	if ((isset($_POST['txtProdDeleteID']))){
	$ProdDeleteID = isset($_POST['txtProdDeleteID'])?$_POST['txtProdDeleteID']:"TEMP1";

	$strDeleteProductSQL = "delete from products where ProductCode = '$ProdDeleteID'";
	
	//$addProduct = $db_connected -> mysqli_query($strAddProductSQL);
	$DeleteProduct = $db_connected -> query($strDeleteProductSQL);
	if($DeleteProduct){
		echo '<script type="text/javascript">alert(\'Deleted Successfully!\')</script>"';
	}
	else
	{echo '<script type="text/javascript">alert(\'Failed to delete!\')</script>"';}


	}
	
	
	
	// A form to enter an image to upload
	echo '
	<form name = "frmSearchProduct" enctype="multipart/form-data" action="index.php" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
		<h3> Please input a Product ID to search and update or to add new product. (ie: BIKE101 - 7 digits) </h3>
		Product ID: <input type = "text" name="txtProdSearchID" value=""> <input type = "submit" value = "Search Product">
	</form>
		<br/><br/><br/>
	<form name = "frmDeleteProduct" enctype="multipart/form-data" action="index.php" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
		<h3> Please input a Product ID to Delete. (ie: BIKE108 - 7 digits) </h3>
		Product ID: <input type = "text" name="txtProdDeleteID" value=""> <input type = "submit" value = "Delete Product">
	</form>
		<br/><br/><br/>
		<hr width= "60%" align="left" />
	
	<form name = "frmAddProdduct" enctype="multipart/form-data" action="index.php" method="POST">
	
		<input type="submit" value="Add New Product" />

		<!-- This link is provided for debug purposes.  If you use it, it shows that if you surf to the page 	-->
	<!-- without uploading anything, the PHP code at the top does not get executed.							-->											
	<a href="index.php">Reload page (without uploading anything)</a> <br>
	
		<br/>
		<div id="RegForm" >
			<div class="RegFormFullColFirst">
				Add or change new Image - Choose and image to upload:
			</div>
			<div class="RegFormFullColSecond">
				<input name="uploadedfile" type="file" value="Find File" />
			</div>	
			
			<br><br><br/>			
			<div class="RegFormFullColFirst">
				Product ID:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtProductCode" size = "25" maxlength="25" value="BIKE108">
			</div>
		
			<br><br>
			
			<div class="RegFormFullColFirst" >
			Product Name:			
			</div>
			
			<div class="RegFormFullColSecond">
				<input type="text" name="txtProductName" size="25" maxlength="25" value="Product Name">
			</div>
			<br><br>

			<div class="RegFormFullColFirst">
			Product Description:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtProductDescription" size="50" maxlength="1000" value="Product Description">
			</div>
			<br><br>
			<div class="RegFormFullColFirst" >
			Department:			
			</div>
			
			<div class="RegFormFullColSecond">
				<input type="text" name="txtDepartment" size="25" maxlength="25" value="Product department">
			</div>
			<br><br>

			<div class="RegFormFullColFirst">
			Category:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtCategory" size="50" maxlength="1000" value="Product category">
			</div>
			<br><br>			
			

			<div class="RegFormFullColFirst">
			Department:
			</div>
			<div class="RegFormFullColSecond">
			<select name="optDept" size="1" onchange="setDeptCatOptions(document.frmAddProdduct.optDept.options[document.frmAddProdduct.optDept.selectedIndex].value);">
					<option value=" " selected="selected">--Department--</option>
					<option value="Bike">Bike</option>
					<option value="Clothing">Clothing</option>
					<option value="Equipment">Equipment</option>
			</select>
			</div>			<br><br>
			<div class="RegFormFullColFirst">
			Category:
			</div>
			<div class="RegFormFullColSecond">
			<select name="optCat" size="1">
					<option value=" " selected="selected">--Category--</option>
			</select>

			<input type="button" name="go" value="Value Selected" onclick="alert(document.frmAddProdduct.optCat.options[document.frmAddProdduct.optCat.selectedIndex].value);">

			</div>			<br><br>
			





			
			
			
			
			
			
			<div class="RegFormFullColFirst">
			Regular Price:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtRegularPrice" size="25" maxlength="25" value="RegularPrice info">
			</div>
			
			<br><br>
			
			
			<div class="RegFormFullColFirst">
			Sale Price:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtSalePrice" size="25" maxlength="25" value="Selling Price">
			</div>			
			
			
			<br><br>
			
			
			<div class="RegFormFullColFirst">
			Sale Start Date:
			</div>
			<div class="RegFormFullColSecond">
				<input type="date" name="txtSaleStartDate" size="25" maxlength="25" >
			</div>			

			<br><br>
			
			
			<div class="RegFormFullColFirst">
			Sale End Date:
			</div>
			<div class="RegFormFullColSecond">
				<input type="date" name="txtSaleEndDate" size="25" maxlength="25" value="">
			</div>			

			<br><br>
			
			
			<div class="RegFormFullColFirst">
			Option 1 Descrption:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtOption1Desc" size="50" maxlength="1000" value=" Option1 info">
			</div>			

			<br><br>
			
			
			<div class="RegFormFullColFirst">
			Option 1a Descrption:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtOption1aDesc" size="50" maxlength="1000"  value=" Option1a info">
			</div>			

			<br><br>
			
			
			<div class="RegFormFullColFirst">
			Option 1b Descrption:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtOption1bDesc" size="50" maxlength="1000"  value=" Option1b info">
			</div>			
			<br><br>
			
			
			<div class="RegFormFullColFirst">
			Option 1c Descrption:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtOption1cDesc" size="50" maxlength="1000"  value=" Option1c info">
			</div>			

			<br><br>
			
			
			<div class="RegFormFullColFirst">
			Option 1d Descrption:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtOption1dDesc" size="50" maxlength="1000" value=" Option1d info">
			</div>						
			<br><br>
			
			<div class="RegFormFullColFirst">
			Stock(Quantiy on Hand):
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtStock" size="25" maxlength="25" value=" QTY number">
			</div>				
			
			
			
			
			
			
		</div>

		</form>	
	<!-- End of Form -->				
	
	
	
	
	
	';
	?>
	
	
	
	
<?php
// For debug purposes only																						
// We will use the "Super Global" $_FILES to access our uploaded file, specifically $_FILES['uploadedfile']. 	
// You've seen $_POST previously.																				

	echo '<
	pre> $_POST ';
	print_r($_POST);
	echo '</pre>';

	echo '<pre> $_FILES ';
	print_r($_FILES);
	echo '</pre>';

	
?>	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
			
		  <!-- Footer -->
		  <?php include('../include/footer.php') ?>
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


</BODY>
</HTML>

