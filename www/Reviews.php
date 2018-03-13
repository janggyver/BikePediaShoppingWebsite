<!-- Reviews(Comments Part for each product) -->

<!-- Connecting to Database -->
<?php
	session_start();
	
	//server
	$db_server = "localhost";
	
	//database user name
	$db_user = "root";
	
	//database password
	$db_pwd = "";
	
	//database name
	$db_name ="ericjang";
	
	//1. create the connection to the local database
	$db_connected = new mysqli($db_server, $db_user, $db_pwd, $db_name);
	
	//2. check db connection
	if($db_connected->connect_error){
		trigger_error('Database connection Failed: '. $db_connected -> connect_error, E_USER_ERROR); // what is the difference from E_USER_NOTICE
	}
		
	// end of database connectiviy	
	?> 




<html>
<head>
	<title>  <?php echo $_GET['ProdCode'] ?> &nbsp;Review  </title>
	
	<!--Favicon -->
	<link rel="shortcut icon" href="/bike/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/include/ajaxComment.css" />
	
	<!-- JQuery library -->
	<script type="text/javascript" src="/include/jquery-1.3.2.min.js"></script>
	
	<script type="text/javascript">
	//step 1. This function is called whent the page loads
	
	//Clear form
	$(document).ready( function(){ //nameless function
		//clear the form 
		//All the form fields to be cleared on load, unless it's the submit button,
		//radio button values, or hidden controls
		$(':input').each (function(){
			if(this.type !="submit" && this.type !="hidden" && this.type !="radio" && this.name !="name"){
				this.value=""; // clear the current value of the control
				
			}
		}
		);
		$('#comment_submitted').hide();
		}
	);
	//end of jquery step 1.
	
	</script>
	
	<script type="text/javascript">
	//Step 4. This function is called when a customer submit a comment from the form.
	

	
	function frmComment_submit() {
		//Responsibilities:
		//  This function does 3 things.
		//	1. Call ajaxServer.php using jQurey function get(). This inserts the client comment into the database, and then display it on this page.
		//	2. Hide form where the comment was entered.
		//	3. Display the "Thank you" message. (What I want to display after posting.)
		//=================
		// Responsibility 1.
		// The $.get function is one utilization of jQuery's ajax capability.
		$.get(
		// Parameter 1. URL
		"ajaxServerComment.php",
		//Parameter 2. data sent to the server
		$("#frmComment").serializeArray(),
		//Parameter 3. the callback function. returned data from ajaxServer.php
		//				prepend it into appropriate div, and then hide another div.
		//				This is a nameless function, embeded as a parameter into the $.get().
		function(dataFromServer){
			//Build a comment element to be added to the page
			//dataFromServer is a OOP object (found in the incoming parameter list)
			//comment is a data element within that object 
			var commentDiv = '<div class="user_comment">'
						+ '<p><span class="user_comment_name">'
						+ 'You Commented:'
						+ '</span></p>'
						+ '<p class="user_comment_text">'
						+ dataFromServer.Review + '</p>'
						+ '<p> <br/><br/><img src="/Images/stars_rating_0' + dataFromServer.Rating + '.gif" height=19 width = 91 align=right> </p>'
						+ '</div>';
			
			//Prepend the comment to the appropriate element
			$("#previously_submitted_comments").prepend(commentDiv);
			//comment was submitted, so hide "the first" message
			$("#thefirst").hide();
		},
		//Parament 4. Type of data
		"json"
		);
		
		//Responsibilities 2
		//=============
		//Comment was submitted, so hide the comment form
		$("#submit_a_comment").hide();
		//Responsibilities 3
		//==============
		//Show the "thank you " message with slidedown animation
		
		$("#comment_submitted").slideDown("slow");

		return false;
	}
		//end of step 4.
	
	</script>
	
	<script type="text/javascript">
		<!-- close the window -->
		function CloseMe(){
			window.close();
		}
				
	</script>
	
	
</head>
<body>

