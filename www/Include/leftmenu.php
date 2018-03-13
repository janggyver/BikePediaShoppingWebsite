<?php

echo '

	<!-- Left Menu -->
	<!-- create_menu() is the "main engine" of the process to display the JavaScript-powered menu on the left 								-->
	<!-- The code is found in menu.js located in the Include directory 																		-->
	<!-- The actual menu items themselves are found in the array LeftMenuLinks found in menuitems.js located in the Include directory 		-->
	<!-- Note how LeftMenuLinks are passed to the function create_menu() as a paramter.														-->
	<!-- To create an entirely new menu (ie for an entirely different type of type), all you need to do is create another file of "links" 	-->
	<!-- and reference that instead.  There are other ways too if you think about it.														-->

	
<div id="LeftMenu">	
		 <script language="javascript" type="text/javascript">create_menu(\'LeftMenu\', LeftMenuLinks, LeftMenuProps);</script >	
</div>
	<!-- End of Left Menu -->
	
	';

?>