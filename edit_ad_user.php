<?php
   include("session.php");
   include("config.php");
   error_reporting(E_ALL);
   ini_set('display_errors','On');
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
      $Title = mysqli_real_escape_string($conn,$_POST['title']);
      $description = mysqli_real_escape_string($conn,$_POST['description']);
      $price = mysqli_real_escape_string($conn,$_POST['price']);
      $address = mysqli_real_escape_string($conn,$_POST['address']);
      $phone = mysqli_real_escape_string($conn,$_POST['phone']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $image = mysqli_real_escape_string($conn,$_POST['image']);
      $city = mysqli_real_escape_string($conn,$_POST['city']);
      $promotion = mysqli_real_escape_string($conn,$_POST['promotion']);
      $category = mysqli_real_escape_string($conn,$_POST['category']);
      
      //modify in database
      $sql = "UPDATE ads
      SET  
          title = '$Title', 
          description = '$description', 
          price = $price, 
          address = ' $address', 
          phone = $phone, 
          email = '$email', 
          image = '$image', 
          city = '$city', 
          promotion = $promotion, 
          category = ' $category'
      WHERE AdID =  $adID ;";

      try{
          if(mysqli_query($conn,$sql)){
              echo "changes are successfully submitted";
              header("location: manage_users_ads.php");
          }
          
      }catch(Exception $e){
          echo $e;
      }
}//end of if statement for post method "change"
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
      <div class = "container">
        <div class="row">
            <div class="col-sm-2" style="background-color:lavender;"></div>
            <div class="col-sm-8">
               <form action = "" method = "post" class="form-horizontal">
    
                  <label>Title:</label>
                    <input class="form-control" type = "text" name = "title" class = "box" value = '<?php echo $Title?>'/><br/><br />
                  <label>Description:</label>
                    <input class="form-control" type = "text" name = "description" class = "box" value ='<?php echo $description?>' /><br/><br />
                  <label>price:</label>
                    <input class="form-control" type = "number" step=".05" name = "price" class = "box" value ='<?php echo $price?>'/><br /><br />
                  <label>address:</label>
                    <input class="form-control" type = "text" name = "address" class = "box" value ='<?php echo $address?>'/><br /><br />
                  <label>phone:</label>
                    <input class="form-control" type = "number" name = "phone" class = "box" value = '<?php echo $phone?>'/><br /><br />
                  <label>email:</label>
                    <input class="form-control" type = "email" name = "email" class = "box" value ='<?php echo $email?>'/><br /><br />
                  <label>image:</label>
                    <input class="form-control" type = "text" name = "image" class = "box" value ='<?php echo $image?>'/><br /><br />
                  <label>city:</label>
                    <input class="form-control" type = "text" name = "city" class = "box" value = '<?php echo $city?>'/><br /><br />
                  <label>category:</label>
                    <input class="form-control" type = "text" name = "category" class = "box" value = '<?php echo $category?>'/><br /><br />
                  <label>promotion:</label>
                  <select name="cars">
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="fiat">Fiat</option>
    <option value="audi">Audi</option>
  </select>

                  <input class="btn btn-default" type = "submit" name= "change" value = "Submit changes"/>
                  <input class="btn btn-default" type = "reset">
                  <input class="btn btn-default" type ="submit" name= "cancel" value="Cancel"><br />
               </form>
            </div>   
            <div class="col-sm-2" style="background-color:lavender;"></div>   
		</div>		
			
      </div>

   </body>
</html>
