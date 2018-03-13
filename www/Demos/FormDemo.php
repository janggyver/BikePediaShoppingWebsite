<!--

 This page demos basic Form, Javascript, and Cookie theory, and depending on which form is submitted, will link to one of the following pages...

	FormDemo.Get.htm 		(Using URL parameters to pass info)
	FormDemo.Post.htm 		(Using local memory to pass info)
	FormDemo.Cookies.htm	(Using cookies to pass info)


-->

<html>

<head>

<title>Fun with Forms - HTML Version</title>

<style type="text/css"> 
	.inputok 	{ 	background-color: #FFFFFF;	}
	.inputreqd	{	background-color: #33FFFF;	}
</style>


<script language="javascript">

	function EditFields(dFn) {
	// Incoming parameters :	dFn represents document."Formname"
	// Responsibilities :		Performs edits checks as required against all fields in form.
	//							Displays error messages for all fields failing tests, sets focus to first field in error.
	// Return type :			TRUE if all edits passed, FALSE otherwise.
	
	
	// Note! Making a mistake/typo in any fieldname will result in this function returning true! 
	// MAKE SURE your fieldnames are spelled correctly AND match the control names on your form!

			
			// Some debug code to help you.  Make sure you deactivate in your final version!
			alert ( "EditFields method successfully called\n\nIf you do not receive a Leaving EditFields message,\nyou probably have a typo in your code!");
			
			// We start optimistically
			var success=true;
			var message="";
			var firstError="";
			dFn.txtFirstname.className = "inputok";
			dFn.txtLastname.className = "inputok";
						
			if (dFn.txtFirstname.value == "") {
				// Remember the first field that trips an edit so I can set focus later 
				if (firstError == "") firstError = dFn.txtFirstname;
				// Highlight field in error
				dFn.txtFirstname.className = "inputreqd";
				// Add to the message list 
				message+="\n    • First name";
				
			}  
			if (dFn.txtLastname.value == "") {
				// Remember the first field that trips an edit so I can set focus later 
				if (firstError == "") firstError = dFn.txtLastname;
				// Highlight field in error
				dFn.txtLastname.className = "inputreqd";
				// Add to the message list 
				message+="\n    • Last name";
			}		
			// etc.
			
			// If any errors have been encountered, display the message that was built,					
			// and set the focus to the first field in error.  Don't you hate screen designs that don't	
			// set focus for you?  It's easy for the programmer to save you that extra click.			
			// Start looking for it, and next time you see it, think "lazy programmer!"					
			if (message != "" ) {
				alert("Please enter\n" + message);
				firstError.focus();
				success=false;			
			}
			
			// Some debug code to help you.  Make sure you deactivate in your final version!
			alert ( "Leaving EditFields method with success = " + success);
			
			return success;
	}

	function WriteCookies(dFn) {
	// Incoming parameters :	dFn represents document."Formname"
	// Responsibilities :		Calls EditFields() to edit check all user provided data in form.
	//							Writes cookies for all data only if all edits passed.
	// Return type :			TRUE if all edits passed, FALSE otherwise.
	
	
	// Note! Making a mistake/typo in any fieldname will result in this function returning true! 
	// MAKE SURE your fieldnames are spelled correctly AND match the control names on your form!
			
			// Some debug code to help you.  Make sure you deactivate in your final version!
			alert ( "WriteCookies method successfully called\n\nIf you do not receive a Leaving WriteCookies message,\nyou probably have a typo in your code!");
			
			
			// Perform edit checks, catch result
			var success=EditFields(dFn);	
			
			// Only write cookies if all edits passed 
			if (success) {
			
				// Some debug code to help you.  Make sure you deactivate in your final version!
				//alert ( "Trying to write cookies");
			
				var strExpDate;
				// Make sure this date is in the future
				strExpDate = " path=/; expires=Monday, 31-Dec-2018 12:00:00 GMT;";
			
				// Text boxes
				document.cookie = "FirstName=" + dFn.txtFirstname.value + ";" + strExpDate;		
				document.cookie = "LastName=" + dFn.txtLastname.value + ";" + strExpDate;
				
				// Sample debug code
				// Want to see what's being written as a cookie?  Try activating the following line...
				// alert ( "LastName=" + dFn.txtLastname.value + ";" + strExpDate );
				
				// Radio button group				
				if (dFn.optLanguage[0].checked)document.cookie = "Language=" + dFn.optLanguage[0].value  + ";" + strExpDate;
				if (dFn.optLanguage[1].checked)document.cookie = "Language=" + dFn.optLanguage[1].value  + ";" + strExpDate;
				if (dFn.optLanguage[2].checked)document.cookie = "Language=" + dFn.optLanguage[2].value  + ";" + strExpDate;
				// Obviously, you could invoke loop logic above if you had many buttons
				
				
				// If you want the index (ie 0,1,2,etc) of what was selected in the dropdown...
				document.cookie = "Course=" + dFn.cboCourse.selectedIndex + ";" + strExpDate;
				
				// Or, if you prefer the actual text (ie "Whatever I'm Passing") of what was selected in the dropdown...
				var which=dFn.cboCourse.selectedIndex;
				document.cookie = "CourseName=" + dFn.cboCourse[which].text + ";" + strExpDate;
				
				// Or, if you prefer assigned values (ie "WTVR") of what was selected in the dropdown...
				document.cookie = "CourseCode=" + dFn.cboCourse.value + ";" + strExpDate;
				
				// Recognize the conditional assignment to handle checkboxes?
				document.cookie = dFn.chkCpp.value  			+ ((dFn.chkCpp.checked)? "=yes;":"=no;")			+ strExpDate;
				document.cookie = dFn.chkVisualbasic.value  	+ ((dFn.chkVisualbasic.checked)? "=yes;":"=no;")	+ strExpDate;
				document.cookie = dFn.chkPhp.value  			+ ((dFn.chkPhp.checked)? "=yes;":"=no;")			+ strExpDate;
				document.cookie = dFn.chkJava.value  			+ ((dFn.chkJava.checked)? "=yes;":"=no;")			+ strExpDate;
				document.cookie = dFn.chkOracle.value  			+ ((dFn.chkOracle.checked)? "=yes;":"=no;")			+ strExpDate;
				document.cookie = dFn.chkHex.value  			+ ((dFn.chkHex.checked)? "=yes;":"=no;")			+ strExpDate;
				
				// Some debug code to help you.  Make sure you deactivate in your final version!
				alert ( "Cookies successfully written");
			}
				
			// Some debug code to help you.  Make sure you deactivate in your final version!
			alert ( "Leaving WriteCookies method with success = " + success);
			
			return success;
	}

</script>


</head>

<body>

<center>
<h1><font face="arial black" color="#669900">PHP Version</font></h1>
<font size="2" face="arial black" color="#000000">Fun with Forms</font><br/><br/>
<font size="-1" face="arial black" color="#000000"><a href=http://localhost/Demos/FormDemo.htm>( are you looking for the HTML example? )</a></font><br/><br/>
</center>

<table width="100%">

<tr>
       <td>
	   
<!-- Description of FORM tag :: 																				-->
<!-- Unique NAME is necessary for Javascript function used in the onSubmit event.  								-->
<!-- ONSUBMIT instructs form to call Javascript function.  														-->
<!-- ACTION tells form what page it goes to when form is submitted.  											-->
<!-- ACTION will only be performed if EditFields() returns true 												-->
<!-- METHOD "GET" passes the form elements and their values through URL parameters  							-->
<form name="frmMyForm1" onsubmit="return EditFields(document.frmMyForm1)" action="formdemo.get.php" 
      onreset="return confirm('Do you really want to reset the form?')" method="get">
<!-- Be aware of the fact that any syntax errors you make in EditFields() will result 							-->
<!-- in a "true" condition being returned.  That may confuse you if you are unaware of it!  					-->

<input type="hidden" name="hidMyHiddenField" value="Surprise!!!"></input>
<!-- Hidden fields are any data you might want to tag along with all the other form data  						-->
<!-- These fields are not entered, or seen by the user 															-->
<!-- It's a great way to pass on data from a previous page to a next page, even if this page doesn't need it 	-->


<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="500" bgcolor="#0033cc">
<tr>
	<td bgcolor="#666666"> 
		<table border="1" cellpadding="3" style="border-collapse: collapse" bordercolor="#cccccc" width="500" bgcolor="#ffffff" height="142">
		   
		   <tr>
			   <td rowspan=6 bgcolor=#66FF00>&nbsp</td>
		   	   <td width="500" height="18" colspan="2" bgcolor=#66FF00> 
			   	   <p align="center"><font size="2" face="arial black" color="#666666">frmMyForm1 :: Method GET</font></p>
			   </td>
		   </tr>
		   
		   <tr>
		   	  <td width="250" height="38">
			   	   <font size="2" face="arial">First Name<br /></font>
				   <font face="arial">
				   		<input type="text" name="txtFirstname" size="30"  maxlength="20">
				   </font>
			   </td>
			   <td width="250" height="38">
			   	   <font size="2" face="arial">Last Name<br /></font>
				   <font face="arial"> 
				   		 <input type="text" name="txtLastname" size="30"  maxlength="20">
				   </font>
			   </td>
		  </tr>
		  
		  <tr>
		  	  <td width="250" height="38">
			  	  <font size="2" face="arial">Language Preference<br /></font>
				  <font face="arial">
				  		<input type="radio"  name="optLanguage" value="English" >
				  </font>
				  <font size="2" face="arial"> English&nbsp; </font>
				  <font face="arial"> 
				  		<input type="radio" name="optLanguage" value="Français">
				  </font>
				  <font size="2" face="arial"> Français&nbsp; </font>
				  <font face="arial">
				  		<input type="radio" name="optLanguage" value="Español" checked  >
				  </font>
				  <font size="2" face="arial">Español</font>
			  </td>
			  <td width="250" height="38">
			  	  <font size="2" face="arial">Favorite Course<br /></font>
				  <font face="arial"> 
				  		<select size="1" name="cboCourse"> 
								<option value="SSWB" selected >ServerSide Websites</option>
								<option value="ETHC">Ethics</option>
								<option value="ISDP">ISDP</option>
								<option value="TECH">Technical Writing</option> 
								<option value="UNIX">Unix</option> 
								<option value="WTVR">Whatever I'm Passing</option>
						</select>
				  </font> 
			  </td>
		</tr>
		
		<tr>
			<td width="500" height="36" colspan="2">
				<font size="2" face="arial">
				  &nbsp;Preferred Computer Languages ::<br />
				  <input type="checkbox" name="chkCpp" value="C++"checked > C++&nbsp;
				  <input type="checkbox" name="chkVisualbasic" value="Visual Basic"> Visual Basic&nbsp;
				  <input type="checkbox" name="chkPhp" value="PHP"> PHP&nbsp;
				  <input type="checkbox" name="chkJava" value="Java"> Java&nbsp;
				  <input type="checkbox" name="chkOracle" value="Oracle"checked > Oracle&nbsp;
				  <input type="checkbox" name="chkHex" value="Hex"> Hex! 
				</font>
			</td>
	   </tr>
	   
	   <tr>
	   	   <td width="250" height="19">&nbsp;</td>
		   <td width="250" height="19">&nbsp;</td>
	  </tr>
	  
	  <tr>
	  	  <td width="250" height="1" bgcolor=#66FF00 align=right> ( Method = Get ) <input type="submit" value="submit" name="button1"></td>
		  <td width="250" height="1"><input type="reset" value="reset" name="button2"></td>
	  </tr>
	  
	  </table>
	  </td>
</tr>
</table>
</form>

</td>
       <td align=right>
	   
<!-- Description of FORM tag :: 																				-->
<!-- Unique NAME is necessary for Javascript function used in the onSubmit event.  								-->
<!-- ONSUBMIT instructs form to call Javascript function.  														-->
<!-- ACTION tells form what page it goes to when form is submitted.  											-->
<!-- ACTION will only be performed if EditFields() returns true 												-->
<!-- METHOD "POST" passes the form elements and their values through local memory instead of URL.  				-->
<form name="frmMyForm2" onsubmit="return EditFields(document.frmMyForm2)" action="formdemo.post.php"  
      onreset="return confirm('Do you really want to reset the form?')" method="post">
<!-- Be aware of the fact that any syntax errors you make in EditFields() will result 							-->
<!-- in a "true" condition being returned.  That may confuse you if you are unaware of it!  					-->

<input type="hidden" name="hidMyHiddenField" value="Surprise!!!"></input>
<!-- Hidden fields are any data you might want to tag along with all the other form data  						-->
<!-- These fields are not entered, or seen by the user 															-->
<!-- It's a great way to pass on data from a previous page to a next page, even if this page doesn't need it 	-->


<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="500" bgcolor="#0033cc">
<tr>
	<td bgcolor="#666666"> 
		<table border="1" cellpadding="3" style="border-collapse: collapse" bordercolor="#cccccc" width="500" bgcolor="#ffffff" height="142">
		   
		   <tr>
			   <td rowspan=6 bgcolor=#66CC00>&nbsp</td>
		   	   <td width="500" height="18" colspan="2" bgcolor=#66CC00> 
			   	   <p align="center"><font size="2" face="arial black" color="#666666">frmMyForm2 :: Method POST</font></p>
			   </td>
		   </tr>
		   
		   <tr>		   	   
		   	   <td width="250" height="38">
			   	   <font size="2" face="arial">First Name<br /></font>
				   <font face="arial">
				   		<input type="text" name="txtFirstname" size="30"  maxlength="20" />
				   </font>
			   </td>
			   <td width="250" height="38">
			   	   <font size="2" face="arial">Last Name<br /></font>
				   <font face="arial"> 
				   		 <input type="text" name="txtLastname" size="30"  maxlength="20" />
				   </font>
			   </td>
		  </tr>
		  
		  <tr>
		  	   <td width="250" height="38">
			  	  <font size="2" face="arial">Language Preference<br /></font>
				  <font face="arial">
				  		<input type="radio"  name="optLanguage" value="English" />
				  </font>
				  <font size="2" face="arial"> English&nbsp; </font>
				  <font face="arial"> 
				  		<input type="radio" name="optLanguage" value="Français"  checked  />
				  </font>
				  <font size="2" face="arial"> Français&nbsp; </font>
				  <font face="arial">
				  		<input type="radio" name="optLanguage" value="Español" />
				  </font>
				  <font size="2" face="arial">Español</font>
			  </td>
			  <td width="250" height="38">
			  	  <font size="2" face="arial">Favorite Course<br /></font>
				  <font face="arial"> 
				  		<select size="1" name="cboCourse"> 
								<option value="SSWB">ServerSide Websites</option>
								<option value="ETHC">Ethics</option>
								<option value="ISDP" selected >ISDP</option>
								<option value="TECH">Technical Writing</option> 
								<option value="UNIX">Unix</option> 
								<option value="WTVR">Whatever I'm Passing</option>
						</select>
				  </font> 
			  </td>
		</tr>
		
		<tr>
			<td width="500" height="36" colspan="2">
				<font size="2" face="arial">
				  &nbsp;Preferred Computer Languages ::<br />
				  <input type="checkbox" name="chkCpp" value="C++" /> C++&nbsp;
				  <input type="checkbox" name="chkVisualbasic" value="Visual Basic" /> Visual Basic&nbsp;
				  <input type="checkbox" name="chkPhp" value="PHP" /> PHP&nbsp;
				  <input type="checkbox" name="chkJava" value="Java" /> Java&nbsp;
				  <input type="checkbox" name="chkOracle" value="Oracle" /> Oracle&nbsp;
				  <input type="checkbox" name="chkHex" value="Hex" /> Hex! 
				</font>
			</td>
	   </tr>
	   
	   <tr>
	   	   <td width="250" height="19">&nbsp;</td>
		   <td width="250" height="19">&nbsp;</td>
	  </tr>
	  
	  <tr>
	  	  <td width="250" height="1" bgcolor=#66CC00 align=right > ( Method = Post ) <input type="submit" value="submit" name="button1"></td>
		  <td width="250" height="1"><input type="reset" value="reset" name="button2"></td>
	  </tr>
	  
	  </table>
	  </td>
</tr>
</table>
</form>


</td>
</tr>
<tr>
       <td>
	   
<!-- Description of FORM tag :: 																				-->
<!-- Unique NAME is necessary for Javascript function used in the onSubmit event.  								-->
<!-- ONSUBMIT instructs form to call Javascript function.  														-->
<!-- ACTION tells form what page it goes to when form is submitted.  											-->
<!-- ACTION will only be performed if WriteCookies() returns true 												-->
<form name="frmMyForm3" onsubmit="return WriteCookies(document.frmMyForm3)" action="formdemo.cookies.php" 
      onreset="return confirm('Do you really want to reset the form?')"method="post" >
<!-- Be aware of the fact that any syntax errors you make in WriteCookies() or EditFields() will result 		-->
<!-- in a "true" condition being returned.  That may confuse you if you are unaware of it!  					-->

<input type="hidden" name="hidMyHiddenField" value="Surprise!!!"></input>
<!-- Hidden fields are any data you might want to tag along with all the other form data 						-->
<!-- These fields are not entered, or seen by the user 															-->
<!-- It's a great way to pass on data from a previous page to a next page, even if this page doesn't need it 	-->


<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="500" bgcolor="#0033cc">
<tr>
	<td bgcolor="#666666"> 
		<table border="1" cellpadding="3" style="border-collapse: collapse" bordercolor="#cccccc" width="500" bgcolor="#ffffff" height="142">
		   
		   <tr>
		       <td rowspan=6 bgcolor=#669900>&nbsp</td>
		   	   <td width="500" height="18" colspan="2" bgcolor=#669900> 
			   	   <p align="center"><font size="2" face="arial black" color="#FFFFFF">frmMyForm3 :: Method COOKIES</font></p>
			   </td>
		   </tr>
		   
		   <tr>		   	   
		   	   <td width="250" height="38">
			   	   <font size="2" face="arial">First Name<br /></font>
				   <font face="arial">
				   		<input type="text" name="txtFirstname" size="30" maxlength="20">
				   </font>
			   </td>
			   <td width="250" height="38">
			   	   <font size="2" face="arial">Last Name<br /></font>
				   <font face="arial"> 
				   		 <input type="text" name="txtLastname" size="30" maxlength="20">
				   </font>
			   </td>
		  </tr>
		  
		  <tr>
		  	  <td width="250" height="38">
			  	  <font size="2" face="arial">Language Preference<br /></font>
				  <font face="arial">
				  		<input type="radio"  name="optLanguage" value="English"checked  >
				  </font>
				  <font size="2" face="arial"> English&nbsp; </font>
				  <font face="arial"> 
				  		<input type="radio" name="optLanguage" value="Français">
				  </font>
				  <font size="2" face="arial"> Français&nbsp; </font>
				  <font face="arial">
				  		<input type="radio" name="optLanguage" value="Español">
				  </font>
				  <font size="2" face="arial">Español</font>
			  </td>
			  <td width="250" height="38">
			  	  <font size="2" face="arial">Favorite Course<br /></font>
				  <font face="arial"> 
				  		<select size="1" name="cboCourse"> 
								<option value="SSWB">ServerSide Websites</option>
								<option value="ETHC">Ethics</option>
								<option value="ISDP">ISDP</option>
								<option value="TECH">Technical Writing</option> 
								<option value="UNIX">Unix</option> 
								<option value="WTVR" selected >Whatever I'm Passing</option>
						</select>
				  </font> 
			  </td>
		</tr>
		
		<tr>
			<td width="500" height="36" colspan="2">
				<font size="2" face="arial">
				  &nbsp;Preferred Computer Languages ::<br />
				  <input type="checkbox" name="chkCpp" value="CPP"> C++&nbsp;
				  <input type="checkbox" name="chkVisualbasic" value="VisualBasic"> Visual Basic&nbsp;
				  <input type="checkbox" name="chkPhp" value="PHP"> PHP&nbsp;
				  <input type="checkbox" name="chkJava" value="Java"> Java&nbsp;
				  <input type="checkbox" name="chkOracle" value="Oracle"> Oracle&nbsp;
				  <input type="checkbox" name="chkHex" value="Hex"> Hex! 
				</font>
			</td>
	   </tr>
	   
	   <tr>
	   	   <td width="250" height="19">&nbsp;</td>
		   <td width="250" height="19">&nbsp;</td>
	  </tr>
	  
	  <tr>
	  	  <td width="250" height="1" bgcolor=#669900 align=right><font color="#FFFFFF">( Method = Cookies )</font>
		  <input type="submit" value="submit" name="button1"> 
		  </td>
		  <td width="250" height="1"><input type="reset" value="reset" name="button2"></td>
	  </tr>
	  
	  
	  </table>
	  </td>
</tr>
</table>
</form>

	   </td>
	   <td>

<!-- Demos for Lab YeS.3 :: 																			    	-->

<center>
<font size="2" face="arial black" color="#000000">Shopping Cart Demos for Lab Yes.3</font>

<!-- Description of FORM tag :: 																				-->
<!-- Unique NAME is necessary for Javascript function used in the onSubmit event.  								-->
<!-- ACTION tells form what page it goes to when form is submitted.  											-->

<form name="frmBES1850" action="../Cart/index.php" method="get">
<input type="hidden" name="product" value="BES1850"></input>
<!-- Hidden fields are any data you might want to tag along with all the other form data 						-->
<!-- These fields are not entered, or seen by the user 															-->
<!-- It's a great way to pass on data from a previous page to a next page, even if this page doesn't need it 	-->

<table border="0" cellspacing="0" style="border-collapse: collapse">
<tr>
	<td> 
		<font size="2" face="arial"> BES1850 <input type="text" name="quantity" size="10" maxlength="10" value="1"></font>
	</td>

	<td>
		<INPUT TYPE="image" SRC="../Images/AddToCart.gif" HEIGHT="21" WIDTH="74" BORDER="0" ALT="( Using an image as a Submit button )" align="right">
	</td>

</tr>
</table>
</form>



<!-- Description of FORM tag :: 																				-->
<!-- Unique NAME is necessary for Javascript function used in the onSubmit event.  								-->
<!-- ACTION tells form what page it goes to when form is submitted.  											-->

<form name="frmDBE1450" action="../Cart/index.php" method="get">
<input type="hidden" name="product" value="DBE1450"></input>
<!-- Hidden fields are any data you might want to tag along with all the other form data 						-->
<!-- These fields are not entered, or seen by the user 															-->
<!-- It's a great way to pass on data from a previous page to a next page, even if this page doesn't need it 	-->

<table border="0" cellspacing="0" style="border-collapse: collapse">
<tr>
	<td> 
		<font size="2" face="arial"> DBE1450 <input type="text" name="quantity" size="10" maxlength="10" value="10"></font>
	</td>

	<td>
		<INPUT TYPE="image" SRC="../Images/AddToCart.gif" HEIGHT="21" WIDTH="74" BORDER="0" ALT="( Using an image as a Submit button )" align="right">
	</td>

</tr>
</table>
</form>


</center>

	 	   
	   </td>
      
</tr>
</table>

<br><hr><br>


</center>




</body>

</html>

