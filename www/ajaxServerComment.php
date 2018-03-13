<?php
//It receives the data user entered in the form via URL Parameter (Step 4. Parameter 2)

//connect to the database
session_start();
$db_name= "ericjang";
$db_connected = new mysqli("localhost", "root", "", $db_name);

//Check for any connection errors
if($db_connected->connect_error){
	trigger_error("Failed connecting to the database: ".$db_connected->connect_error, E_USER_ERROR);
}

//Step 6. Build an sql string, insert new comment ito the database
$strSQLInsertComment = "insert into reviews (ProductCode, CustomerName, Review, CustomerEmail, Rating)
						values ('"
						.$_GET['ProdCode'].
						"', '"
						.$_GET['name'].
						"', '"
						.$db_connected->real_escape_string($_GET['comment']).
						"', '"
						.$_SESSION['userLoggedIn'] . 
						"', '"
						. $_GET['radRating'] .
						"')";

$db_connected->query($strSQLInsertComment);



//Retrieve the ID generated for an AUTO_INCREMENT column by the previous query (usually insert)
$insert_id = $db_connected->insert_id;

//Retrieve data from inserted comment
$strSQLInsertedComment = "select reviewid, ProductCode, CustomerName, CustomerEmail, Review, Rating
							from reviews 
							where reviewid='$insert_id'";
$rsCommented = $db_connected->query($strSQLInsertedComment);



//Retrieve the newly inserted comment from the recordset, encode into JSON

while($rowInsertedComment = $rsCommented->fetch_array(MYSQLI_ASSOC)){
	$json_out = json_encode($rowInsertedComment);
}
	
//Step 7. return the JSON data to the Reviews.php page, which will display it in Step 4. parameter 3.
echo $json_out;


?>