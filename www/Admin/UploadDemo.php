<?php

// Code to create and save a ( 100 x ?height? ) thumbnail from a user uploaded image.													
// This page links back to itself.  Be aware of that when making a copy.														     	

// This page makes extensive use of the GD Graphics Library.  Ensure that it is enabled in your WAMP configuration.						
// For more about GD, visit http://www.boutell.com/gd/ or http://php.net/manual/en/book.image.php										

// When a file is uploaded to the server, it is stored in a temporary location (see ['tmp_name'] from the DEBUG output on your screen). 
// If the file is not copied to another location, it is deleted from the server and no longer accessible. 								

// *******************************************************************************************************************************************
// The code below ( controlled by the 'if' ) is not executed the first time the page is called.																	
// If you're reading this page for the first time, skip down to the HTML below ( "the actual page", approx line 200 ) to start the process.
// *******************************************************************************************************************************************
									
// Once you enter a filename into the form and press the 'Upload File' button, this page links back to itself.							
// Then, this 'if' is executed.................										 																	

if ( isset($_FILES["uploadedfile"]) ) {
	
	// Note the appearance of this message, showing you when this block of code is executed.
	// It is included for debug purposes only.												
	echo 'I detect you are attempting to upload a Product.  Here are the results...<br/><br/>';

	// I'm just proving other form controls come along with the uploaded file.			
	echo ( isset($_POST['txtProdID']) ? 'Product ID : ' . $_POST['txtProdID'] . '<br>' : " " );
	
	// Where our fullsized image is going (in this case, the Demos Images directory).	
	// Try $target_path = "../LanguageTrans/Images/"; 									
	// $target_path = "../Demos/Images/";
	   $target_path ="../LanguageTrans/Images/";
	
	
	// Where our thumbnail is going (in this case, the Demos Images directory).			
	// Try $thumbnail_path = "../LanguageTrans/Images/";							 	
	// $thumbnail_path = "../Demos/Images/";
		$thumbnail_path = "../LanguageTrans/Images/";
		
		
	// The name of our file, extracted from the original filename of the image you uploaded.   	
	// If you want to call it anything else, this is the place to do it!						
	$filename = basename($_FILES["uploadedfile"]["name"]);
	
	
	// Try to upload the file.			
	if( move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $target_path . $filename) ) {
		echo 'File uploaded successfully.<br />';
		
		// Check filetype to determine if uploaded file is an image.							
		// The site we have been developing only uses JPEGS (if you're been following specs).	
		// The PNG code is provided for your information only.									
		$acceptable_filetypes = array(".jpeg", ".jpg", ".png");
		$filetype = strtolower( substr($filename, strrpos($filename, ".")) );		
		if ( in_array($filetype, $acceptable_filetypes) ) {			
			// Try to create the thumbnail by calling the function provided below.		
			if ( CreateThumbnail($thumbnail_path , $target_path . $filename , $filetype) ) {
				echo 'Thumbnail created successfully.<br />';
			} 
			else {
				echo 'There was an error creating the thumbnail.<br />';
			}
		} 
		else {
			echo 'File must be jpeg, jpg, or png to create a thumbnail.<br />';
		}
		
	} 
	else {
		echo 'There was an error uploading the file.<br />';
	}
}

?>




<?php
// This function is ***only*** executed by the logic above.  The PHP engine ***does not*** "automatically" drop into it.