<div id="wraper">
	<h3> Comments: </h3>
	<!--Step 2. Get from the database if any ..-->
	<div id="previously_submitted_comments">
		<?php
			//Select comments for only a spcific ProductCode
			//$ProdCode2 = $_GET['ProdCode']; //where ProductCode = ".$ProdCode." 
			$strComments = "select reviewid, ProductCode, CustomerName, CustomerEmail, Review, Rating 
							from reviews 
							where (ProductCode = '".$_GET['ProdCode']."') order by reviewid ";

			$rsComments = $db_connected->query($strComments);
			
			//Error Check
			if($rsComments == false){
				trigger_error("Wrong SQL: ".$strComments. "Error".$db_connected->error, E_USER_ERROR);
			}
			else{
				$rows_returned = $rsComments->num_rows; // return the numbers of row
			}

			/* Debugging and error checking
			// if the returned rows value 0, then show this message
			if($rows_returned == 0){
				die($db_name." : ".$strComments. " : No records retrieved.");  // why "" used instead of ''
			}
			//end of required record set retrieving			
			*/
					
			if($rsComments->num_rows == 0){
				//There are no comments yet. Display a special message.
				echo '
					<div class="user_comment" id="thefirst">
						Your review will be a good reference for the other customer. <br />
						Please leave a first review.
					</div>';
			}

			else while($rowComments = $rsComments->fetch_array(MYSQL_ASSOC)){

				//There are comments. Display all of them
				echo '
					<div class="user_comment">
						<p>Submitted By: <span class="user_comment_name">'.$rowComments['CustomerName'].'</span></p>
						<p class="user_comment_text">'.$rowComments['Review'].'</p>
						<p><br><br>
						
						<img src="/Images/stars_rating_0'.$rowComments['Rating'].'.gif" height=19 width=91 align=right> </p>
					</div>
				
				';
			}
		?>
	</div>	

	<!--Step 3. Enter a new comment -->
	<div id="submit_a_comment">
		<?php
		if(isset($_SESSION["userLoggedIn"])){
			echo '
			<h3> Submit a Comment: </h3>
			<form id="frmComment" 
					name="frmComment" 
					onsubmit="return frmComment_submit()"
					method="GET">
				<label for="name">Name:</label><br/>
				<input id="name" name="name" value="'.$_SESSION["FirstName"]." ".$_SESSION["LastName"][0].'" size="52"></input><br />
				<label for="comment">Comment:</label><br/>
				<textarea id="comment" name="comment" cols="40" rows="10"> </textarea><br/>
				<input type="hidden" name="ProdCode" value="'.$_GET['ProdCode'].'"> </input>
				<input type="hidden" name="EmailAddress" value="'.$_SESSION["userLoggedIn"].'"> </input> <br/>
				<label for="rating">Rating:</label>
					<input type="radio" name="radRating" value="1">Poor &nbsp;
					<input type="radio" name="radRating" value="2">Fair &nbsp;
					<input type="radio" name="radRating" value="3">Average &nbsp;
					<input type="radio" name="radRating" value="4">Good &nbsp;
					<input type="radio" name="radRating" value="5">Excellent &nbsp; <br/>
					
				<input type="submit" value="Submit" name="submit"></input>	 <br/> <br/>				

				
				<a href="javascript:CloseMe();"><img src="/images/continueshopping.jpg" widith="100" height="50"> </a>
			</form>';
			
		}
		else{
			echo '
			<br /> &nbsp;&nbsp;You can write a review after log-in. <br /><br/>
				<a href="reg/signin.php"> <img src="/images/login.png" width="100" height="100"> </a>
			';
		}
		?>
	</div>

	<!-- STEP.8 -- Confirm receipt of comment 									-->
	 <!-- This is initially hidden (in STEP.1) when the page first displays.	-->
	 <p id="comment_submitted">	 
	 <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 
		<img src="../Images/HappyGuy.jpg" align="left" height="85" width="85"><br /><br />
		Thank you for your comment. <br/>
		<a href="javascript:CloseMe();"><img src="/images/continueshopping.jpg" widith="100" height="50"> </a>
	 </p>


	 
</div>
<hr width=60%>

</body>
</html>