	<?php
	echo '
	<!-- Menu Bar -->

	<div id="MenuBar">';
   if (isset($_SESSION["userLoggedIn"])) {
	// Check if the session variable has already been registered
	echo '<div id="MenuBarLeft">
            <a href="../Reg/Signout.php" class="headerbar">Welcome, ' . $_SESSION["FullName"] . '.</a>';
			if($_SESSION["Admin"]==true){
			echo '&nbsb;&nbsb;&nbsb;&nbsb;
			<a href="../admin/index.php"> <font color= "Yellow">Manage Contents (Admin)</font> </a>';
			}
			echo '
		 </div>';
	}
	else {
		echo'
			 <div id="MenuBarLeft">
				<a href="../Reg/SignIn.php" class="headerbar">You are not signed in</a>
			</div>';
	}
    ?>    


        
		 <div id="MenuBarRight">
            <a href="../Reg/SignIn.php" class="headerbar">| My Account</a> 
			<a href="../Cart/index.php" class="headerbar">| My Cart</a> 
			<a href="../Cart/Checkout.php" class="headerbar">| Checkout</a> 
			<a class="headerbar" href="../ContactUs.php">| Contact Us</a>
		</div>
         
	</div>

    <!-- End of Menu Bar -->