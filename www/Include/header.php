
	<?php

	echo'
	<div id="Header">
	
  		 <div id="HeaderLeft">     
            <a href="../index.php"> <img height="30" alt="Home Page" src="../Images/BPlogo.gif" width="135" border="0" align="left" /> </a>
		 </div>
		 
		 <div id="HeaderRight">         
            <a href="../Cart/index.php" class="header">
			<img src="../Images/shoppingcart.gif" height="18" width="127" border="0" align="ABSMIDDLE" />';

			if(isset($_SESSION["cart"])){
			echo 'Contains ' . $_SESSION['num_items'] . ' Items';
			}
			else{
			echo ' Contains 0 Items';
			}
			echo'
			</a>
		 </div>
		          
    </div> 

	';
	?>
