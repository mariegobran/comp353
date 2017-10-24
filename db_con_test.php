<?php
$servername = "pvc353_2.encs.concordia.ca";
$username = "pvc353_2";
$password = "6yer537e";
$dbname = "pvc353_2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
	echo "Great success: <br>";	
}
$sql = "SELECT EID, eName, eFamily FROM Employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["EID"]. " - Name: " . $row["eName"]. " " . $row["eFamily"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
