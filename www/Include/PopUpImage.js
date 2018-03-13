
<!-- Function(s) to "pop up" an image, complete with correct page title and alt -->

function PopUpImage(img2PopUp, popUpTitle, popUpAlt){
  
  objImage= new Image();
  objImage.src=(img2PopUp);
  
  PullIntoCache(img2PopUp, popUpTitle, popUpAlt);

}

  
function PullIntoCache(img2PopUp, popUpTitle, popUpAlt){
  
  if( ( objImage.width != 0 ) && ( objImage.height != 0 ) ){
	// The image is recognized, proceed to display
    DisplayImage(img2PopUp, popUpTitle, popUpAlt);
  }
  else{
	// The image needs to be pulled into the cache before proceeding
    tryAgain="PullIntoCache('" + img2PopUp + "' , '" + popUpTitle + "' , '" + popUpAlt + "' )";
    interval=setTimeout(tryAgain,20);
  }

 }

function DisplayImage(img2PopUp, popUpTitle, popUpAlt){
 
 		// Setting window size larger than the actual image size
		desiredWidth = objImage.width *= 1.5;
		desiredHeight = objImage.height;
		
		// Build a string of attributes to be used when creating the new window
		windowAttributes = "width=" + desiredWidth + ",height=" + desiredHeight;
		
		// "Pop up" the new window with no content
		// Ref http://www.w3schools.com/jsref/met_win_open.asp
		popUp = window.open( "" , "" , windowAttributes );		
		  
		// If nothing was passed in for Title or ALT, set to default values
		popUpTitle = popUpTitle + " - BikePedia";	
		popUpAlt = popUpAlt || " ";
		
		// Build a small webpage consisting of an appropriate title, and the image to be displayed
		// Since you're building a page, you can embellish it with anything here.
		popUpContent = '<html><head><title>' + popUpTitle + '<\/title>';
		popUpContent += '<link href="..\/Include\/ProductPage.css" type="text\/css" rel="stylesheet" \/>';
		popUpContent += '<\/head><body>';
		popUpContent += '<img src="' + img2PopUp + '" alt="' + popUpAlt + '" style="float:left" >';
		popUpContent += '<br><br><h3 align=center>'+popUpAlt+'<\/h3>';
		popUpContent += '<h3 align=center>'+popUpTitle+'<\/h3>';
		popUpContent += '<\/body><\/html>';
		
		// Display the above webpage in the new popup window
		popUp.document.write(popUpContent); 


  }
