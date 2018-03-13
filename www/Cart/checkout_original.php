 
<HTML>
 
<HEAD>
<TITLE>Thank you for shopping with us</TITLE>

<LINK HREF="../Include/Generic.css" TYPE="text/css" REL="STYLESHEET">

</HEAD>

<BODY>

	 	  <TABLE WIDTH="100%" HEIGHT="100%" BGCOLOR="#FFFFFF">
		  		 <TR>
				 	 <TD ALIGN="CENTER" VALIGN="MIDDLE"> 
					 	 	 <img src="../Images/ThankYou.jpg" width="75" height="137" border="0">
							 
							 <?php
							 	session_start();

							 	if (isset($_GET['checkout'])) {		
								   /*
 								   * CHECKOUT
 								   */
								   // unset variables
								   $_SESSION['cart'] = array();	//  empty array
								   unset($_SESSION['num_items']);
								   unset($_SESSION['num_products']);
								   // destroy the session
								   session_destroy();	
								   				 
							 	   echo '<br clear="all" />Checked out successfully.<br />';
								}
								else {
								   echo '
								   <br clear="all" />Are you sure you want to check out? 
								   ( <a href="Checkout.php?checkout=1"> Yes </a> ) ( <a href="javascript: history.go(-1)"> No </a> ) <br />
								   ';
								}
							 
							 ?>
							 <a href="index.php">Back to Cart</a><br />
					 </TD>
				</TR>
		  </TABLE>


</BODY>
</HTML>

