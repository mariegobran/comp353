<?php session_start(); ?>

   <?php 
   include("../config.php");
   include("../redirect.php");
   include("../bootstrap.php");

   $sql="SELECT *
   FROM ads
   WHERE category IN
   (
       SELECT category
       FROM AdCategories
       WHERE Parent = 'Rent'
   );";
   $result = mysqli_query($conn,$sql);

   if ($result->num_rows > 0) {
    echo "<table class='table table-hover'>";
    echo "<tr>";
    echo "<td>AdID</td>";
    echo "<td>title</td>";
    echo "<td>description</td>";
    echo "<td>price</td>";
    echo "<td>isBuying</td>";
    echo "<td>address</td>";
    echo "<td>Phone</td>";
    echo "<td>email</td>";
    echo "<td>isBusiness</td>";
    echo "<td>image</td>";
    echo "<td>datePosted</td>";
    echo "<td>city</td>";
    echo "<td>promotion</td>";
    echo "<td>ownerID</td>";
    echo "<td>category</td>";
    echo "<td>deleted</td>";
    echo "<td>rating</td>";


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