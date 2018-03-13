<?php 	session_start(); ?>

<html>
  <head>
      <title>
      Home Page::BikePedia
    </title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <meta name="description"  		content="Spin the wheel. You can get the fortune of BikePedia" />
    <meta name="author"       		content="Eric Jang, janggyver@gmail.com" />
	<meta name="designer"       	content="JE Marriott, joe.marriott@nbcc.ca" />
	<meta name="keywords"			content="Bike, MTB, City bike, road bike, bike jacket"/>


	
    <link href="../Include/ProductPage.css" type="text/css" rel="stylesheet" />
	    <link href="../Include/HPMain.css" type="text/css" rel="stylesheet" />
	
  
  	<script language="javascript" src="../Include/menuitems2.js" type="text/javascript"></script>
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
	
		<div id="HPMain">
		
			<div class="BigText">
				 Why don't you get a big gift before shopping? 
			</div>
			
			<br><br><br>
			<?php include ('/include/roulette.php'); ?>
			<div id="hideCheck">
			<img src="/images/hidingbox.jpg">
			</div>
		</div>
			
			
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
  
<!-- 2015.08.28 -->	
</html>

