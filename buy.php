
<?php

include("session.php");
include("config.php");



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
$TID=1;


$sql = "INSERT INTO Transactions (`purchaseType`, `date`, `bill`, `is_item`, `buyerID`, `sellerID`, `card`)
VALUES('$purchaseType', '$date', '$price', '$is_item', '$buyerID', '$sellerID', '$card')";

if(mysqli_query($conn, $sql)){
    echo "Transaction completed";
  } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($sql);
  }


         
?>

      