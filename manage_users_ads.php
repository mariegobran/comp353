<?php
include("session.php");
include("config.php");

if($_SESSION["usetype"]!= "Admin"){    
  #  header("location: account.php");
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

    <title>View Users Payments</title>  
   </head>

   <body bgcolor = "#FFFFFF">
   <?php include("menu.php"); ?>
   <div class="container">
   <h2>All Ads</h2>                            
   <table class="table table-hover">
     <thead>
       <tr>
         <th>#</th>
         <th>user ID</th>
         <th>Date posted</th>
         <th>title</th>
       </tr>
     </thead>
     <tbody>
     <?php 
        $sql = "SELECT * FROM ads where deleted is null";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                //add row data to the table
                echo "<tr>
                 <td>" . $row["AdID"]. "</td>
                 <td>" . $row["ownerID"]. "</td>
                 <td>" . $row["datePosted"]. "</td>
                 <td>" . $row["title"]. "</td>
                 <td><form action= 'edit_ad.php' method='POST'><button type='submit' name='Edit' value='" . $row["AdID"]. "' >Edit</button></form></td>
                 <td><form action= 'delete_ad_admin.php' method='POST'><button type='submit' name='Delete' value='" . $row["AdID"]. "' >Delete</button></form></td>
                 </tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close(); 
     ?>

     
     </tbody>
   </table>
   </div>
   </body>

</html>