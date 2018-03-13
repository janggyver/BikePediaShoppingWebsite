<?php 	session_start(); ?>
<HTML>
 
<HEAD>
<TITLE>Contact Us:: BikePedia</TITLE>
<meta name="description" 	content="Get Premium customer support by contacting us." />
<meta name="author" 		content = "Eric Jang , janggyver@gmail.com" />
<meta name = "designer" 	content ="Eric Jang, janggyver@gmail.com />


<LINK HREF="../Include/Generic.css" TYPE="text/css" REL="STYLESHEET">
<link rel="stylesheet" type="text/css" href="../include/ProductPage.css" /> <!-- CSS for main container and footer -->



<script language="javascript" src="../Include/menuitems2.js" type="text/javascript"></script>
<script language="javascript" src="../Include/menu.js" type="text/javascript"></script>
<script language="javascript" src="../Include/PopUpImage.js" type="text/javascript"></script>

<!--Google Map Script -->
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script>
		function initialize() {

			var Y_point			= 45.285440;		// Y axis
			var X_point			= -65.993409;		// X axis

			var zoomLevel		= 16;						// Zoom in

			var markerTitle		= "BikePedia";				// information display when mouse over
			var markerMaxWidth	= 300;						// Max size when click marker

			// marker contents
			var contentString	= '<div>' +
			'<h2>BikePedia</h2>'+
			'<p>Enjoy the various bikes and accesorries<br />' +
            'from the BikePedia.</p>' +
			'<a href="/index.php" target="_blank">http://www.bikepedia.com</a>'+ 
			'</div>';

			var myLatlng = new google.maps.LatLng(Y_point, X_point);
			var mapOptions = {
								zoom: zoomLevel,
								center: myLatlng,
								mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(document.getElementById('map_view'), mapOptions);

			var marker = new google.maps.Marker({
													position: myLatlng,
													map: map,
													title: markerTitle
			});

			var infowindow = new google.maps.InfoWindow(
														{
															content: contentString,
															maxWidth: markerMaxWidth
														}
			);

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
		}
	</script>






<!--Favicon -->
<link rel="shortcut icon" href="../bike/favicon.ico">

</HEAD>

<BODY onload="initialize()">

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
			<input type="text" name="txtsearch" value="Search" size="15"  />
			<input type="image" src="../images/go.gif" border="0" width="26" height="21" align="middle" />
		</form>
	</div>
	
	
	
	<div id="YouAreHereList">
		<form action="">
			<select onchange="document.location=this.value" name="CatID">
			<option value="contactus.php" selected="selected"> Contact Us</option>
			<option value="../bike/index.php" > Bike</option>
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

<!-- End of "You Are Here" and Search -->

<!--Main -->
<div id="Main">

	<h1> Contact Information </h1> <br>
	<h2> &nbsp;&nbsp;&nbsp;Thanks for visiting BikePedia eStore. Please feel free to contact us. </h2>
<!--	Moved into Customer Support
<div class="contentText">
	<h1> Phone Number </h1> <br><br>
	&nbsp;&nbsp;&nbsp;  (506) 898-0957
</div> <br><br><br>
	
<div class="contentText">
	<h1> Fax Number </h1> <br><br>
	&nbsp;&nbsp;&nbsp;  (506) 333-8958
</div> <br><br><br>
	-->	
	
<div class="contentText">
	<h1> Customer Support </h1> <br><br>
		&nbsp;&nbsp;- Get help with recent purchases: inquire about order status, delivery, returns, invoices, or other order-related issues.
	<ul><h2>
		<li>Phone Number: &nbsp;&nbsp;&nbsp;(506)898-0957 </li> <br>
		<li>Fax Number: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(506)348-2848 </li>	<br>
		<li><font color="blue">Email:</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="mailto:janggyver@gmail.com?Subject=[Inquiry]%20I%20have"> janggyver@gmail.com </a></li>
	
		</h2>
	</ul>

</div> <br><br><br>

<div class="contentText">
	<h1> We are...  </h1> <br><br>
	&nbsp;&nbsp; - BikePedia is located in the Campus of NBCC Saint John as a Campus Venture.<br>
	<div class="contentText">
	<h2> &nbsp;&nbsp;&nbsp;Address </h2> 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 950 Grandview Avenue, Saint John, NB &nbsp;&nbsp;&nbsp; E2J 4C5 <br><br>
	</div> <br><br><br>
</div> <br><br><br>
<div id="map_view" style="width:600px; height:300px; left: 10px;"></div>












			
		  <!-- Footer -->
		  <?php include('/include/footer.php') ?>
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



</BODY>

</HTML>

