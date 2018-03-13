<?php
// This code prevents page caching

	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 	// Date in the past
	header("Pragma: no-cache");
?> 

<?php
// This code suppresses deprecation errors

//		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

?>

<?php
// Database Connectivity
	//$db_server ="localhost";

    $db_name = "ericjang";

	//$db_user="root";
	
	//$db_pwd="";
	
	$db_connected = new mysqli("localhost", "root", "", $db_name);
	
	if ($db_connected->connect_error){	  
	  trigger_error("Failed to connect to the database server: ". $db_connected->connect_error, E_USER_ERROR);	  
	}   
	
?>


<html>
<head>
<title>Ajax Demo</title>

<!-- Required stylesheet 																-->
<link rel="stylesheet" type="text/css" href="../Include/ajaxDemo.css" />

<!-- jQuery is a JavaScript library, used to extend, enhance, and simplify JavaScript. 	-->
<!-- jQuery is accessed by simply including a JavaScript file. 	  		   				-->
<!-- Ref YeSV4.5.30 																	-->

<!-- This is not the "newest" jQuery library because I can't be bothered to update this	-->
<!-- lab *every* time a new release is made.  This version is good enough for our 		-->
<!-- purposes.  If *you* want to incorporate the latest version, download it and 		-->
<!-- implement accordingly.																--> 
<script type="text/javascript" src="../Include/jquery-1.3.2.min.js"></script>


<script type="text/javascript">	
	
	// STEP.1 -- This function is called when the page loads	
	// jQuery being used - Ref YeSV4.5.40 						

	// Clear the form - Ref YeSV4.6.20 or http://api.jquery.com/ready
	$(document).ready(	   function( ) {
						   	  // Clear the form (FF caches form data between refreshes by default)
							  
							  // Activate the following code if you want all the form fields to be cleared on load, 
							  // unless it's the Submit button, radio button values, or hidden controls.
							  // If you wanted other controls to *not be* cleared, you could add to this concept.
							  
							  
						   	   $(':input').each(	 function( ) {
							  					 	if (this.type != "submit" && this.type != "hidden" && this.type != "radio") {
							  			   			   this.value="";  // Clear the current value of the control.
							  						}
							  					 }
					  		 				  );

						   	  // Initially hide the "Comment Submitted" (STEP.8) message - Ref YeSV4.6.30 or http://api.jquery.com/hide 
						   	  $('#comment_submitted').hide( );

							 }
					);
	// End of jQuery STEP.1
	
</script>	




<script type="text/javascript">	
	
	// STEP.4 -- This JavaScript function will be called when you submit your comment via the form	
	// Ref YeSV4.7.10																				
	function frmComment_submit( ) {
	// Responsibilities ::
	// 		This JavaScript function does three things...
	// 		-----> (1) Call ajaxServer.php using the jQuery function get().  This inserts the client comment into the database, and then displays it on this page.
	// 		-----> (2) Hide the form where the comment was entered.
	// 		-----> (3) Display the "thank you" message.
	



// Responsibilities (1) ------------------------------------------------------------------------------------------------------------------------------------------------------------>
	
		// The $.get function is one utilization of JQuery's ajax capability
		// Ref http://api.jquery.com/jQuery.get 
		$.get(
			// (STEP.4) ***** Parameter 1: ***** the url of the remote script - Ref YeS4.7.30							
			// ajaxServer.php is the code that will insert our data into the appropriate table				
			// It receives data from this page, executes at the server, and returns control to this page.	
			// STEP.5 -- See the code in this file...														
			"ajaxServer.php", 
			
			// (STEP.4) ***** Parameter 2: ***** data sent to the server - Ref YeS4.7.40	
			// The form where you entered your data is called "frmComment"		
			$("#frmComment").serializeArray(),
			
			// (STEP.4) ***** Parameter 3: ***** the callback function - Ref YeS4.7.50						
			// ie What do you want to do with the data returned from ajaxServer.php? ...					
			// Prepend it into the appropriate div , and then hide another div.								
			// This is a "function without a name", embedded as a parameter into the $.get() .  			
			function(dataFromServer) {
				
				// DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE 	
				// If you're having problems with your ajaxServer page, 															
				// activate the following alert line *and* change parameter 4 below to "html".										
				// alert(data);	
				// DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE	
				
				// Build a comment element to be added to the page - Ref YeS4.7.60			
				// Recognize OOP principles in the concatenated field dataFromServer.comment below ??? 
				//			... dataFromServer is the object (found in the incoming parameter list) ,
				//			... .comment is a data element within that object (check ajaxServer.php to ensure it "selected and sent" a field called comment !
				var commentDiv = '<div class="user_comment">'
							   + '<p><span class="user_comment_name">'
							   + 'You commented:' 
							   + '</span></p>'
							   + '<p class="user_comment_text">' + dataFromServer.comment + '</p>'
							   + '<p><br/ ><br /><img src="../Images/stars_rating_' + dataFromServer.rating03.gif" height=19 width=91 align=right></p>'
							   + '</div>';
				
				// Prepend ("put before") the comment to the appropriate element - Ref YeS4.7.70	
				// So, you're instructing the page to display the <div> you built above 			
				// just before the <div> called "previously_submitted_comments" (see HTML below).	
				$("#previously_submitted_comments").prepend(commentDiv);
				
				// Comment was submitted, so hide "the first" message
				$("#thefirst").hide();
								
			}, 
						
			// (STEP.4) ***** Parameter 4:  ***** Type of Data - Ref YeS4.7.80
			"json"
			// DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE 	
			// If you're having problems with your ajaxServer page, 															
			// change the above to "html" and activate the alert(data) found at parameter 3 above.								
			// DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE 	
		);

		
		

// Responsibilities (2) ------------------------------------------------------------------------------------------------------------------------------------------------------------>
		
		// Comment was submitted, so hide the comment form - Ref YeS4.7.80 or http://api.jquery.com/hide 
		$("#submit_a_comment").hide();
		
		
		
// Responsibilities (3) ------------------------------------------------------------------------------------------------------------------------------------------------------------>

		// Show the "thank you" (STEP.8) message using a slideDown animation - Ref YeS4.7.80 or http://api.jquery.com/slidedown
		$("#comment_submitted").slideDown("slow");
		
		
		
		
		return false;
	}	
	// End of STEP.4
		
