		<!-- Footer -->
		<br /><br /><br />
		<div id="Footer">
			 <div id="FooterTop">
				
				   		   <a class="footer" href="../index.php">Home |</a>
				   		   <a class="footer" href="../Reg/index.php">Register |</a> 
				   		   <a class="footer" href="../Reg/SignIn.php">My Account |</a> 
				   		   <a class="footer" href="../ContactUs.php">Contact Us |</a>
						   <a class="footer" href="../sitemap.php">Site Map</a>
						  <?php    if (isset($_SESSION["userLoggedIn"])) {

			if($_SESSION["Admin"]==true){
			echo '<a href="../admin/index.php"> <font color= "Red">| Manage Contents (Admin)</font> </a>';
				}
						  }
						  
				?>
				  
			 </div>
			 <div id="FooterBottom">
			 	 
			 	  		  <a class="footer" href="../Copyright.php">COPYRIGHT</a> 
				  		  <font class="small">&copy; 2016 BikePedia Limited, All Rights Reserved.</font><br />
        		  		  <font class="small">This page was last modified :: 
						  
						  <?php	print( date("D F d , Y", getlastmod() )); ?>
						  
						  </font>
				 
			</div>
		</div>
		<!-- End of Footer -->	
		 