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
   <h2>My Ads</h2>                            
   <table class="table table-striped">
     <thead>
       <tr>
         <th>Title</th>
         <th>Price</th>
         <th>Category</th>
         <th>Date Posted</th>
         <th>           </th>
       </tr>
     </thead>
     <tbody>
     <?php 
        $sql = "SELECT * FROM ads  ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                //add row data to the table
                echo "<tr>
                 <td>" . $row["title"]. "</td>
                 <td>" . $row["price"]. "</td>
                 <td>" . $row["category"]. "</td>
                 <td>" . $row["datePosted"]. "</td>
                 <td><form action= 'edit_ad.php' method='POST'><button type='submit' name='Edit' value='" . $row["AdID"]. "' >Edit</button></form></td>".
                 "</tr>";
            }
        } else {
            echo "You have no ads";
        }
        $conn->close(); 
     ?>

     
     </tbody>
   </table>
   </div>
   </body>

</html>