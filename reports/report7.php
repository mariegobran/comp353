<?php session_start(); ?>

   <?php 
   include("../config.php");
   include("../redirect.php");
   include("../bootstrap.php");

   $sql="";
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