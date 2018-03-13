<?php
// For instructor's use only

	// 	Destroy all session variables        
	session_start();
	session_destroy();
		   
	// Destroy all cookies created by LOCALHOST  
	if (isset($_SERVER['HTTP_COOKIE'])) {     
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);     
		foreach($cookies as $cookie) {         
			$parts = explode('=', $cookie);         
			$name = trim($parts[0]);         
			setcookie($name, '', time()-1000);         
			setcookie($name, '', time()-1000, '/');     
		} 
	} 	   

?>


<html>
<head>
	<title>Destroy All Session Variables, All Cookies</title>
	<LINK HREF="Include/Generic.css" TYPE="text/css" REL="STYLESHEET">
</head>

<body>

<table>
<tr>
<td valign="top">
<img src="Images/Nuke2.jpg" height=202 width=250><br clear="all">
</td>
<td>
<pre>
<h3>All Session Variables, All Cookies Destroyed</h3>		
<a href="index.php">To Home Page</a><br><br>
<a href="Demos/index.php">To Demos Page</a><br><br>
<a href="Products.php">To Products Page</a><br><br>
<a href="LanguageTrans/index.php">To LanguageTrans Page</a>
</pre>
</td>
</tr>
</table>
</body>
</html>
