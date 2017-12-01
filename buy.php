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

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              if (isset($_POST['buy'])) {
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
                $_SESSION['add_to_rate']=$AdID;
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
              }
            }
            ?>
              <a href='viewAds.php'>Keep Shopping</a>

              <divclass="well well-sm">
              <h2>Please rate the item that you just bought:</h2>
              <form action="" name="display" method="POST">
                    <br>

                    <select name = "rating" class="custom-select">
                    <option value="1" > 1</option>
                    <option value="2"> 2</option>
                    <option value="3"> 3</option>
                    <option value="4"> 4</option>
                    <option value="5"> 5</option>
                    </select>
                    </br></br>
                    <input type="submit" name="rate"   class="btn btn-info" value="Rate" />
              </form> 
              <?php
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['rate'])) {
                  $rating = mysqli_real_escape_string($conn,$_POST['rating']);


                  //get the transaction id for the last sold item
                  $sql1= "SELECT MAX(TID) FROM Transactions";
                  $result1 = $conn->query($sql1);
                  $row1 = $result1->fetch_assoc();
                  $TID= $row1['MAX(TID)'];
                  
                  
                  
                  //register rating in sold items as individual
                  $sql="UPDATE soldItems
                  SET rating = $rating
                  WHERE TID = '$TID'";
                  if($result = $conn->query($sql)){
                    echo "Rating was succesful";
                  }

                  //register rating in ads table
                  $adId=$_SESSION['add_to_rate'];

                  $sql="SELECT COUNT(*) as items, SUM(rating) as sum from soldItems
                   where AdID='$adId' and rating is not NULL";
                  
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  $items=$row['items'];
                  $sum=$row['sum'];
                  $total_rating=$sum/$items;


                  //register rating in sold items as individual
                  $sql="UPDATE ads
                  SET rating = $total_rating
                  WHERE AdID = '$adId'";
                  if($result = $conn->query($sql)){
                    echo "Rating was succesful";
                    echo "</br> This Item now is rated".$total_rating;
                  }

                }
              }
              
              ?>     
              </div>
      </div>   
    </div>     

  </body>

</html>


   