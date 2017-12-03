<?php
include("config.php");

$sql= "SELECT * FROM ads ";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    $datePosted=$row["datePosted"];
    $promotion=$row["promotion"]; 
    $ad_expiration =date('Y-m-d', strtotime($datePosted. ' + '.$promotion.' days'));  
    $Today=date("Y-m-d"); 
    $id=$row['AdID'];
    if(strtotime($Today) > strtotime($ad_expiration)){
        $sql1="UPDATE ads
        SET promotion = 0 WHERE AdID=$id "; 
        if($result1 = $conn->query($sql1)){
        echo "success";
        echo $row["AdID"];
    }
    }
}

?>