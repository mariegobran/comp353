<?php
   include("session.php");
   include("config.php");

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //something posted

    if (isset($_POST['submit'])) {
  
   $province=$_POST["province"];
   $city=$_POST["city"];
   $category=$_POST["category"];

   $sql = "SELECT * FROM ads 
   WHERE province = '$province', city = '$city', category ='$category' ";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
           echo "Type: " . $row["type"]. " Card Holder: " . $row["cardHolder"]. " CVS" . $row["cvs"]. "Address " . $row["address"]. "Expiration " . $row["expiration"]. "Card Number " . $row["cardNumber"] . "<br>";
       }
   } else {
       echo "0 results";
   }
   $conn->close();

  }
}
   ?>


<html>
   
   <head>
      <title>viewAds </title>
   </head>
   
   <body>
      <h1>viewAds <?php echo $login_session; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>

      <form action="" name="display" method="post">
<br>
<h2>Province</h2>
<select name="province" form="select_form">
  <option value="Quebec">Quebec</option>
  <option value="Ontario">Ontario</option>
  <option value="British Columbia">British Columbia</option>
  <option value="Alberta">Alberta</option>
  <option value="Nova Scotia">Nova Scotia</option>
  <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
  <option value="Saskatchewan">Saskatchewan</option>
  <option value="Manitoba">Manitoba</option>
  <option value="Prince Edward Island">Prince Edward Island</option>
  <option value="New Brunswick">New Brunswick</option>
  
</select>

<select name="city" form="select_form">
  <option value="#">#</option>
  <option value="#">#</option>
  <option value="#">#</option>
  <option value="#">#</option>
</select>

<select name="category" form="select_form">
  <option value="#">#</option>
  <option value="#">#</option>
  <option value="#">#</option>
  <option value="#">#</option>
</select>

<input type="submit" name="submit" value="display" />
</form>
   </body>
   
</html>