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

          $city=mysqli_real_escape_string($conn,$_POST['city']);
          $category=mysqli_real_escape_string($conn,$_POST['category']);

          $sql = "SELECT * FROM ads WHERE city = '$city' and category = '$category' ";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
            // output data of each row
              while($row = $result->fetch_assoc()) {

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
                
                echo"<td><form action='buy.php' method='POST'><button type='submit' name='buy' value='" . $row["AdID"]. "' >BuyItem</button></form></td>";
              }
            }
          } else {
              echo "0 results";
          }
          
          

          $conn->close();

          }
        
        ?>
                    </div>
                    </div>


              
              

          </body>
          
        </html>