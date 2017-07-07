<?php
 /**
 *  Project: Project: Reddit API small project
 *  Last Modified Date: 2017 July
 *  Developer: Cooltey Feng
 *  File: index.php
 *  Description: Index Page
 */

 include_once("./config/database.php");
 include_once("./class/lib.php");
 include_once("./class/core.php");


 // this page
 $pageName = "index";
 
 // call lib class
 $getLib = new Lib();
 
 // call Main Object
 $getMain = new Core($db, $getLib, $pageName);

 // setup data
 $_GET['p'] = "index";

 ?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?php echo $getMain->setTitle($_GET);?> :: Reddit API small project - by Cooltey Feng</title>
    <?php
      // include header
      include("./parts/header.php");
    ?>
    
  </head>

  <body>
    <?php
      // include navbar
      include("./parts/navbar.php");
    ?>
    <div class="space-20"></div>
    
      <!-- Start Index Main Page -->
      <?php
          // set view
          $getMain->setView($_GET, $_POST, $_SESSION);
      ?>         
      <!-- End Index Main Page -->

      <hr>
    
      <?php
        // footer
        include("./parts/footer.php");        
      ?>

      <?php
        // website js
        include("./parts/website_js.php");        
      ?>

  </body>
</html>
