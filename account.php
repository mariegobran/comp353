<?php
include("session.php");
include("config.php");
if($_SESSION["usetype"]!= "Admin"){
   # header("location: account.php");
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
   <div class="well well-sm">
   <h2>My Ads</h2>   
   </div>                         
   <table class="table table-hover">
     <thead>
       <tr>
         <th>Title</th>
         <th>Price</th>
         <th>Category</th>
         <th>Date Posted</th>
         <th></th>
       </tr>
     </thead>
     <tbody>
     <?php 
        $myUserid= $_SESSION['userID'];
        $sql = "SELECT * FROM ads WHERE ownerID= '$myUserid' ";
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
                 <td><form action= 'edit_ad_user.php' method='POST'><button type='submit' name='Edit' value='" . $row["AdID"]. "' >Edit</button></form></td>".
                 "</tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close(); 
     ?>

     
     </tbody>
   </table>
   <a href= 'newAd.php' type="button" class="btn btn-primary btn-block">POST AD</a> <br /><br /><br />


   <!-- Plan Part starts here            -->
   <div class="well well-sm">
   <h2>My Plan</h2>   
   <?php
        $myusername=$_SESSION['login_user'];
        $sql = "SELECT plan FROM users WHERE username = '$myusername'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
        echo "<h5> You ,". $myusername.", are currently on a ". $row['plan']. "days plan </h5>" 
    ?>
    <a href= 'Plan.php' type="button" class="btn btn-primary btn-block">Change Plan</a> <br /><br /><br />
   </div> 
   </div>
   </body>

</html>