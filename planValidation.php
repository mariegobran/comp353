<?php


$sql= "SELECT * FROM users ";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    $planStart=$row["planStart"];
    $plan=$row["plan"]; 
    $plan_expiration =date('Y-m-d', strtotime($planStart. ' + '.$plan.' days'));  
    $Today=date("Y-m-d"); 
    $id=$row['userID'];
    if(strtotime($Today) > strtotime($plan_expiration)){
        $sql1="UPDATE users
        SET plan = 0 WHERE userID=$id "; 
        if($result1 = $conn->query($sql1)){
        //echo "success";
        //echo $row["AdID"];
    }
    }
}

?>