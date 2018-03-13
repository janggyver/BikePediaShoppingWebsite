<?php
$What = empty($_GET['txtsearch'])? "-0-" : $_GET['txtsearch'];
?>
 
<HTML>
 
<HEAD>
<TITLE>Sorry</TITLE>

<LINK HREF="../Include/Generic.css" TYPE="text/css" REL="STYLESHEET">

</HEAD>

<BODY>

	 	  <TABLE WIDTH="100%" HEIGHT="100%" BGCOLOR="#FFFFFF">
		  		 <TR>
				 	 <TD ALIGN="CENTER" VALIGN="MIDDLE"> 
					 	 <img src="../Images/50sMenLooking.jpg" width="337" height="122" border="0">
						 <H2>We looked for  "<?php echo $What ?>"  , <BR> but we couldn't find anything!   Sorry!</H2>
					 </TD>
				</TR>
		  </TABLE>


</BODY>
</HTML>

