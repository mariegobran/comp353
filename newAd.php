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
$sql = "SELECT * FROM ads ";
$result = mysqli_query($conn,$sql);
$row = $result->fetch_assoc();

 // save all ad default values
 
 $Title ='' ;
 $description='' ;
 $price='' ;
 $isBuying='';
 $address='';
 $phone='';
 $email='' ;
 $isBusiness ='' ;
 $image='' ;
 $datePosted= date('Y-m-d');
 $city='';
 $ownerID = $_SESSION['userID'];
 $promotion='';
 $category='';

       

   //submit changes
   if($_SERVER["REQUEST_METHOD"] == "POST"  && isset ($_POST['change'])){
      //get values from the form

      $Title = mysqli_real_escape_string($conn,$_POST['title']);
      $description = mysqli_real_escape_string($conn,$_POST['description']);
      $price = mysqli_real_escape_string($conn,$_POST['price']);
      $isBuying= mysqli_real_escape_string($conn,$_POST['isBuying']);
      $address = mysqli_real_escape_string($conn,$_POST['address']);
      $phone = mysqli_real_escape_string($conn,$_POST['phone']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $isBusiness = mysqli_real_escape_string($conn,$_POST['isBusiness']);
      $image = mysqli_real_escape_string($conn,$_POST['image']);
      $city = mysqli_real_escape_string($conn,$_POST['city']);
      $promotion = mysqli_real_escape_string($conn,$_POST['promotion']);
      $ownerID = $_SESSION['userID'];
      $category = mysqli_real_escape_string($conn,$_POST['category']);
      
      
      //modify in database8
      $sql = "INSERT INTO  ads (title,description,price,isBuying,address,phone,email,isBusiness,image,datePosted,city,promotion,ownerID,category)
      VALUES ('$Title','$description','$price','$isBuying','$address','$phone','$email', '$isBusiness','$image','$datePosted','$city','$promotion','$ownerID','$category')";
      echo $sql;
          if(mysqli_query($conn,$sql)){
              echo "Add succesfully posted";
          }
          else{
            echo "Did not post";
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
      <div class = "container">
        <div class="row">
            <div class="col-sm-2" style="background-color:lavender;"></div>
            <div class="col-sm-8">
               <form action = "" method = "post" class="form-horizontal">
                  <label>Title:</label>
                    <input class="form-control" type = "text" name = "title" class = "box" value = '<?php echo $Title?>'/><br/><br />
                  <label>Description:</label>
                    <input class="form-control" type = "text" name = "description" class = "box" value ='<?php echo $description?>' /><br/><br />
                  <label>Price:</label>
                    <input class="form-control" type = "number" step=".05" name = "price" class = "box" value ='<?php echo $price?>'/><br /><br />
                  <label>Address:</label>
                    <input class="form-control" type = "text" name = "address" class = "box" value ='<?php echo $address?>'/><br /><br />
                  <label>Phone:</label>
                    <input class="form-control" type = "number" name = "phone" class = "box" value = '<?php echo $phone?>'/><br /><br />
                  <label>Email:</label>
                    <input class="form-control" type = "email" name = "email" class = "box" value ='<?php echo $email?>'/><br /><br />
                  <label>Image:</label>
                    <input class="form-control" type = "text" name = "image" class = "box" value ='<?php echo $image?>'/><br /><br />
                

                  <label>City:</label>
                    <select name = "city" class="form-control">
                    <optgroup label="Quebec">
                    <option value="Montreal" >Montreal</option>
                    <option value="Laval"> Laval</option>
                    <option value="Chambly"> Chambly</option>
                    </optgroup>

                      <optgroup label="Ontario">
                      <option value="Toronto" > Toronto</option>
                    <option value="Hamilton"> Hamilton</option>
                    <option value="Ottawa"> Ottawa</option>
                      </optgroup>

                    <optgroup label="British Columbia">
                      <option value="Vancouver" >Vancouver</option>
                    <option value="Victoria"> Victoria</option>
                    <option value="Kelowna"> Kelowna</option>
                    </optgroup>

                    <optgroup label="Alberta">
                      <option value="Edmenton" > Edmenton</option>
                    <option value="Calgary"> Calgary</optiobr>
                    <option value="LethBridge"> LethBridge</option>
                      </optgroup>
                      </select> <br /><br /><br />
                  <label>Category:</label>
                  <select name = "category" class="form-control">
                    
                    <optgroup label="Buy and Sell">
                      <option value="Clothing" > Clothing</option>
                    <option value="Books"> Books</option>
                    <option value="Electronics"> Electronics</option>
                    <option value="Musical Instruments"> Musical Instruments</option>
                    </optgroup>

                    <optgroup label="Services">
                    <option value="Tutors" > Tutors</option>
                    <option value="Event Planners" > Event Planners</option>
                    <oprion value="Tutors" > Photographers</option>
                    <option value="Personal trainers" > Personal trainers</option>
                    </optgroup>

                    <optgroup label="Rent">
                    <option value="Electronics" > Electronics</option>
                    <option value="Car" > Car</option>
                    <option value="Apartments" > Apartments</option>
                    <option value="Wedding - Dresses" > Wedding - Dresses</option>
                    </optgroup>

                    <optgroup label="Jobs">
                    <option value="Healthcare" > Healthcare</option>
                    <option value="General Labour" > General Labour</option>
                    <option value="Customer Service" > Customer Service</option>
                    <option value="Management" > Management</option>
                    </optgroup>
                    </select><br /><br /><br />
                  <label>Promotion:</label>
                       <select name = "promotion" class="form-control">      
                    <option value="0" > No Promotion</option>
                    <option value="7" > 7 Days Promotion</option>
                    <option value="30" > 30 Days Promotion</option>
                    <option value="60" > 60 Days Promotion</option>
                    </select><br /><br /><br />


                    <label>Buy or Sell</label>
                    <label class="radio-inline">
                      <input type="radio" name="isBuying" value ="y" >Buy
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="isBuying" value="n">Sell
                    </label> <br /><br /><br />


                    <label>Type of seller:</label>
                    <label class="radio-inline">
                      <input type="radio"  name="isBusiness" value ="n" >Personal
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="isBusiness" value="y">Businesss
                    </label> <br /><br /><br />


                  <label>Place Ad in physical store ?</label>
                    <label class="radio-inline">
                      <input type="radio" name="optradio">Yes
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="optradio">No
                    </label> <br /><br /><br />
                  
             


                 <div align ="center">
                  <input class="btn btn-default" type = "submit" name= "change" value = "Submit Ad"/>
                  <input class="btn btn-default" type = "Reset">
                  <a href= 'account.php' type="button" class="btn btn-default">Cancel</a> 
                </div>
               </form>
            </div>   
            <div class="col-sm-2" style="background-color:lavender;"></div>   
		</div>		
			
      </div>

   </body>
</html>
