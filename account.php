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

          
                
                    
        <!-- main content ends here -->
        <div class="row">

          <?php include("menu.php"); ?>

          <div class="well well-sm">
                <?php
                    $myusername=$_SESSION['login_user'];
                    $sql = "SELECT plan FROM users WHERE username = '$myusername'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

                    echo "<table class='table table-hover'>";
                    echo "<tr>";
                    echo "<th>Your User Name</th>";
                    echo "<th>Plan</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>". $_SESSION['login_user']."</td>";
                    echo "<td>". $row['plan']. " Days </td>";
                    echo "</tr>";  
                    echo"</table>";    
                ?>
         </div>
        
            <!--get plan values:--> 
            <div class="well well-sm">
             <?php
             $sql = "SELECT * FROM Plans";
             $result = $conn->query($sql);
                ?>

                <!--Form to change the plan:-->       
                <form action="" name="display" method="post">
                    <?php
                    echo" <h2>Choose another plan to replace the current one:</h2>";
                    echo "<table class='table table-hover'>";
                    echo "<tr>";
                    echo "<th>Select</th>";
                    echo "<th>Name</th>";
                    echo "<th>Number of days</th>";
                    echo "<th>Price in CAD</th>";
                    echo "</tr>";
                        while($row = $result->fetch_assoc()){
                    echo "<tr>";
                 echo '<td>';  echo'<label><input type="radio" name="plan" value="' . $row['numberOfDays']. '" ></label>'; echo '</td>';
                echo' </div>';
                echo "<td>". $row['name']."</td>";
                echo "<td>".$row['numberOfDays']."</td>";
                echo "<td>".$row['Price']."</td>";
                echo "</tr>";
                    }
                    echo"</table>";
                    
                    echo "<td>";
                    echo '<input type="submit" name="submit" value="Change Plan" />';
                    echo"</td>";
                        ?>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['submit'])) {
                                echo "Selected plan is: ";
                                $selected_plan = mysqli_real_escape_string($conn,$_POST['plan']);
                                echo $selected_plan." Days";
                                echo "<br>";
                                $Date=date("Y/m/d"); 
                                echo "Date of purchase is " . $Date  . "<br>";
                                echo "Date of expiration will be: ".date('Y/m/d', strtotime($Date. ' + '.$selected_plan.' days'));
                                $userID=$_SESSION['userID'];

                                $sql="UPDATE users
                                SET plan = '$selected_plan'
                                WHERE userID = ' $userID'";
                                $result = $conn->query($sql);
                                echo "<br>Refresh the page to viw the changes";
                                
                                //To Do: Add payment in to transcation
                                //$sql = "INSERT INTO Transactions (`purchaseType`, `date`, `bill`, `is_item`, `buyerID`, `sellerID`, `card`)
                                //VALUES('$purchaseType', '$date', '$price', '$is_item', '$buyerID', '$sellerID', '$card')";
                            }
                        }
                        ?>
            </div>
           
            </div>
            </div>
        <!--end container div-->
          </body>
          
        </html>
