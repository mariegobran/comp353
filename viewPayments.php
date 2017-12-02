<?php
include("config.php");
include("session.php");

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

    <title>View Users Payments</title>  
   </head>

   <body bgcolor = "#FFFFFF">
   <?php include("menu.php"); ?>
   <div class="container">
   <h2>Users payments</h2>                            
   <table id="payments" class="table table-hover">
     <thead>
       <tr>
         <th>#</th>
         <th>Purchase Type</th>
         <th>user ID</th>
         <th>Date of payment</th>
         <th>used Card</th>
         <th>Amount</th>
       </tr>
     </thead>
     <tbody>
     <?php 
        $sql = "SELECT * FROM transactions ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // get card details
                $cardDetails = "SELECT * FROM cards WHERE cardNumber = ". $row['card'];
                $cardResult = $conn->query($cardDetails);
                $card = $cardResult->fetch_assoc();
                //add row data to the table
                echo "<tr>".
                 "<td>" . $row["TID"]. "</td>".
                 "<td>" . $row["purchaseType"]. "</td>".
                 "<td>" . $row["buyerID"]. "</td>".
                 "<td>" . $row["date"]. "</td>".
                 //adding card details popover button
                 "<td>
                 <button href='#' class='btn' data-toggle='popover' title='Card Details' 
                 data-html='true' data-container='body'
                 >".$row["card"]."</button>
                 </td>
                 <div id='popover-content' class='hide'>
                 <b>Type:</b>".$card["type"]
                 ."<br><b>Number:</b>".$card["cardNumber"]
                 ."<br><b>Card Holder:</b>".$card["cardHolder"]
                 ."<br><b>CVV:</b>".$card["cvs"]
                 ."<br><b>Address:</b>".$card["address"]
                 ."<br><b>Expiration:</b>".$card["expiration"]."
                 </div>
                 ".
                 "<td>" . $row["bill"]. "</td>".
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
   <script src="js/FileSaver.min.js" type="text/javascript"></script>
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="js/tableexport.min.js" type="text/javascript"></script>
<script>
    $('#payments').tableExport();
</script>
   </body>

</html>