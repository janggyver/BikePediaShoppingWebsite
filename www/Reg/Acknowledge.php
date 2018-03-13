<!DOCTYPE HTML>

<!-- This DOCTYPE specifies HTML 5 http://dev.w3.org/html5/spec/ 									-->


<!-- Original content: 	Deborah Lindsay 															-->
<!-- Design:     		Joe Marriott 																-->

<!-- Fully compliant to HTML 5 specifications 														-->
<!-- Check your modifications at http://validator.w3.org/check 										-->

<!-- Want to develop your expertise beyond your classmates, thus increasing your career prospects?  -->
<!-- This page is cross referenced to the Google Search Engine Optimization Starter Guide.  		-->

<?php

	session_start();

	if (isset($_GET['destroy'])) {
	
		if (isset($_SERVER['HTTP_COOKIE'])) {     
				$cookies = explode(';', $_SERVER['HTTP_COOKIE']);     
				foreach($cookies as $cookie) {         
					$parts = explode('=', $cookie);         
					$name = trim($parts[0]);         
					setcookie($name, '', time()-1000);         
					setcookie($name, '', time()-1000, '/');     
		} 
	} 	
								   				 
	}
									 
?>


<html>

<head>
	
	<title>Registration Complete</title>  <!-- SEO Page 4 "Create unique, accurate page titles" -->
	
	<meta charset="UTF-8">	
	<!-- 	This ensures that the browser knows what the character encoding is before it does anything else. 							
			UTF-8 a variable-width encoding that can represent every character in the Unicode character set. 							
			UTF-8 has become the dominant character encoding for the World-Wide Web, accounting for more than half of all Web pages. 	
	-->
	
	<meta name="robots" content="noindex, nofollow">	
	<!-- 	There are some pages you want the search engine robots to ignore	-->
	
	<meta name="author" content="Deborah Lindsay, a.programmer@nbcc.ca">
	<!-- 	If you have many individuals that are contributing to the content of your website, 
			use the Meta Author tag to help track the author who wrote specific pages.
	-->

	
	<link rel="stylesheet" href="../include/Style_SOG.css" type="text/css">
	<script language="JavaScript" src="../Include/PopUpPage.js"></script>
	
	
</head>


<body>

<h> <a href="http://localhost/reg/index.php"> Go to Resistration Page  </a> </h>
	
	
<?php 
	
	// Display URL parameters in raw format

	echo '<pre><h3>GET... (URL Parameters)</h3>';
			print_r($_GET);
	echo '</pre>';
	
	echo '<hr>';
	
	// Display POST info in raw format

	echo '<pre><h3>POST...</h3>';
			print_r($_POST);
	echo '</pre>';
	
	echo '<hr>';
	
	// Display cookies in raw format

	echo '<pre><h3>COOKIES...</h3>';
	echo '<a href="Acknowledge.php?destroy=1"> ( Destroy ) </a> <br><br>';
			print_r($_COOKIE);
	echo '</pre>';
	
	
?>

							 


		 	
	</div>
	<!-- End of Generic Content Area -->


<h> <a href="http://localhost/reg/index.php"> Go to Resistration Page  </a> </h>

	
	
<!-- Modified by Eric Jang -->	
</body>
</html>
