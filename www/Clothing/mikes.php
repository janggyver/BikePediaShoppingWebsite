
<?php
 
 
 
 
 
  //Start of database connection
  //declare variables to hold server name, username, password and database name to connect to the database
                                $dbserver = "localhost";
                                $dbuser = "root";
                                $dbpassword = "";
                                $dbdbname = "mikemaloney";
                               
  // Connect to database
                               
                                $dbconnected = new mysqli( $dbserver,$dbuser,$dbpassword,$dbdbname);
               
  //Verify connection
 
                                if ( $dbconnected -> connect_error ){
                                               
                                                trigger_error('Database connection failed: ' . $dbconnected -> connect_error, E_USER_ERROR);
                                }
 
  //End of connecting
 
  $PageID = empty($_GET['PageID'])? "" : $_GET['PageID'];
               
                // Retreive record set
                $strProdDetails = "SELECT PageId, category, department, meta from productdesc WHERE PageId = '$PageID' ";
               
                $rsDetail = $dbconnected -> query($strProdDetails);
               
                if ($rsDetail === false){
                               
                                trigger_error('Wrong SQL; ' . $strDetails . ' Error ' . $dbconnected -> error , E_USER_ERROR);
                               
                                }             
                                else{
                                                $rowReturned= $rsDetail -> num_rows;
                                }
                               
                                if ($rowReturned == 0 ) {
                                                die($dbdbname . " : " . $strProdDetails . " No Page found ");
                                               
                                }
                               
                $rowDetail =  $rsDetail->fetch_array(MYSQLI_ASSOC);                 
               
                $strCategory = $rowDetail["category"] ;               
               
                $strSQL = "SELECT productcode, productname, productdesc, category, department, regprice, option1, option2, option3
                                                                                FROM products WHERE category = '$strCategory' Order by productcode ";
                               
               
               
                $rsProd = $dbconnected -> query($strSQL);
 
                if ($rsProd == false){
                               
                                trigger_error('Wrong SQL; ' . $strSQL . ' Error ' . $dbconnected -> error , E_USER_ERROR);
                               
                                }             
                                else{
                                                $rowReturned= $rsProd -> num_rows;
                                }
                               
                                if ($rowReturned == 0 ) {
                                                die($dbdbname . " : " . $strSQL . " No records found ");
                                               
                                }
                                              
                                //End record retreival
                               
