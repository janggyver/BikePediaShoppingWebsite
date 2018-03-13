<?php

echo '<pre>';
print_r($_POST);
echo '</pre>';

echo '<pre>';
print_r($_FILES);
echo '</pre>';

if ( isset($_FILES['uploadedfile']) ) {
	
	// where our file is going (in this case, "this" directory)
	$target_path = "./";
	
	// the name of our file
	$filename = basename($_FILES['uploadedfile']['name']);
	
	// try to upload the file
	if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path . $filename) ) {
		echo "File uploaded successfully.";
		
		// Step 1. a) check filetype
		$acceptable_filetypes = array(".jpeg", ".jpg", ".png");
		$filetype = strtolower( substr($filename, strrpos($filename, ".")) );
		if ( in_array($filetype, $acceptable_filetypes) ) 
		{
			
			// try to create the thumbnail
			if ( CreateThumbnail($target_path . $filename, $filetype) ) 
			{
				echo 'Thumbnail created successfully.';
			} 
			else 
			{
				echo "There was an error creating the thumbnail.";
			}
		} 
		else 
		{
			echo "File must be jpeg, jpg, or png";
		}
		
	} 
	else
	{
		echo "There was an error uploading the file.";
	}
}


function CreateThumbnail($file, $filetype, $thumb_width = 100, $thumb_height = 600 ) {

	// Step 1. b) create image handle
    if( $filetype == ".png" )
    {
        $base_img = ImageCreateFromPNG($file);
    }
    else if( ($filetype == ".jpeg") || ($filetype == ".jpg") )
    {
        $base_img = ImageCreateFromJPEG($file);
    } 

    // if the image is broken, cancel the operation
    if ( !$base_img)
        return false;


    // Step 2. get image sizes from the image object we just created
    $img_width = imagesx($base_img);
    $img_height = imagesy($base_img);


    // Step 3. resize the image
	//	a) work out which way we need to resize it
    $img_width_per  = $thumb_width / $img_width;
    $img_height_per = $thumb_height / $img_height;

    if ($img_width_per <= $img_height_per)
    {
		// resize per the width
        $thumb_width = $thumb_width;
        $thumb_height = intval($img_height * $img_width_per);
    }
    else
    {
		// resize per the height
        $thumb_width = intval($img_width * $img_height_per);
        $thumb_height = $thumb_height;
    }

	// create the image size
    $thumb_img = ImageCreateTrueColor($thumb_width, $thumb_height);

	// copy our original image into our new thumbnail-sized image
    ImageCopyResampled($thumb_img, $base_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $img_width, $img_height);

	// put the thumbnail in the current directory
    if( $filetype == ".png" )
    {
        ImagePNG($thumb_img, "sm_" . basename($file));
    }
    else if( ($filetype == ".jpeg") || ($filetype == ".jpg") )
    {
        ImageJPEG($thumb_img, "sm_" . basename($file));
    }
	
	// and a little housekeeping...
    ImageDestroy($base_img);
    ImageDestroy($thumb_img);

    return true;
}

?>

<html>
<head>
	<title>Upload Demo</title>
</head>

<body>

<form enctype="multipart/form-data" action="UploadDemo.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form>

</body>
</html>