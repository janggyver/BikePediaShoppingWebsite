<HTML>
 
<HEAD>
<TITLE>Customer Registration:: BikePedia</TITLE>
<meta name="description" 	content="Get Premium customer support with registration">
<meta name="author" 		content = "Eric Jang , janggyver@gmail.com">
<meta name = "designer" 	content ="Eric Jang, janggyver@gmail.com">
<!-- <meta charset="UTF-8">	-->
<meta name="keywords" content= "Bikepedea registration, Bike, City, Road, Bike accessory">

<LINK HREF="../Include/Generic.css" TYPE="text/css" REL="STYLESHEET">
<link rel="stylesheet" type="text/css" href="../include/ProductPage.css" /> <!-- CSS for forms and footer -->



<script language="javascript" src="../Include/menuitems.js" type="text/javascript"></script>
<script language="javascript" src="../Include/menu.js" type="text/javascript"></script>
<script language="javascript" src="../Include/PopUpImage.js" type="text/javascript"></script>


<!--Favicon -->
<link rel="shortcut icon" href="../bike/favicon.ico">


	
	<script  type="text/JavaScript" >
	function Validation(dCRF){
		//Incoming Parameters: dCRF Represents document. "frmCustReg" form
		//Responsibilities: Performs Edits checks as required against all fields in form.
		//					Displays error messages for all fields failing tests.
		//					Sets focus to first field in error.
		//					Validates password matching, credit card number and email address format.
		//Return Value: TRUE if all edits passed, FALSE otherwise
		
		// debug code
		alert("Validation method called successfully");
	
	
		// Declares variables for the return results, error message and first error
		var success = true;
		var message = "";
		var firstError = "";
			
		// set several controls with same class - background color as white

		dCRF.txtEmailAddress.className = "inputok";
		dCRF.txtPassword.className = "inputok";
		dCRF.txtConfirmPassword.className = "inputok";
		dCRF.txtFirstName.className = "inputok";
		dCRF.txtLastName.className = "inputok";
		dCRF.txtAddressLine1.className = "inputok";
		dCRF.txtCreditCardNumber.className = "inputok";
		dCRF.txtCardHolderName.className = "inputok";


			
		// Validates the email address by calling a function
		if(dCRF.txtEmailAddress.value != "") {
			success = emailValidation(dCRF);
				if(success==false) {
					firstError=dCRF.txtEmailAddress;
					dCRF.txtEmailAddress.className = "inputreqd";
					message += "\n - Invalid E-mail address input. Please modify it.";
				}
			}

		// Validdate the credit card number by calling a function
		if(dCRF.txtCreditCardNumber.value !=""){
			success = CCValidation(dCRF.txtCreditCardNumber.value);
			
			if (success ==false){
			firstError = dCRF.txtCreditCardNumber;
			dCRF.txtCreditCardNumber.className = "inputreqd";
			message += "\n - Invalid Credit Card number was input. Check it again";
			}
				// debug code
		//alert("1111");
		}
		
		
		<!---- Verify whether the controls are blank or not, if blank, -------->
		<!----    set focus and change the background color ----------> 
		
		
		
		// verify email address
		if (dCRF.txtEmailAddress.value==""){
			if(firstError =="")
				firstError = dCRF.txtEmailAddress;
				dCRF.txtEmailAddress.className = "inputreqd";
				message += "\n - Please enter email address";
		}
		
		// verify txtPassword
		if (dCRF.txtPassword.value==""){
			if(firstError =="")
				firstError = dCRF.txtPassword;
				dCRF.txtPassword.className = "inputreqd";
				message += "\n - Please enter password";
		}
		
		
		// verify txtConfirmPassword
		if (dCRF.txtConfirmPassword.value==""){
			if(firstError =="")
				firstError = dCRF.txtConfirmPassword;
				dCRF.txtConfirmPassword.className = "inputreqd";
				message += "\n - Please enter password for confirm";
				
		}
		
			// verify the password matches or not.
		if(dCRF.txtConfirmPassword.value!=dCRF.txtPassword.value){
			alert("The passwords entered did not match");
		/* 	dCRF.txtPassword.className="inputreqd"; */
			dCRF.txtConfirmPassword.className="inputreqd";
					if(firstError ==""){
				firstError = dCRF.txtConfirmPassword;
				dCRF.txtConfirmPassword.className = "inputreqd";
					message += "\n - Please enter password for confirm";}
			dCRF.txtConfirmPassword.value ="";
	
		/*	dCRF.txtPassword.focus(); */
			success =false;
			}
			
		
		
		// verify txtFirstName
		if (dCRF.txtFirstName.value==""){
			if(firstError =="")
				firstError = dCRF.txtFirstName;
				dCRF.txtFirstName.className = "inputreqd";
				message += "\n - Please enter First Name";
		}
		
		
		// verify txtLastName
		if (dCRF.txtLastName.value==""){
			if(firstError =="")
				firstError = dCRF.txtLastName;
				dCRF.txtLastName.className = "inputreqd";
				message += "\n - Please enter your Last Name";
		}
		
		// verify txtAddressLine1
		if (dCRF.txtAddressLine1.value==""){
			if(firstError =="")
				firstError = dCRF.txtAddressLine1;
				dCRF.txtAddressLine1.className = "inputreqd";
				message += "\n - Please enter your address";
		
		}
		// verify txtCreditCardNumber
		if (dCRF.txtCreditCardNumber.value==""){
			if(firstError =="")
				firstError = dCRF.txtCreditCardNumber;
				dCRF.txtCreditCardNumber.className = "inputreqd";
				message += "\n - Please enter your Credit card number";
		}
				
		// verify txtCardHolderName
		if (dCRF.txtCardHolderName.value==""){
			if(firstError =="")
				firstError = dCRF.txtCardHolderName;
				dCRF.txtCardHolderName.className = "inputreqd";
				message += "\n - Please enter the name of Credit card holder";
		}
		
	
		
		// Display Error message and focus on the first Error
		if (message != ""){
			alert("Please follow the instruction and modify errors\n" + message);
			firstError.focus();
			success = false;
		}		

	

	
	//  debug code
	alert("557");
	return success;
	}	

	
	function emailValidation(dCRF){
		//Incoming Parameters: dCRF Represents document. "frmCustReg" form
		//Responsibilities: Validates email address with proper format
		//Return Value: TRUE if email format is proper, FALSE otherwise
	
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(dCRF.txtEmailAddress.value)){
			return true;
			}
		return false;
	}

	
	function CCValidation(ccNumb){
		//Incoming Parameters: ccNumb Represents credit card number value from the control in the form
		//Responsibilities: Validates credit card number is right or not
		//Return Value: TRUE if credit card number is valid, FALSE otherwise

	
		/* This script and many more are available free online at
		The JavaScript Source!! http://www.javascriptsource.com
		Created by: David Leppek :: https://www.azcode.com/Mod10

		Basically, the alorithum takes each digit, from right to left and muliplies each second
		digit by two. If the multiple is two-digits long (i.e.: 6 * 2 = 12) the two digits of
		the multiple are then added together for a new number (1 + 2 = 3). You then add up the 
		string of numbers, both unaltered and new values and get a total sum. This sum is then
		divided by 10 and the remainder should be zero if it is a valid credit card. Hense the
		name Mod 10 or Modulus 10. */

		var valid = "0123456789"  // Valid digits in a credit card number
		var len = ccNumb.length;  // The length of the submitted cc number
		var iCCN = parseInt(ccNumb);  // integer of ccNumb
		var sCCN = ccNumb.toString();  // string of ccNumb
		sCCN = sCCN.replace (/^\s+|\s+$/g,'');  // strip spaces
		var iTotal = 0;  // integer total set at zero
		var bNum = true;  // by default assume it is a number
		var bResult = false;  // by default assume it is NOT a valid cc
		var temp;  // temp variable for parsing string
		var calc;  // used for calculation of each digit

		// Determine if the ccNumb is in fact all numbers
		for (var j=0; j<len; j++) {
		  temp = "" + sCCN.substring(j, j+1);
		  if (valid.indexOf(temp) == "-1"){bNum = false;}
		}

		// if it is NOT a number, you can either alert to the fact, or just pass a failure
		if(!bNum){
		  /*alert("Not a Number");*/bResult = false;
		}

		// Determine if it is the proper length 
		if((len == 0)&&(bResult)){  // nothing, field is blank AND passed above # check
		  bResult = false;
		} else{  // ccNumb is a number and the proper length - let's see if it is a valid card number
		  if(len >= 15){  // 15 or 16 for Amex or V/MC
			for(var i=len;i>0;i--){  // LOOP throught the digits of the card
			  calc = parseInt(iCCN) % 10;  // right most digit
			  calc = parseInt(calc);  // assure it is an integer
			  iTotal += calc;  // running total of the card number as we loop - Do Nothing to first digit
			  i--;  // decrement the count - move to the next digit in the card
			  iCCN = iCCN / 10;                               // subtracts right most digit from ccNumb
			  calc = parseInt(iCCN) % 10 ;    // NEXT right most digit
			  calc = calc *2;                                 // multiply the digit by two
			  // Instead of some screwy method of converting 16 to a string and then parsing 1 and 6 and then adding them to make 7,
			  // I use a simple switch statement to change the value of calc2 to 7 if 16 is the multiple.
			  switch(calc){
				case 10: calc = 1; break;       //5*2=10 & 1+0 = 1
				case 12: calc = 3; break;       //6*2=12 & 1+2 = 3
				case 14: calc = 5; break;       //7*2=14 & 1+4 = 5
				case 16: calc = 7; break;       //8*2=16 & 1+6 = 7
				case 18: calc = 9; break;       //9*2=18 & 1+8 = 9
				default: calc = calc;           //4*2= 8 &   8 = 8  -same for all lower numbers
			  }                                               
			iCCN = iCCN / 10;  // subtracts right most digit from ccNum
			iTotal += calc;  // running total of the card number as we loop
		  }  // END OF LOOP
		  if ((iTotal%10)==0){  // check to see if the sum Mod 10 is zero
			bResult = true;  // This IS (or could be) a valid credit card number.
		  } else {
			bResult = false;  // This could NOT be a valid credit card number
			}
		  }
		}
		// change alert to on-page display or other indication as needed.
	//	if(bResult) {
	//	  alert("This IS a valid Credit Card Number!");
	//	}
		if(!bResult){
	//	  alert("This is NOT a valid Credit Card Number!");
		}
	return bResult; // Return the results
	} 
	
	

	function WriteCookies(dCRF) {
	// Incoming parameters :	dCRF represents document."Formname"
	// Responsibilities :		Calls Validation() function to check all user provided data in form.
	//							Writes cookies for all data only if all validation passed.
	// Return type :			TRUE if all validation passed, FALSE otherwise.
	
	
			
			// Debug code to check WriteCookies function starts
			//alert ("WriteCookies method successfully called\n\nCheck the next step");
			
			
			
			// Perform Validation checks, catch result
			var success=Validation(dCRF);	
		
			// Only write cookies if all validation passed 
			if (success) {
			
				// Debug Code stating actual writing
				alert ( "Trying to write cookies");
			
				var strExpDate;
				// Make sure this date is in the future - I did.
				strExpDate = " path=/; expires=Monday, 31-Dec-2018 12:00:00 GMT;";
		
				// Text boxes
			
				document.cookie = "EmailAddress=" + dCRF.txtEmailAddress.value + ";" + strExpDate;
				document.cookie = "Password=" + dCRF.txtPassword.value + ";" + strExpDate;
				document.cookie = "ConfirmPassword=" + dCRF.txtConfirmPassword.value + ";" + strExpDate;
				document.cookie = "FirstName=" + dCRF.txtFirstName.value +";" + strExpDate;
				document.cookie = "LastName=" + dCRF.txtLastName.value + ";" + strExpDate;
				document.cookie = "AreaCode=" + dCRF.txtArea.value + ";" + strExpDate;	
				document.cookie = "LocalCode=" + dCRF.txtLocal.value + ";" + strExpDate;
				document.cookie = "LastDigit=" + dCRF.txtLastDigit.value + ";" + strExpDate;
	
			
				document.cookie = "AreaCode2=" + dCRF.txtArea2.value + ";" + strExpDate;
				document.cookie = "LocalCode2=" + dCRF.txtLocal2.value + ";" + strExpDate; 
				document.cookie = "LastDigit2=" + dCRF.txtLastDigit2.value + ";" + strExpDate;

				document.cookie = "AddressLine1=" + dCRF.txtAddressLine1.value + ";" + strExpDate;
				document.cookie = "AddressLine2=" + dCRF.txtAddressLine2.value + ";" + strExpDate;	
				
				document.cookie = "CardHolderName=" + dCRF.txtCardHolderName.value + ";" + strExpDate;
				document.cookie = "CreditCardNumber=" + dCRF.txtCreditCardNumber.value + ";" + strExpDate;

		
				// Sample debug code
				// Want to see what's being written as a cookie?  Try activating the following line...
				 //alert ("LastName=" + dCRF.txtLastname.value + ";" + strExpDate );
				

				// Radio button group							
				for(i=0; i < dCRF.optLanguage.length ; i++){
					if(dCRF.optLanguage[i].checked){
						document.cookie = "Language=" + dCRF.optLanguage[i].value + ";" + strExpDate;
					}
				}

				// Dropdown Group
				
				//Title
				document.cookie = "Title=" + dCRF.cboTitle[dCRF.cboTitle.selectedIndex].text + ";" + strExpDate;
				
				// Province
				var provinceSelected = dCRF.cboProvince.selectedIndex;
				document.cookie = "Province=" + dCRF.cboProvince[provinceSelected].text + ";" + strExpDate;
				
				// Credit Card related
				document.cookie = "CreditCard=" + dCRF.cboCreditCard.value + ";" + strExpDate;
				document.cookie = "ExpiryMonth= " + dCRF.cboMonth.value + ";" + strExpDate;
				document.cookie = "ExpiryDate=" + dCRF.cboYear.value + ";" + strExpDate;
				

				
				// If you want the index (ie 0,1,2,etc) of what was selected in the dropdown...
				//document.cookie = "Course=" + dFn.cboCourse.selectedIndex + ";" + strExpDate;
				
				// Or, if you prefer the actual text (ie "Whatever I'm Passing") of what was selected in the dropdown...
				//var which=dFn.cboCourse.selectedIndex;
				//document.cookie = "CourseName=" + dFn.cboCourse[which].text + ";" + strExpDate;
				
				// Or, if you prefer assigned values (ie "WTVR") of what was selected in the dropdown...
				//document.cookie = "CourseCode=" + dFn.cboCourse.value + ";" + strExpDate;
				
				// Recognize the conditional assignment to handle checkboxes? - I didn't put check boxes in my form
				//document.cookie = dFn.chkCpp.value  			+ ((dFn.chkCpp.checked)? "=yes;":"=no;")			+ strExpDate;
				//document.cookie = dFn.chkVisualbasic.value  	+ ((dFn.chkVisualbasic.checked)? "=yes;":"=no;")	+ strExpDate;
				//document.cookie = dFn.chkPhp.value  			+ ((dFn.chkPhp.checked)? "=yes;":"=no;")			+ strExpDate;
				//document.cookie = dFn.chkJava.value  			+ ((dFn.chkJava.checked)? "=yes;":"=no;")			+ strExpDate;
				//document.cookie = dFn.chkOracle.value  			+ ((dFn.chkOracle.checked)? "=yes;":"=no;")			+ strExpDate;
				//document.cookie = dFn.chkHex.value  			+ ((dFn.chkHex.checked)? "=yes;":"=no;")			+ strExpDate;
		
				//Debug Code for successful
				//alert ( "Cookies successfully written");
			}
					
			// Debug Code
			alert ( "Leaving WriteCookies method with success = " + success);
			
			return success;

	}

	
	
	</script>