</script>


</head>

<body>

<div id="wrapper">
<!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 

	 <h3>Comments:</h3>

	 <!-- STEP.2 -- Get previous comments (if any) from the database -->
	 <div id="previously_submitted_comments">
	 <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 	 
	 <?php
	 
		  // When you're doing your page, you'll only want to select comments for a specific product.
		  $strSQL = "SELECT name, comment FROM ajaxdemo ORDER BY id DESC"; 
		  
		  $rsComments = $db_connected->query($strSQL);
		  
		  if ( $rsComments->num_rows == 0 ) { 
			 // There are no comments yet.  Display a special message.
		  	 echo '
					 <div class="user_comment" id="thefirst">
					 	    <p><img src="../Images/Comments.jpg" height="149" width="240" align="left">
							Customer reviews are submitted by consumers like you everyday! 
							These perspectives are a series of views of the product in different settings 
							that may help you in your purchasing decisions. 
							We do not filter reviews based on positive or negative content.</p>
					 </div>
				';
		  
		   }
		   else while ($rowComments = $rsComments->fetch_array(MYSQL_ASSOC)) {
			    // There are comments.  Display all of them.
		  		echo '
					 <div class="user_comment">
					 	  <p>Submitted By: <span class="user_comment_name">' . $rowComments['name'] . '</span></p>
						  <p class="user_comment_text">' . $rowComments['comment'] . '</p>
						  <p><br /><br /><img src="../Images/stars_rating_00.gif" height=19 width=91 align=right></p>
					 </div>
				';
		  }
		  
	 ?>
	 </div>

	 
	 
	 
	 
	 <!-- STEP.3 -- Enter new comment -->
	 <div id="submit_a_comment" >
	 <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 
	 	  <h3>Submit a Comment:</h3>
		  <form id="frmComment" name="frmComment" onsubmit="return frmComment_submit();">
		  <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 
		  		<label for="name">Name:</label><br />
				<input type="text" id="name" name="name" value="" size="52" /><br />
				<label for="comment">Comment:</label><br />
				<textarea id="comment" name="comment" cols="40" rows="10"></textarea><br />
				<input type="submit" value="Submit" name="submit" />
		  </form>
	 </div>

	 
	 
	 
	 
	 <!-- STEP.8 -- Confirm receipt of comment 									-->
	 <!-- This is initially hidden (in STEP.1) when the page first displays.	-->
	 <p id="comment_submitted">	 
	 <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 
		<img src="../Images/HappyGuy.jpg" align="left" height="85" width="85"><br /><br />
		Thank you for your comment.
	 </p>

	 
</div>

</body>
</html>