function CreateThumbnail($thumb_dir, $file, $filetype, $thumb_width = 100, $thumb_height = 6000 ) {
// Incoming parameters : 	Thumbnail Directory Path														
//							Name of fullsize image															
//							Type of image ( .jpg, .jpeg, .png )												
//							Desired thumbnail width (defaults to maximum 100 if nothing is passed)			
//							Desired thumbnail height (defaults to maximum 6000 if nothing is passed)		
//
// Responsibilities :		Creates a thumbnail of size 100x? in format FullsizeName_sm.??? , 				
//							where ??? is the original extension , and places into the specified directory	
//
// Return Value :			TRUE if thumbnail successfully created, FALSE otherwise.							


	// Create image handle using GD functions.																		
	// ImageCreateFromPNG() returns an image identifier representing the image obtained from the given filename. 	
	// Ref http://ca.php.net/manual/en/function.imagecreatefrompng.php												
	// ImageCreateFromJPEG() returns an image identifier representing the image obtained from the given filename.	
	// Ref http://ca.php.net/manual/en/function.imagecreatefromjpeg.php												
    if( $filetype == ".png" ) {
        $base_img = ImageCreateFromPNG($file);
    }
    else if( ($filetype == ".jpeg") || ($filetype == ".jpg") ) {
        $base_img = ImageCreateFromJPEG($file);
    } 

    // If the image is broken, cancel the operation.								
    if ( !$base_img ) return false;

    // Get image sizes (width/height) from the image object we just created.		
    $img_width = imagesx($base_img);
    $img_height = imagesy($base_img);


    //  Resize the image, maintaining aspect ratio.																	
	
	//	Question - What's the ideal percentage to get to our preferred thumbnail width or height? 					
	//																												
	//  Because we want thumbnails of width 100, we forced the situation											
	//  by making $thumb_height ridiculously large above (6000).  For most circumstances, your thumbnails should	
	//  generate at 100 wide.   If you encounter odd situations which do not work, you may want to resize			
	//  the fullsized image before using this.																		
    $img_width_per  = $thumb_width / $img_width;
    $img_height_per = $thumb_height / $img_height;	

    if ($img_width_per <= $img_height_per)  {
		// Resize per the desired width (100) , and the appropriate height.									
        $thumb_width = $thumb_width;
        $thumb_height = intval($img_height * $img_width_per);
    }
    else {
		// Resize per the desired height.  This code should not be executed, but has been provided FYI.		
        $thumb_width = intval($img_width * $img_height_per);
        $thumb_height = $thumb_height;
    }

	// Create a new true color image using GD function.														
	// ImageCreateTrueColor() returns an image identifier representing a black image of the specified size. 
	// Ref http://php.net/manual/en/function.imagecreatetruecolor.php										
    $thumb_img = ImageCreateTrueColor($thumb_width, $thumb_height);

	// Copy our original image into our new thumbnail-sized image using GD function.						
	// ImageCopyResampled() copies a rectangular portion of one image to another image, smoothly 			
	// interpolating pixel values so that, in particular, reducing the size of an image still retains		
	// a great deal of clarity.																				
	// Ref http://ca.php.net/manual/en/function.imagecopyresampled.php										
    ImageCopyResampled($thumb_img, $base_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $img_width, $img_height);

	// Put the newly created thumbnail in the specified directory from the incoming parameter list.			
	// The site we have been developing only uses JPEGS (if you're been following specs).	
	// The PNG code is provided for your information only.									
    if ( $filetype == ".png" )   {
        // Inject "_sm" into the filename to adhere to our thumbnail naming convention.						
		// str_replace() replaces all occurrences of the search string with the replacement string,			
		// and returns the newly constructed string.														
		// Ref http://php.net/manual/en/function.str-replace.php											
		// We're saying " in the filename xyz.png, replace '.png' with '_sm.png' , resulting in xyz_sm.png "
		$tmb = "_sm";	
		$ext = ".png";
		$file = str_replace($ext , $tmb.$ext , $file);
		
		// ImagePNG() - Output a PNG image to either the browser or a file.									
		// Ref http://php.net/manual/en/function.imagepng.php												
		ImagePNG($thumb_img, $thumb_dir . basename($file));
    }
    else if ( ($filetype == ".jpeg") || ($filetype == ".jpg") )   {        
		// Inject "_sm" into the filename to adhere to our thumbnail naming convention.						
		// See above for further explanation.																
		$tmb = "_sm";
		$ext = ($filetype==".jpg")? ".jpg" : ".jpeg";
		$file = str_replace($ext , $tmb.$ext , $file);
			
		// ImageJPEG() - Output a JPEG image to either the browser or a file.								
		// Ref http://php.net/manual/en/function.imagejpeg.php												
		ImageJPEG($thumb_img, $thumb_dir . basename($file));		
    }
	
	// And a little housekeeping...																			
	// ImageDestroy() frees any memory associated with image.												
	// Ref http://php.net/manual/en/function.imagedestroy.php												
    ImageDestroy($base_img);
    ImageDestroy($thumb_img);

    return true;
}

// function CreateThumbnail() ends here.																	
?>








<!-- The "actual page" (HTML) starts here. 																								    -->
<!--																																		-->


<html>
<head>
	<title>Upload Demo</title>
</head>

<body>
<hr/>
<!-- A simple form to enter an image to upload 																								-->
<!--																																		-->
<!-- •	enctype="multipart/form-data" - Used for submitting forms that contain files, non-ASCII data, and binary data. 						-->
<!-- •	input type="hidden" name="MAX_FILE_SIZE” value="300000" - Sets the maximum allowable file size, in bytes, that can be uploaded. 	-->
<!-- •	input name="uploadedfile" - uploadedfile is the handle we will use to reference the file in our PHP script. 						-->

<form enctype="multipart/form-data" action="UploadDemo.php" method="POST">
<!-- Make sure you change the action when making a copy of this page! -->
	
	<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
	
	Product ID: <input type="text" name="txtProdID" value="BES1850" />
	
	<br /><br /><br />
	
	Choose an image to upload: <input name="uploadedfile" type="file" value="Find File" />
	
	<br /><br /><br />
	
	<input type="submit" value="Upload File" />

</form>

<!-- This link is provided for debug purposes.  If you use it, it shows that if you surf to the page 	-->
<!-- without uploading anything, the PHP code at the top does not get executed.							-->											
<a href="UploadDemo.php">Reload page (without uploading anything)</a> <br>

<?php
// For debug purposes only																						
// We will use the "Super Global" $_FILES to access our uploaded file, specifically $_FILES['uploadedfile']. 	
// You've seen $_POST previously.																				

	echo '<
	pre> $_POST ';
	print_r($_POST);
	echo '</pre>';

	echo '<pre> $_FILES ';
	print_r($_FILES);
	echo '</pre>';

?>

</body>
</html>
