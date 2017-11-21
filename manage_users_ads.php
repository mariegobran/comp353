<?php
include("config.php");
include("session.php");
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
         <th>edit</th>
       </tr>
     </thead>
     <tbody>
     <?php 
        $sql = "SELECT * FROM ads ";
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
                 <td><button>Edit</button></td>".
                 "</tr>";
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