</HEAD>

<BODY>



<!-- Header -->
<div id="Header">

		<div id="HeaderLeft">
			<a href="../index.php"> 
			<img height="30"  alt="Home Page" src="../Images/BPlogo.gif" width="135" border="0" align="left" /> </a>
		</div>
		
		<div id="HeaderRight">
			<a href="../Cart/index.php" class="header"> 
			<img src="../Images/Shoppingcart.gif" height="18" width="127" border="0" align="ABSMIDDLE" /> Contains 0 Items </a>
		</div>
</div>
<!-- End of Header -->

<!-- Menu Bar -->
<div id="MenuBar">

	<div id="MenuBarLeft">
		<a href="../Reg/SignIn.php" class="Headerbar"> You are not signed in </a>
	</div>

	<div id="MenuBarRight">
		<a href="../Reg/SignIn.php" class="headerbar"> | My Account </a>
		<a href="../Cart/index.php" class="headerbar"> | My Cart </a>
		<a href="../Cart/Checkout.php" class="headerbar"> | Checkout </a>
		<a class="headerbar" href="../ContactUs.php"> | Contact Us </a>
	</div>
</div>
<!-- End of Menu Bar -->

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
				<option value="index.php" selected="selected"> Registration</option>
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


	<!-- Registration Form -->
	
	<!-- Description of FORM tag :: 																				-->
	<!-- Unique NAME is necessary for each form on your page						  								-->
	<!-- ACTION tells form what page it goes to when form is submitted.  											-->
	<!-- METHOD "GET" passes the form elements and their values through URL parameters  							-->
	
		
	<form 	name="frmCustReg"
			onsubmit="return WriteCookies(document.frmCustReg)" 
			action="index.cookies.php" 
			onreset="return confirm('Do you really want to reset the form?')" 
			method="post">
		
		<div id="RegForm" >
		
			<div class="RegFormFullColFirst">
				Email Address:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtEmailAddress" size = "25" maxlength="25" value="janggyver@gmail.com">
			</div>
		
			<br><br>
			
			<div class="RegFormFullColFirst" >
			Password:			
			</div>
			
			<div class="RegFormFullColSecond">
				<input type="text" name="txtPassword" size="25" maxlength="25" value="1111">
			</div>
			
			<br><br>
			<div class="RegFormFullColFirst">
			Confirm Password:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtConfirmPassword" size="25" maxlength="25" value="1111">
			</div>

			<br><br><br>
			<div class="RegFormFullColFirst">
			Title:
			</div>
			<div class="RegFormFullColSecond">			
				<select type="text" name="cboTitle" size="1">
					<option value="Mr." > Mr. </option>
					<option value="Miss"> Miss     </option>
					<option value="Mrs." selected> Mrs. </option>
					<option value="Ms."> Ms. </option>
				</select>
			</div>
			
			<br><br>
			<div class="RegFormFullColFirst">
			First Name: 
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtFirstName" size="25" maxlength="25" value="Eric">
			</div>

			<br><br>
			<div class="RegFormFullColFirst">
			Last Name:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtLastName" size="25" maxlength="25" value="Jang">
			</div>

			<br><br>
			<div class="RegFormLeftCol">
			Home Telephone: 
			</div>
			<div class="RegFormLeftColSecond">
			<input type="text" name="txtArea" size="2" maxlength="3" value="506"> 
				<input type="text" name="txtLocal" size="2" maxlength="3" value="634">
				<input type="text" name="txtLastDigit" size="3" maxlength="4" value="1265">
			</div>
			<div class="RegFormRightCol">
			Work Telephone: 
			</div>
			<div class="RegFormRightColSecond">
				<input type="text" name="txtArea2" size="2" maxlength="3" value="506">
				<input type="text" name="txtLocal2" size="2" maxlength="3" value="663">
				<input type="text" name="txtLastDigit2" size="3" maxlength="4" value="1232">
			</div>			
			
			<br><br>
			<div class="RegFormFullColFirst">
			Address Line 1:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtAddressLine1" size="25" maxlength="50" value="53 Hill Heights Road">
			</div>
			
			<br><br>
			<div class="RegFormFullColFirst">
			Address Line 2:
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtAddressLine2" size="25" maxlength="50" value="Saint John, E2K 2B1">
			</div>
			
			<br><br>
			<div class="RegFormFullColFirst">
			Province: 
			</div>
			<div class="RegFormFullColSecond">
				<select size="1" type="text" name="cboProvince">
					<option value="Alberta"> Alberta </option>
					<option value="BritishColumbia"> British Columbia </option>
					<option value="Manitoba"> Manitoba </option>
					<option value="NewBrunswick" selected="selected"> New Brunswick </option>
					<option value="NovaScotia"> Nova Scotia </option>
					<option value="Newfoundlandandlabrador"> Newfoundland and Labrador&nbsp; &nbsp; &nbsp;</option>
					<option value="Ontario">Ontario </option>
					<option value="PrinceEdwardIsland">Prince Edward Island </option>
					<option value="Saskatchewan">Saskatchewan </option>				
				</select>
			</div>
			
			<br><br><br>
			<div class="RegFormLeftCol">
			Credit Card Type: 
			</div>
			<div class="RegFormLeftColSecond">
				<Select size="1" name="cboCreditCard">
					<option value="AMEX"> AMEX </option>
					<option value="VISA" selected> VISA </option>
					<option value="Master"> Master &nbsp;&nbsp;</option>
				</Select>
			</div>
			<div class="RegFormRightCol">
			Card Number: 
			</div>
			
			<div class="RegFormRightColSecond">
			<input type="text" name="txtCreditCardNumber" size="20" maxlength="16" value="4563960122001999"> &nbsp;
			</div>

			<br><br>
			<div class="RegFormLeftCol">
			Expiry Date Month: 
			</div>
			
			<div class="RegFormLeftColSecond">
			<select size="1" name="cboMonth">
				<option value="January" > January</option>
				<option value="February" > February </option>
				<option value="March" > March </option>
				<option value="April" > April </option>
				<option value="May" > May </option>
				<option value="June" selected="selected"> June </option>
				<option value="July" > July </option>
				<option value="August" > August </option>
				<option value="September" > September </option>
				<option value="October" > October </option>
				<option value="November" > November </option>
				<option value="December" > December </option>
			</select>
			</div>

			<div class="RegFormRightCol">
			Expiry Date Year: 
			</div>
			
			<div class="RegFormRightColSecond">
			<select size="1" name="cboYear">
				<option value="2016" > 2016</option>
				<option value="2017" > 2017 </option>
				<option value="2018" selected > 2018</option>
				<option value="2019" > 2019 </option>
			</select>
			</div>
			
			<br><br> <br>
			<div class="RegFormFullColFirst">
			Card Holder Name: 
			</div>
			<div class="RegFormFullColSecond">
				<input type="text" name="txtCardHolderName" size="25" maxlength="25" value="Eric Jang">
			</div>

			<br><br><br>
			<div class="RegFormFullColFirst">
			Language Preference:
			</div>
			<div class="RegFormFullColSecond">
				<input type="radio" name="optLanguage" value="English" > English 
			<input type="radio" name="optLanguage" value="Francais">  Francais	
			<input type="radio" name="optLanguage" value="Espanol" checked>  Espanol 
			</div>
			
			<div class="RegFormButtons">
					<input type="submit" value="Register" name="cmdSubButton">
					<input type="reset" value="Reset Form" name="cmdResButton">
			</div>
		</div>
	</form>	
	<!-- End of Form -->			
			
		  <!-- Footer -->
		  <?php include('../include/footer.php') ?>
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
	
	<?php include ('../Include/LeftAds.php'); ?>
		
	<!-- End of Left Ads -->



</BODY>
</HTML>

