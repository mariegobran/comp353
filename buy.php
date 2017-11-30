<!DOCTYPE html>
<html>
  <head>
    <?php include("bootstrap.php"); ?>
      
    <title>Registration Page</title>
      
  </head>

  <body bgcolor = "#FFFFFF">

    <!-- start cntainer div -->
    <div class="container">
      <!-- main content goes here -->
      <div class="row">
            <?php
                include("session.php");
                include("config.php");
                include("menu.php");


                $adid=mysqli_real_escape_string($conn,$_POST['buy']);


                $sql = "SELECT * FROM ads WHERE AdID = '$adid'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();


                $buyerID=$_SESSION['userID'];
                $card=$_SESSION['card'];
                $sellerID=$row['ownerID'];
                $is_item=1;
                $purchaseType='na';
                $price=$row['price'];

                $date = date('Y-m-d');
                $bill= 'NA';

                $description=$row["description"];
                $AdID= $row["AdID"];
                //$TID= 1;

                //register the transaction
                $sql = "INSERT INTO Transactions (`purchaseType`, `date`, `bill`, `is_item`, `buyerID`, `sellerID`, `card`)
                VALUES('$purchaseType', '$date', '$price', '$is_item', '$buyerID', '$sellerID', '$card')";



                if(mysqli_query($conn, $sql)){
                    echo "Transaction Completed!<br>";
                  } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($sql);
                  }

                  
                  $sql1= "SELECT MAX(TID) FROM Transactions";
                  $result1 = $conn->query($sql1);
                  $row1 = $result1->fetch_assoc();
                  $TID= $row1['MAX(TID)'];
                  

                //register sold item into soldItems table; 
                  $sql2 = "INSERT INTO soldItems (`description`, `AdID`, `TID`)
                            VALUES ('$description', '$AdID', '$TID')";


                if(mysqli_query($conn, $sql2)){
                  echo "Item stored into sold items!<br>";
                } else{
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($sql2);
                }

            ?>
              <a href='viewAds.php'>Keep Shopping</a>
      </div>   
    </div>     

  </body>

</html>


   