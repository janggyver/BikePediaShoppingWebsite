<?php
// For instructor's use only

	session_start();
?>


<html>
<head>
	<title>Seek All Session Variables, All Cookies</title>
	<LINK HREF="Include/Generic.css" TYPE="text/css" REL="STYLESHEET">
</head>

<body>

<table>
<tr>
<td valign="top">
<a href="Destroy.php"><img src="Images/BigRedButton.jpg" alt="Nuke!" height=180 width=240 border=0><br clear="all"></a>
</td>
<td>
<?php 
	echo '<pre><h3>Session Variables...</h3>';
			print_r($_SESSION);
	echo '<h3>Cookies...</h3>';
			print_r($_COOKIE);
	echo '</pre>';
?>
</td>
</tr>
</table>


</body>
</html>
