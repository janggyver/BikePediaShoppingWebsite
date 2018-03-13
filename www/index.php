<?php 	session_start(); ?>
<html>
  <head>
  
    <title>
      HomePage::BikePedia
    </title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <meta name="description"  		content="Welcome to BikePedia Homepage. Enjoy the shopping." />
    <meta name="author"       		content="Eric Jang, janggyver@gmail.com" />
	<meta name="designer"       	content="JE Marriott, joe.marriott@nbcc.ca" />
	<meta name="keywords"			content="Bike, MTB, City bike, road bike, bike jacket"/>


	
    <link href="../Include/ProductPage.css" type="text/css" rel="stylesheet" />
	
  
  	<script language="javascript" src="../Include/menuitems2.js" type="text/javascript"></script>
	<script language="javascript" src="../Include/menu.js" type="text/javascript"></script>
	<script language="javascript" src="../Include/PopUpImage.js" type="text/javascript"></script>
	
	<!--  Favicon  -->
	<link rel="shortcut icon" href="../bike/favicon.ico">

  </head>
  
  <body>
  
   
<?php
  //Header
	include ('/include/header.php');

 // Menubar
	include ('/include/menubar.php');	
?>
  
  	
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
                        <option value="../bike/index.php" selected="selected">Road</option>
                        <option value="../bike/mtb.php">MTB</option>
                        <option value="../city.php">City</option>
                  </select>
             </form>
		 </div>
		
		 <div id="YouAreHereLinks">		 
		 	
			<a href="/index.php">Home</a> &raquo; 
			<a href="/products.php">Shopping</a> &raquo; &nbsp;
            
		 </div>
				         
	</div>	
	<!-- End of "You Are Here" and Search -->
	
	
  	<!-- Main -->
	<div id="Main">
		<div id="ContentText">
		<h1> Welcome to the BikePedia eStore. <h1>
		<p>
				Enjoy spinning the the Wheel of Fortune first. Good Luck !!!!
		<p>
		</div>
	
			<a href="index_roulette.php"> <img src="/images/image_main.gif" > </a>
	
	
	
	
			
			
	<!-- Footer -->
		<?php include ('/include/footer.php'); ?>
		 
					
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
	
	<?php include ('/Include/LeftAds.php'); ?>
		
	<!-- End of Left Ads -->
	
	
  </body>
 
 
 </html>
  