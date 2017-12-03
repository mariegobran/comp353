<?php include("session.php"); 
      include("config.php");
?> 
<?php function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
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
                                $Date=date("Y-m-d"); 
                                echo "Date of purchase is " . $Date  . "<br>";
                                echo "Date of expiration will be: ".date('Y/m/d', strtotime($Date. ' + '.$selected_plan.' days'));
                                $userID=$_SESSION['userID'];

                                $sql="UPDATE users
                                SET plan = '$selected_plan'
                                WHERE userID = ' $userID'";
                                $result = $conn->query($sql);
                                echo "<br>Refresh the page to viw the changes";

                                //To Do: Add payment in to transcation
                                
                                $sql = "SELECT Price FROM Plans
                                        WHERE numberOfDays=$selected_plan";
                                
                                
                                $result = $conn->query($sql);
                                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                                $price=$row['Price'];

                                $card= $_SESSION['card'];
                                

                                $sql= "INSERT INTO Transactions (purchaseType, date, bill, is_item, buyerID, sellerID, card)
                                VALUES('plan_purchase', '$Date', '$price', 0, '$userID', 1, '$card')";
                                if($result = $conn->query($sql)){
                                echo "<br>Transaction completed";
                                }
                                
                                
                            }
                        }
                        ?>
            </div>
                        <div class="well well-sm">
                       <h2>My ads</h2>
                       <?php
                            $user=$_SESSION['userID'];
                            $sql = "SELECT * FROM ads WHERE ownerID='$user'AND deleted IS null";
                            $result = $conn->query($sql);

                         if ($result->num_rows > 0) {
                            // output data of each row
                                
                
                                echo "<table class='table table-hover'>";
                                echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>Title</th>";
                                echo "<th>Description</th>";
                                echo "<th>Price</th>";
                                echo "<th>Address</th>";
                                echo "<th>Phone</th>";
                                echo "<th>Email</th>";
                                echo "<th>Rating</th>";
                                echo "<th>Status</th>";
                                echo "</tr>";
                                while($row = $result->fetch_assoc()) {
                                
                                //check if ad is expired
                                $datePosted=$row["datePosted"];
                                $promotion=$row["promotion"];  
                                $ad_expiration =date('Y-m-d', strtotime($datePosted. ' + '.$promotion.' days'));  
                                $Today=date("Y-m-d"); 

                                if(strtotime($Today) > strtotime($ad_expiration)){
                                    $Validity='Expired';
                                }
                                else{
                                    $Validity='Valid';
                                }
                                
                                echo "<tr>";
                                echo "<td>". $row["AdID"]."</td>";
                                echo "<td>". $row["title"]."</td>";
                                echo "<td>". $row["description"]."</td>";
                                echo "<td>". $row["price"]."</td>";
                                echo "<td>". $row["address"]."</td>";
                                echo "<td>". $row["phone"]."</td>";
                                echo "<td>". $row["email"]."</td>";
                                echo "<td>". $row["rating"]."</td>";
                                echo "<td>". $Validity."</td>";
                                echo "<td><form action= 'edit_ad.php' method='POST'><button type='submit' name='Edit' value='" . $row["AdID"]. "' >Edit</button></form></td>";
                                echo "<td><form action= 'delete_ad.php' method='POST'><button type='submit' name='Delete' value='" . $row["AdID"]. "' >Delete</button></form></td>";
                                echo "<td><form action= 'store.php' method='POST'><button type='submit' name='Delete' value='" . $row["AdID"]. "' >Ad to Store</button></form></td>";
                                echo"<td>";
                                
                              
                                echo"</td>";
                                echo "</tr>";
                              }
                              echo "</table>";
                          
                            }
                
                          $conn->close();
                       ?>

                        

                        
                        </div>
                        <div class="well well-sm">
                           <a href= 'newAd.php' type="button" class="btn btn-primary btn-block">POST NEW AD</a> <br /><br /><br />
            			</div>
            </div>		
            </div>
        <!--end container div-->
          </body>
          
        </html>

