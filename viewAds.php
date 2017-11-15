<?php
   include("session.php");
   include("config.php");

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //something posted

    if (isset($_POST['submit'])) {
  
   $city=mysqli_real_escape_string($conn,$_POST['city']);
   $category=mysqli_real_escape_string($conn,$_POST['category']);
  
   $sql = "SELECT * FROM ads WHERE city = '$city' and category = '$category' ";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
           echo "ID: " . $row["AdID"]. " Description " . $row["description"]. " Price" . $row["price"]. "Address " . $row["address"]. "Phone " . $row["phone"]. "Email " . $row["email"] . "<br>";
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
   <?php include("menu.php"); ?>
      <h1>viewAds <?php echo $login_session; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>

      <form action="" name="display" method="post">
<br>
<h2>Province</h2>
<h2>Quebec</h2>
  <input type="radio" name="city" value="Montreal" > Montreal<br>
<input type="radio" name="city" value="Laval"> Laval<br>
<input type="radio" name="city" value="Chambly"> Chambly
  <h2>Ontario</h2>
  <input type="radio" name="city" value="Toronto" > Toronto<br>
<input type="radio" name="city" value="Hamilton"> Hamilton<br>
<input type="radio" name="city" value="Ottawa"> Ottawa
  <h2>British Columbia</h2>
  <input type="radio" name="city" value="Vancouver" >Vancouver<br>
<input type="radio" name="city" value="Victoria"> Victoria<br>
<input type="radio" name="city" value="Kelowna"> Kelowna
  <h2>Alberta</h2>
  <input type="radio" name="city" value="Edmenton" > Edmenton<br>
<input type="radio" name="city" value="Calgary"> Calgary<br>
<input type="radio" name="city" value="LethBridge"> LethBridge
  <h2>Nova Scotia</h2>
  <input type="radio" name="city" value="Halifax" > Halifax<br>
<input type="radio" name="city" value="Dartmouth"> Dartmouth<br>
<input type="radio" name="city" value="Truro"> Truro
  <h2>Newfoundland and Labrador</h2>
  <input type="radio" name="city" value="St John's" > St John's<br>
<input type="radio" name="city" value="Corner Brook"> Corner Brook<br>
<input type="radio" name="city" value="Labrador"> Labrador
  <h2>Saskatchewan</h2>
  <input type="radio" name="city" value="Regina" > Regina<br>
<input type="radio" name="city" value="Saskatoon"> Saskatoon<br>
<input type="radio" name="city" value="Prince Albert"> Prince Albert
  <h2>Manitoba</h2>
  <input type="radio" name="city" value="Winnipeg" > Winnipeg<br>
<input type="radio" name="city" value="Bradon"> Bradon<br>
<input type="radio" name="city" value="Winkler"> Winkler
  <h2>Prince Edward Island</h2>
  <input type="radio" name="city" value="Charlottetown" > Charlottetown<br>
<input type="radio" name="city" val222ue="Summerside"> Summerside<br>
<input type="radio" name="city" value="Souris"> Souris
  <h2>New Brunswick</h2>
  <input type="radio" name="city" value="Moncton" > Moncton<br>
<input type="radio" name="city" value="Fredericton"> Fredericton<br>
<input type="radio" name="city" value="Bathurst"> Bathurst
  

<h2>Cetegory</h2>

<h2>Buy and Sell</h2>
  <input type="radio" name="category" value="Clothing" > Clothing<br>
<input type="radio" name="category" value="Books"> Books<br>
<input type="radio" name="category" value="Electronics"> Electronics<br>
<input type="radio" name="category" value="Musical Instruments"> Musical Instruments<br>

<h2>Services</h2>
<input type="radio" name="category" value="Tutors" > Tutors<br>
<input type="radio" name="category" value="Event Planners" > Event Planners<br>
<input type="radio" name="Photographers" value="Tutors" > Photographers<br>
<input type="radio" name="category" value="Personal trainers" > Personal trainers<br>

<h2>Rent</h2>
<input type="radio" name="category" value="Electronics" > Electronics<br>
<input type="radio" name="category" value="Car" > Car<br>
<input type="radio" name="category" value="Apartments" > Apartments<br>
<input type="radio" name="category" value="Wedding - Dresses" > Wedding - Dresses<br>

<h2>Jobs</h2>
<input type="radio" name="category" value="Healthcare" > Healthcare<br>
<input type="radio" name="category" value="General Labour" > General Labour<br>
<input type="radio" name="category" value="Customer Service" > Customer Service<br>
<input type="radio" name="category" value="Management" > Management<br>

<input type="submit" name="submit" value="display" />
</form>
   </body>
   
</html>