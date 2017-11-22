        <?php
          include("session.php");
          include("config.php");
          ?>


        <html>
          
          <head>
          <title>viewAds </title>
            <link rel="stylesheet" href="styles.css">
              <?php include("bootstrap.php"); ?>
          </head>
          <body bgcolor = "#FFFFFF">

          
              <?php include("menu.php"); ?>
                    <form action="" name="display" method="post">
                    <br>
                    <div class="row">
                    <div class="col-sm-4">
                    <h2>Choose City and Category:</h2>
                  
                    <h2>Quebec</h2>
                    <input type="radio" name="city" value="Montreal" > Montreal<br>
                    <input type="radio" name="city" value="Laval"> Laval<br>
                    <input type="radio" name="city" value="Chambly"> Chambly

                      <h2>Ontario</h2>
                      <input type="radio" name="city" value="Toronto" > Toronto<br>
                    <input type="radio" name="city" value="Hamilton"> Hamilton<br>
                    <input type="radio" name="city" value="Ottawa"> Ottawa
                      <h2>British Columbia</h2>
                      <input type="radio" name="city" value="Vancouver" >Vancouver<br>
                    <input type="radio" name="city" value="Victoria"> Victoria<br>
                    <input type="radio" name="city" value="Kelowna"> Kelowna
                      <h2>Alberta</h2>
                      <input type="radio" name="city" value="Edmenton" > Edmenton<br>
                    <input type="radio" name="city" value="Calgary"> Calgary<br>
                    <input type="radio" name="city" value="LethBridge"> LethBridge
                      <h2>Nova Scotia</h2>
                      <input type="radio" name="city" value="Halifax" > Halifax<br>
                    <input type="radio" name="city" value="Dartmouth"> Dartmouth<br>
                    <input type="radio" name="city" value="Truro"> Truro
                      <h2>Newfoundland and Labrador</h2>
                      <input type="radio" name="city" value="St John's" > St John's<br>
                    <input type="radio" name="city" value="Corner Brook"> Corner Brook<br>
                    <input type="radio" name="city" value="Labrador"> Labrador
                      <h2>Saskatchewan</h2>
                      <input type="radio" name="city" value="Regina" > Regina<br>
                    <input type="radio" name="city" value="Saskatoon"> Saskatoon<br>
                    <input type="radio" name="city" value="Prince Albert"> Prince Albert
                      <h2>Manitoba</h2>
                      <input type="radio" name="city" value="Winnipeg" > Winnipeg<br>
                    <input type="radio" name="city" value="Bradon"> Bradon<br>
                    <input type="radio" name="city" value="Winkler"> Winkler
                      <h2>Prince Edward Island</h2>
                      <input type="radio" name="city" value="Charlottetown" > Charlottetown<br>
                    <input type="radio" name="city" val222ue="Summerside"> Summerside<br>
                    <input type="radio" name="city" value="Souris"> Souris
                      <h2>New Brunswick</h2>
                      <input type="radio" name="city" value="Moncton" > Moncton<br>
                    <input type="radio" name="city" value="Fredericton"> Fredericton<br>
                    <input type="radio" name="city" value="Bathurst"> Bathurst
                    </div>
                    
                    <div class="col-sm-4">
                    <h2>Cetegory</h2>
                    
                    <h2>Buy and Sell</h2>
                      <input type="radio" name="category" value="Clothing" > Clothing<br>
                    <input type="radio" name="category" value="Books"> Books<br>
                    <input type="radio" name="category" value="Electronics"> Electronics<br>
                    <input type="radio" name="category" value="Musical Instruments"> Musical Instruments<br>
                    
                    <h2>Services</h2>
                    <input type="radio" name="category" value="Tutors" > Tutors<br>
                    <input type="radio" name="category" value="Event Planners" > Event Planners<br>
                    <input type="radio" name="Photographers" value="Tutors" > Photographers<br>
                    <input type="radio" name="category" value="Personal trainers" > Personal trainers<br>
                    
                    <h2>Rent</h2>
                    <input type="radio" name="category" value="Electronics" > Electronics<br>
                    <input type="radio" name="category" value="Car" > Car<br>
                    <input type="radio" name="category" value="Apartments" > Apartments<br>
                    <input type="radio" name="category" value="Wedding - Dresses" > Wedding - Dresses<br>
                    
                    <h2>Jobs</h2>
                    <input type="radio" name="category" value="Healthcare" > Healthcare<br>
                    <input type="radio" name="category" value="General Labour" > General Labour<br>
                    <input type="radio" name="category" value="Customer Service" > Customer Service<br>
                    <input type="radio" name="category" value="Management" > Management<br>
                    
                    <input type="submit" name="submit"   class="btn btn-info btn-block" value="View ads" />

                    
                    </div>
                    </form>
                    <div class="col-sm-4">
                    <?php

                    //something posted
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
          
          $index=0;
          $rowData = array(); // this array will keep rowData

          $city=mysqli_real_escape_string($conn,$_POST['city']);
          $category=mysqli_real_escape_string($conn,$_POST['category']);

          $sql = "SELECT * FROM ads WHERE city = '$city' and category = '$category' ";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
            // output data of each row
              while($row = $result->fetch_assoc()) {
                $yourArray[$index] = $row;
                $index++;

                echo "<table class='table'>";
                echo "<tr>";
                echo "<td>ID:</td>";
                echo "<td>". $row["AdID"]."</td>";
                echo "</tr>";
                echo "<td>Description</td>";
                echo "<td>". $row["description"]."</td>";
                echo "</tr>";
                echo "<td>Price</td>";
                echo "<td>". $row["price"]."</td>";
                echo "</tr>";
                echo "<td>Address</td>";
                echo "<td>". $row["address"]."</td>";
                echo "</tr>";
                echo "<td>Phone</td>";
                echo "<td>". $row["phone"]."</td>";
                echo "</tr>";
                echo "<td>Email</td>";
                echo "<td>".  $row["email"]."</td>";
                echo "</tr>";
                echo "</table>";

                //pop up window whn a transaction is sucesfull
                echo " <button  type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>Buy</button>";
                echo "<!-- Modal -->
                <div class='modal fade' id='myModal' role='dialog'>
                  <div class='modal-dialog'>
                  
                    <!-- Modal content-->
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h4 class='modal-title'>Transaction confirmation</h4>
                      </div>
                      <div class='modal-body'>
                        <p>";
                        if($conn === false){
                          die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        else{
                      $buyerID=$_SESSION['userID'];
                      $card=$_SESSION['card'];
                      $sellerID=$row['ownerID'];
                      
                      //to be fixed, do not know what it is
                      $item_service=1;

                      $price=$row["price"];
                      
                      //to be fixed, it's either a plan, promotion or online purchase
                      $purchaseType='na';
                      
                      $date = date('Y-m-d');
                      $bill= 'NA';

                      $description=$row["description"];
                      $AdID= $row["AdID"];
                      $TID=1;
                      $sql = "INSERT INTO Transactions (`purchaseType`, `date`, `bill`, `item_service`, `buyerID`, `sellerID`, `card`)
                      VALUES('$purchaseType', '$date', '$price', '$item_service', '$buyerID', '$sellerID', '$card');";
                        
                       if(mysqli_query($conn, $sql)){
                          echo "Transaction completed";
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($sql);
                        }
                      
                    }
                        echo" </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                      </div>
                    </div>
                    
                  </div>
                </div>";
              }
            }
          } else {
              echo "0 results";
          }
          
          //function to add transaction
          function buyItem($param = NULL) {

            $buyerID=$_SESSION['userID'];
            $card=$_SESSION['card'];
            $sellerID=$row['ownerID'];
            $item_service=1;
            $purchaseType='na';


            $date = date('Y-m-d');
            $bill= 'NA';

            $description=$row["description"];
            $AdID= $row["AdID"];
            $TID=1;
            $sql = "INSERT INTO Transactions (`purchaseType`, `date`, `bill`, `item_service`, `buyerID`, `sellerID`, `card`)
            VALUES('$purchaseType', '$date', '$price', '$item_service', '$buyerID', '$sellerID', '$card');";

         }

          $conn->close();

          }
        
        ?>
                    </div>
                    </div>


              
              

          </body>
          
        </html>