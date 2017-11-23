<?php include("session.php"); ?> 
          
        <html>
          
          <head>
          <title>viewAds </title>
          
            <!-- <link rel="stylesheet" href="styles.css"> -->
              <?php include("bootstrap.php"); ?>
          </head>


          <body bgcolor = "#FFFFFF">

          <!-- start cntainer div -->
          <div class="container">

          <!-- main content goes here -->
          <div class="row">
         
              <?php include("menu.php"); ?>

              <div class="well well-sm">
                    <form action="" name="display" method="post">
                    <br>
                    
                    <h2>Choose City and Category:</h2>

                    <select name = "city" class="custom-select">
                    <optgroup label="Quebec">
                    <option value="Montreal" > Montreal</option>
                    <option value="Laval"> Laval</option>
                    <option value="Chambly"> Chambly</option>
                    </optgroup>

                      <optgroup label="Ontario">
                      <option value="Toronto" > Toronto</option>
                    <option value="Hamilton"> Hamilton</option>
                    <option value="Ottawa"> Ottawa</option>
                      </optgroup>

                    <optgroup label="British Columbia">
                      <option value="Vancouver" >Vancouver</option>
                    <option value="Victoria"> Victoria</option>
                    <option value="Kelowna"> Kelowna</option>
                    </optgroup>

                    <optgroup label="Alberta">
                      <option value="Edmenton" > Edmenton</option>
                    <option value="Calgary"> Calgary</optiobr>
                    <option value="LethBridge"> LethBridge</option>
                      </optgroup>
                      </select>
                    
                    
                    
                    <select name = "category" class="custom-select">
                    
                    <optgroup label="Buy and Sell">
                      <option value="Clothing" > Clothing</option>
                    <option value="Books"> Books</option>
                    <option value="Electronics"> Electronics</option>
                    <option value="Musical Instruments"> Musical Instruments</option>
                    </optgroup>

                    <optgroup label="Services">
                    <option value="Tutors" > Tutors</option>
                    <option value="Event Planners" > Event Planners</option>
                    <oprion value="Tutors" > Photographers</option>
                    <option value="Personal trainers" > Personal trainers</option>
                    </optgroup>

                    <optgroup label="Rent">
                    <option value="Electronics" > Electronics</option>
                    <option value="Car" > Car</option>
                    <option value="Apartments" > Apartments</option>
                    <option value="Wedding - Dresses" > Wedding - Dresses</option>
                    </optgroup>

                    <optgroup label="Jobs">
                    <option value="Healthcare" > Healthcare</option>
                    <option value="General Labour" > General Labour</option>
                    <option value="Customer Service" > Customer Service</option>
                    <option value="Management" > Management</option>
                    </optgroup>
                    
                    </select>
                    </div>
                    <div class="well well-sm">
                    <input type="submit" name="submit"   class="btn btn-info btn-block" value="View ads" />
                    </div>
                    
                    
                    </form>
                    
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
              

                echo "<table class='table table-hover'>";
                echo "<tr>";
                echo "<td>Description</td>";
                echo "<td>ID:</td>";
                echo "<td>Price</td>";
                echo "<td>Address</td>";
                echo "<td>Phone</td>";
                echo "<td>Email</td>";
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["AdID"]."</td>";
                echo "<td>". $row["description"]."</td>";
                echo "<td>". $row["price"]."</td>";
                echo "<td>". $row["address"]."</td>";
                echo "<td>". $row["phone"]."</td>";
                echo "<td>".  $row["email"]."</td>";
                echo"<td>
                
                ".
                //The form above redirects to buy.php page and save the AdID so it can be bought.
                "

                <form action='buy.php' method='POST'>
                <button  type='submit' name='buy' value='" . $row["AdID"]. "' >Buy</button>
                </form>
                </td>";
                echo "</tr>";
              }
              echo "</table>";
            }
          } else {
              echo "0 results";
          }
          
          

          $conn->close();

          }
        
        ?>
                    </div>
                    </div>


              <!-- main content ends here -->
          <div class="row">

              <!--end container div-->
                    </div>
          </body>
          
        </html>