echo'<html>
 
  <head>
 
     <title>' . $rowDetail["category"] . ':' . $rowDetail["department"] . ':Maloney\'s Hardware Depot
    </title>            
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="description"                     content="' . $rowDetail["meta"] . '" />
    <meta name="author"                              content="Mike Maloney, mikermaloney@hotmail.com" />
                <meta name="designer"              content="JE Marriott, joe.marriott@nbcc.ca" />
               
 
                ';
                ?>
    <link href="../Include/ProductPage.css" type="text/css" rel="stylesheet" />
               
                <link rel="shortcut icon" href="../Maloney's.ico">
               
 
                <script language="javascript" src="../Include/menuitems.js" type="text/javascript"></script>
                <script language="javascript" src="../Include/menu.js" type="text/javascript"></script>
                <script language="javascript" src="../Include/PopUpImage.js" type="text/javascript"></script>
               
                               
               
  </head>
 
  <body>
                <!-- Header -->
                <div id="Header">
               
                                 <div id="HeaderLeft">    
            <a href="../index.php"> <img height="35" alt="Home Page" src="../Images/toollogo.jpg" width="105" border="0" align="left" /> </a>
                                </div>
                               
                                 <div id="HeaderRight">         
            <a href="../Cart/index.php" class="header">
                                                <img src="../Images/shoppingcart.gif" height="18" width="127" border="0" align="ABSMIDDLE" /> Contains 0 Items</a>
                                </div>
                                         
    </div>
    <!-- End of Header  -->
               
               
                <!-- Menu Bar -->
                <div id="MenuBar">
  
                                 <div id="MenuBarLeft">
            <a href="../Reg/SignIn.php" class="headerbar">You are not signed in</a>
                                </div>
       
                                 <div id="MenuBarRight">
            <a href="../Reg/SignIn.php" class="headerbar">| My Account</a>
                                                <a href="../Cart/index.php" class="headerbar">| My Cart</a>
                                                <a href="../Cart/Checkout.php" class="headerbar">| Checkout</a>
                                                <a class="headerbar" href="../ContactUs.php">| Contact Us</a>
                                </div>
        
                </div>
    <!-- End of Menu Bar -->
               
               
                <!-- "You Are Here" and Search -->
                <div id="Search">
   
                                 <div id="SearchLeft">
            <form action="../search/index.php" method="get">
                                                                  <input type="text" name="txtsearch" value="Search" size="15" />
                                                                  <input type="image" src="../images/go.gif" border="0" width="26" height="21"  align="middle" />
                                                </form>
                                </div>
   <?php    
                                echo' <div id="YouAreHereList">                                            
                                                 <form action="">
                                                                  <!-- Note how the appropriate menu item was selected -->
                  <select onchange="document.location=this.value" name="CatId">
                        <option value="index.php?PageID =200" selected="selected">' . $rowProd["category"] . '</option>
                        <option value="Power.php?PageID = 201">' . $rowProd["category"] . '</option>
                        <option value="Shop.php">Shop Tools</option>
                  </select>
             </form>
                                </div>
                                               
                echo'  <div id="YouAreHereLinks">                        
                                               
                                                <a href="../index.php">Home</a> &raquo;
                                                                <a href="index.php">' . $rowDetail["category"] . '</a> &raquo; &nbsp;
                               
         
                                 </div>
                                                ';              ?>         
                </div>  
                <!-- End of "You Are Here" and Search -->
               
                               
                <!-- Main -->
                                <div id="Main">
                <?php
 
  while ($rowProd =  $rsProd->fetch_array(MYSQLI_ASSOC)) {
 
                               
                                                               
                                echo'
                                <div class="MainProduct">
                                                <div class="MainProductImage">
                                                                <!-- Note Product Code in 2 spots... internal label for linking to, and link for large image -->
                                                                <a name="' . $rowProd["productcode"] . '"></a> <a href="javascript:PopUpImage(\'Images/' . $rowProd["productcode"] . '.jpg \', ' . $rowProd["productcode"] . ', ' . $rowProd["productcode"] . ')">
                                                                <!-- Note Product Code in thumbnail-->
                                                                <img src="Images/' . $rowProd["productcode"] .'_sm.jpg" border="0" height="93" width="100" hspace="25" /> </a>
                                                </div>
                                                <div class="MainProductText">
                                                                <!--Note Product Code in link for large image -->
                                                               
                                                               <b><a href="javascript:PopUpImage(\'Images/' . $rowProd["productcode"] . '.jpg\' ,' . $rowProd["productcode"] . ',' . $rowProd["productname"] . ')" >' . $rowProd["productname"] .
                                                '</a></b><br />
                                               
                                                                <font class="small">Product :: &nbsp;' . $rowProd["productcode"] . '</font>
                                                                <br />
                                                                <font class="price"> $' . $rowProd["regprice"] . '</font>
                                                                <br />
                                                                <p>' . $rowProd["productdesc"] . '
 
                </p>
                                                                <br /><br />
                                                                <ul>';
                                                                if ($rowProd["option1"] !=" " ){
                                                                                echo '<li> ' . $rowProd["option1"] . ' </li>';
                                                                }
                                                                if ($rowProd["option2"] !=" " ){
                                                                                echo '<li> ' . $rowProd["option2"] . ' </li>';                                                                          
                                                                }
                if ($rowProd["option3"] !=" " ){
                                                                                echo  '<li> ' . $rowProd["option3"] . ' </li>
                                                                ';}  
               echo'    
                   
                </ul>
                                                                <br />
                                                                ';
                                               
                                                                                                                               
                                echo'
                                                                <!-- Note Product Code in URL parameter for shopping cart -->
                                                                <a href="../Cart/index.php?product=' . $rowProd["productcode"] . '&quantity=1">
                                                                <img alt="Add to Cart" src="../Images/addtocart.gif" border="0" align="right" width="74" height="21" /> </a>
                                                                <br clear="ALL" /><br /><br />
                                                                <p  align="right"><a href="#Top" class="tiny">Back to Top</a></p>
                                                                <br /><br />
                 <hr width="80%" color="#3366cc" />
                 <br /><br /><br /><br />                                                                                                                            
                               
               
                  
                                <!-- End of Display a product -->               
                               
                                   </div>
                               
               
                   </div>
                ';                             
}?>        
 
                               
                                <!-- Footer -->
         <?php include("../Include/Footer.php"); ?>
                               
                                <!-- End of Footer -->    
                               
                                                               
                               
               
                <!-- End of Main -->
                </div>
               
               
                <!-- Left Menu -->
                <!-- create_menu() is the "main engine" of the process to display the JavaScript-powered menu on the left                                                                                                                                 -->
                <!-- The code is found in menu.js located in the Include directory                                                                                                                                                                                                                                                                                             -->
                <!-- The actual menu items themselves are found in the array LeftMenuLinks found in menuitems.js located in the Include directory                                 -->
                <!-- Note how LeftMenuLinks are passed to the function create_menu() as a paramter.                                                                                                                                                                                                                               -->
                <!-- To create an entirely new menu (ie for an entirely different type of type), all you need to do is create another file of "links"     -->
                <!-- and reference that instead.  There are other ways too if you think about it.                                                                                                                                                                                                                 -->
               
                <div id="LeftMenu">    
                                <script language="javascript" type="text/javascript">create_menu('LeftMenu', LeftMenuLinks, LeftMenuProps);</script >         
                </div>
                <!-- End of Left Menu -->
               
               
               
                <!-- Left Ads -->
               
                <?php include ('../Include/LeftAds.php'); ?>
                               
                <!-- End of Left Ads -->
  </body>
                                 
<!-- 2016.09.20 -->          
</html>