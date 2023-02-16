<!DOCTYPE html>
<html lang="en">
<head>
<!-- Browser Color - Chrome, Firefox OS, Opera -->
<meta name="theme-color" content="#ff00ff"> 
<!-- Browser Color - Windows Phone -->
<meta name="msapplication-navbutton-color" content="#ff00ff"> 
<!-- Browser Color - iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#F11503">


<!-- <meta name=”theme-color” content=”#ffffff” /> -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>..::MARKET::..</title>

   
   
   <?php include "./views/sections/script.php"; ?>
   
 
   
   


</head>
<body>
  
  <?php  include "./views/sections/menu.php";   ?>


<section class="content">
    
            <?php
                    $obj = new RutasController();
                    $obj->enlacesController();
            ?>
</section>





<?php  include "./views/sections/pie.php"; ?>


<?php include "./views/sections/script_ajax.php";?>






</body>
</html>