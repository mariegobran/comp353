<?php
include("session.php");
include("config.php");

if($_SESSION["usetype"]!= "Admin"){
    header("location: account.php");
}


?>



<html>
 
<head>
   <link rel="stylesheet" href="styles.css">  
   <?php include("bootstrap.php"); ?>
   <script>
    $(document).ready(function(){
    $("[data-toggle='popover']").popover({
        html: true, 
	    content: function() {
          return $('#popover-content').html();
            }
        }); 
    });
   </script>

    <title>myAccount</title>  
   </head>
   

   <body bgcolor = "#FFFFFF">
   <?php include("menu.php"); ?>
   <div class="container">






   </div>
   </body>


   </hmtl>