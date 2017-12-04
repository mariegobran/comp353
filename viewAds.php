<?php include("session.php"); 

?> 
          
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
                    
                    <h2>Filter your choice by selecting one the desired options below:</h2>
                    <h4>City</h4>
                    <select name = "city" class="custom-select">
                    <optgroup label="Quebec">
                    <option></option>
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
                    
                    
                    <h4>Category</h4>
                    <select name = "category" class="custom-select">
                    
                    <optgroup label="Buy and Sell">
                    <option></option>
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

                    <!-- The code below gets all the users from the database that have posted an add and creates a list of them -->
                    <?php
                    $sql="SELECT username FROM users WHERE userID IN ( SELECT DISTINCT(ownerID)  FROM ads)";
                    $result = $conn->query($sql);

                    echo'<h4>Seller</h4>';
                    echo '<select name = "seller" class="custom-select">';
                    echo '<option></option>';
                    while($row = $result->fetch_assoc()){
                    $username= $row["username"];
                    echo'<option value="'.$username.'" > '.$username.'</option>';
                    }
                    echo'</select>';

                    ?>
                    </div>
                    <div class="well well-sm">
                    <input type="submit" name="submit"   class="btn btn-info btn-block" value="View ads" />
                    </div>
                    
                    
                    </form>
                    
<?php

 //get all the ids form the store ad table and put them in $row1


//something posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['submit'])) {
    $city=mysqli_real_escape_string($conn,$_POST['city']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);
          
    $seller=mysqli_real_escape_string($conn,$_POST['seller']);
          
      //will not work if 2 users have the same username;
      $sql= "SELECT userID FROM users WHERE username = '$seller'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $seller_id=$row["userID"];
      //echo $seller_id;


      //the code above filters choices by maniupulating the sql string;
       $whereClauses = array();
      if (! empty($_POST['city'])) $whereClauses[] = 'city='."'".$city."'";
      if (! empty($_POST['category'])) $whereClauses[] ='category='."'".$category."'";
      if (! empty($_POST['seller'])) $whereClauses[] = 'ownerID='."'".$seller_id."'";
                
                $where = '';
                if (count($whereClauses) > 0) {
                    $where = 'WHERE '.implode(' AND ',$whereClauses);
                }
                
                if ($where != ''){
                $sql = "SELECT * FROM ads ".$where."AND deleted is null ORDER BY promotion DESC";
                }
                else
                {
                  $sql = "SELECT * FROM ads WHERE deleted is null ORDER BY promotion DESC";
                }
                $result = $conn->query($sql);
                
          
                  // output data of each row
                 if ($result->num_rows > 0) {
                echo "<table class='table table-hover'>";
                echo "<tr>";
                echo "<td>My Add</td>";
                echo "<td>ID</td>";
                echo "<td>Title</td>";
                echo "<td>Description</td>";
                echo "<td>Price</td>";
                echo "<td>Address</td>";
                echo "<td>Phone</td>";
                echo "<td>Email</td>";
                echo "<td>Rating</td>";
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                
                echo "<tr>";

                if($row["ownerID"]==$_SESSION['userID']){
                  echo "<td>-></td>";
                }else
                  echo "<td></td>";
                echo "<td>". $row["AdID"]."</td>";
                echo "<td>". $row["title"]."</td>";
                echo "<td>". $row["description"]."</td>";
                echo "<td>". $row["price"]."</td>";
                echo "<td>". $row["address"]."</td>";
                echo "<td>". $row["phone"]."</td>";
                echo "<td>".  $row["email"]."</td>";
                echo "<td>".  $row["rating"]."</td>";
                echo"<td>";
                
                
                //The form above redirects to buy.php page and save the AdID so it can be bought.
                $sql1= "SELECT AdID FROM storeAds";
                $result1 = $conn->query($sql1);
                while( $row1 = $result1->fetch_assoc()){
                if( $row["AdID"] == $row1["AdID"]){
                echo "  
                <form action='buy.php' method='POST'>
                <button  type='submit' name='buy' value='" . $row["AdID"]. "' >Buy</button>
                </form>";
                }
              }
                echo"</td>";
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
