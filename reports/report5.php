<?php session_start(); ?>

   <?php 
   include("../config.php");
   include("../redirect.php");
   include("../bootstrap.php");

   $sql="SELECT AVERAGES.category, ownerID AS userID, avg_rating
   FROM
   (
       SELECT category, ownerID, AVG(rating) AS avg_rating
       FROM (ads INNER JOIN soldItems ON ads.AdID = soldItems.AdID) NATURAL JOIN Transactions
       WHERE city = 'GIVEN_CITY' AND isBuying = 'n'
       GROUP BY category, ownerID
   ) AVERAGES
   JOIN
   (
       SELECT category, MAX(avg_rating) AS max_avg
       FROM
       (
           SELECT category, ownerID, AVG(rating) AS avg_rating
           FROM (ads INNER JOIN soldItems ON ads.AdID = soldItems.AdID) NATURAL JOIN Transactions
           WHERE city = 'GIVEN_CITY' AND isBuying = 'n'
           GROUP BY category, ownerID
       ) AVERAGES2
       GROUP BY category
   ) MAXIMUMS
   ON AVERAGES.category = MAXIMUMS.category
   WHERE avg_rating = max_avg";
  
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