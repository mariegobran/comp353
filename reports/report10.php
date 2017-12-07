<?php session_start(); ?>

   <?php 
   include("../config.php");
   include("../redirect.php");
   include("../bootstrap.php");


   echo "store manager report: <br>
   'The report finds how many people rented the store manager's store last month and how much they earned from that'<br>";

   $sql1="SELECT sellerID, count(bill) as earned , count(TID) as transactions FROM Transactions 
   WHERE purchaseType = 'StoreRent' 
   AND date>= (NOW() - INTERVAL 1 MONTH)
   AND AdID IN (SELECT AdID FROM storeAds WHERE SLnum IN 
                           (SELECT SLnum FROM physicalStore WHERE storeManager = 15))
   GROUP BY sellerID;";
   $result = mysqli_query($conn,$sql1);

   if ($result->num_rows > 0) {
    echo "<table class='table table-hover'>";
    echo "<tr>";
    echo "<td>seller #</td>";
    echo "<td>Earned</td>";
    echo "<td>Transactions</td>";

    echo "</tr>";


    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach($row as $field) {
            echo '<td>' . htmlspecialchars($field) . '</td>';
        }
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo "0 results";
}


echo"<br>";
echo "Admin report:<br>
        'The report shows how many users with premium plan and 30 day promotion who have sold items in the last month'<br>";
$sql2="SELECT * From
(SELECT * FROM users 
WHERE plan = 30
AND userID IN (SELECT sellerID FROM Transactions 
            WHERE date>=(NOW() - INTERVAL 1 MONTH))) premiumUsers
JOIN
(SELECT ownerID, count(AdID) as AdsPosted FROM ads WHERE promotion=30 GROUP BY ownerID) thirtyDaysAds
ON premiumUsers.userID= thirtyDaysAds.ownerID;

GROUP BY users.userID;";
$result = mysqli_query($conn,$sql2);

if ($result->num_rows > 0) {
 echo "<table class='table table-hover'>";
 echo "<tr>";
 echo "<td>user #</td>";
 echo "<td>username</td>";
 echo "<td>password</td>";
 echo "<td>userType</td>";
 echo "<td>email</td>";
 echo "<td>firstName</td>";
 echo "<td>lastName</td>";
 echo "<td>plan</td>";
 echo "<td>card</td>";
 echo "<td>plan start</td>";
 echo "<td>ownerID</td>";
 echo "<td>Ads posted</td>";
 echo "</tr>";


 // output data of each row
 while($row = $result->fetch_assoc()) {
     echo "<tr>";
     foreach($row as $field) {
         echo '<td>' . htmlspecialchars($field) . '</td>';
     }
     echo "</tr>";
 }
 echo "</table>";

} else {
 echo "0 results";
}


echo"<br>";
echo "buyer report:<br>
'The report finds all the ads posted by the user where the user is a buyer'<br>";

$sql3="SELECT AdID, title, category FROM ads WHERE userID =89 AND isBuying='y'";
$result = mysqli_query($conn,$sql3);

if ($result->num_rows > 0) {
 echo "<table class='table table-hover'>";
 echo "<tr>";
 echo "<td>Ad #</td>";
 echo "<td>Title</td>";
 echo "<td>category</td>";
 echo "</tr>";


 // output data of each row
 while($row = $result->fetch_assoc()) {
     echo "<tr>";
     foreach($row as $field) {
         echo '<td>' . htmlspecialchars($field) . '</td>';
     }
     echo "</tr>";
 }
 echo "</table>";

} else {
 echo "0 results";
}


echo"<br>";

echo "seller report:<br>
'The report show the seller how much they spent to sell their items'<br>";

$sql4="SELECT buys.sellerID, spent, earned FROM(
    (SELECT buyerID AS sellerID, count(bill) AS spent FROM Transactions
    WHERE buyerID =67 AND purchaseType= 'storeRent' AND purchaseType= 'promotion'
    GROUP BY buyerID) buys
    JOIN
    (SELECT sellerID , count(bill) AS earned FROM Transactions  
    WHERE sellerID = 67 AND purchaseType='onlinePurchase') sells
    ON buys.sellerID = sells.sellerID) ;";
$result = mysqli_query($conn,$sql4);

if ($result->num_rows > 0) {
 echo "<table class='table table-hover'>";
 echo "<tr>";
 echo "<td>Seller #</td>";
 echo "<td>Spent</td>";
 echo "<td>Earned</td>";

 echo "</tr>";

 // output data of each row
 while($row = $result->fetch_assoc()) {
     echo "<tr>";
     foreach($row as $field) {
         echo '<td>' . htmlspecialchars($field) . '</td>';
     }
     echo "</tr>";
 }
 echo "</table>";

} else {
 echo "0 results";
}
$conn->close();


   ?>