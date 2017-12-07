<?php session_start(); ?>

   <?php 
   include("../config.php");
   include("../redirect.php");
   include("../bootstrap.php");

   $sql="SELECT *
   FROM users
   WHERE userID IN
   (
       SELECT ownerID
       FROM ads INNER JOIN Locations ON ads.city = Locations.city
       WHERE (UPPER(title) LIKE UPPER('%winter%men%jacket') OR UPPER(title) LIKE UPPER('%men%winter%jacket'))
           AND province = 'Quebec'
   )";
   $result = mysqli_query($conn,$sql);

   if ($result->num_rows > 0) {
    echo "<table class='table table-hover'>";
    echo "<tr>";
    echo "<td>User ID</td>";
    echo "<td>User nAme</td>";
    echo "<td>Password</td>";
    echo "<td>User Type</td>";
    echo "<td>Email</td>";
    echo "<td>First Name</td>";
    echo "<td>Last Name</td>";
    echo "<td>Plan</td>";
    echo "<td>Card</td>";
    echo "<td>Plan Start</td>";



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