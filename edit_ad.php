<?php
   include("config.php");
   include("session.php");
   $adID ="";
   if($_SERVER["REQUEST_METHOD"] == "POST"  && isset ($_POST['Edit'])){
        $adID = $_POST["Edit"];
    }

   // get all the ad data
   $sql = "SELECT * FROM ads WHERE AdID = '$adID'";
   $result = mysqli_query($conn,$sql);
   $row = $result->fetch_assoc();
 
    // save all ad default values
    $ownerID = $row['ownerID'] ;
    $Title =$row['title'] ;
    $description=$row['description'] ;
    $price=$row['price'] ;
    $address=$row['address'] ;
    $phone=$row['phone'] ;
    $email=$row['email'] ;
    $image=$row['image'] ;
    $city=$row['city'];
    $category=$row['category'];
    $promotion=$row['promotion'];

   //get usetype and userID saved in session and check if the user is not
   // either the admin or the ad owner (then they're not allowed to modify the ad)
   if(!($_SESSION['usetype']=="Admin" || $_SESSION['userID']== $ownerID)){
       header ("location: index.php");
   }


   //submit changes
   if($_SERVER["REQUEST_METHOD"] == "POST"  && isset ($_POST['change'])){
    //get values from the form
    $ownerID = mysqli_real_escape_string($conn,$_POST['plan']);
    $Title = mysqli_real_escape_string($conn,$_POST['plan']);
    $description = mysqli_real_escape_string($conn,$_POST['plan']);
    $price = mysqli_real_escape_string($conn,$_POST['plan']);
    $address = mysqli_real_escape_string($conn,$_POST['plan']);
    $phone = mysqli_real_escape_string($conn,$_POST['plan']);
    $email = mysqli_real_escape_string($conn,$_POST['plan']);
    $image = mysqli_real_escape_string($conn,$_POST['plan']);
    $city = mysqli_real_escape_string($conn,$_POST['plan']);
    $promotion = mysqli_real_escape_string($conn,$_POST['plan']);
    $category = mysqli_real_escape_string($conn,$_POST['plan']);
    
    //modify in database
    $sql = "UPDATE ads
    SET ownerID = ". $ownerID.", 
        title = ". $Title.", 
        description = ". $description.", 
        price = ". $price.", 
        address = ". $address.", 
        phone = ". $phone.", 
        email = ". $email.", 
        image = ". $image.", 
        city = ". $city.", 
        promotion = ". $promotion.", 
        category = ". $category."
    WHERE AdID = ". $adID .";";

    if(mysqli_query($conn,$sql)){
        echo "changes are successfully submitted";
    }
}
   // cancel and go to manage ads (for user) or manage user ads (for Admin)
   if($_SERVER["REQUEST_METHOD"] == "POST"  && isset ($_POST['cancel'])){
    if($_SESSION["usetype"]=="Admin"){
        header ("location: manage_users_ads.php");
    }else {
        header ("location: account.php");
    }
}
?>

<!DOCTYPE html>
<html>
   
   <head>
   <link rel="stylesheet" href="styles.css">
   <?php include("bootstrap.php"); ?>
    <title>Edit Ad</title>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
    	<?php include("menu.php"); ?>
      <div align = "container">
               <form action = "" method = "post" class="form-horizontal">
                  <label>Owner ID  :</label><input type = "text" name = "ownerID" class = "box" value = '<?php echo $ownerID?>'/><br /><br />
                  <label>Title  :</label><input type = "text" name = "title" class = "box" value = '<?php echo $Title?>'/><br/><br />
                  <label>Description  :</label><input type = "text" name = "description" class = "box"value = '<?php echo $description?>' /><br/><br />
                  <label>price  :</label><input type = "number" step=".05" name = "price" class = "box" value = '<?php echo $price?>'/><br /><br />
                  <label>address  :</label><input type = "text" name = "address" class = "box" value = '<?php echo $address?>'/><br /><br />
                  <label>phone  :</label><input type = "number" name = "phone" class = "box" value = '<?php echo $phone?>'/><br /><br />
                  <label>email  :</label><input type = "email" name = "email" class = "box" value = '<?php echo $email?>'/><br /><br />
                  <label>image  :</label><input type = "text" name = "image" class = "box" value = '<?php echo $image?>'/><br /><br />
                  <label>city  :</label><input type = "text" name = "city" class = "box" value = '<?php echo $city?>'/><br /><br />
                  <label>category  :</label><input type = "text" name = "category" class = "box" value = '<?php echo $category?>'/><br /><br />
                  <label>promotion  :</label><input type = "text" name = "promotion" class = "box" value = '<?php echo $promotion?>'/><br /><br />
                  <input class="btn btn-default" type = "submit" name= "change" value = "Submit changes"/>
                  <input class="btn btn-default" type = "reset">
                  <input class="btn btn-default" type ="submit" name= "cancel" value="Cancel"><br />
               </form>
               
				
			
      </div>

   </body>
</html>
