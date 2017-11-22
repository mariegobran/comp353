
<?php

include("session.php");
include("config.php");

$sql = "SELECT * FROM ads WHERE city = '$city' and category = '$category' ";
$result = $conn->query($sql);

$adid=mysqli_real_escape_string($conn,$_POST['buy']);
echo $adid;

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

         
?>

      