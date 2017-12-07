<?php session_start(); ?>

   <?php 
   include("../config.php");
   include("../redirect.php");
   include("../bootstrap.php");

   $sql="SELECT date, count(*) AS num_payments, sum(bill) AS total_revenue 
   FROM Transactions
   WHERE DATEDIFF(CURDATE(), Transactions.date) <= 15 AND sellerID = GIVEN_ID AND purchaseType = 'Rent'
   GROUP BY date";
   $result = mysqli_query($conn,$sql);

   if ($result->num_rows > 0) {
    echo "<table class='table table-hover'>";
    echo "<tr>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";
    echo "<td>value</td>";


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