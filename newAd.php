<?php
   include("session.php");
   include("config.php");
   error_reporting(E_ALL);
   ini_set('display_errors','On');
   include("redirect.php");
   
   $AdID ="";
//if the user have a free plan, redirect to plan purchase page
if(isset($_SESSION["userID"])){
  $userID = $_SESSION['userID'];
  $sql= "SELECT * FROM users WHERE userID = $userID";
  $result = mysqli_query($conn,$sql);
  $row = $result->fetch_assoc();
  $plan =$row['plan'];
  if ($plan==0){
    redirect("planPurchase.php");
  }
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
      $rentAStore= mysqli_real_escape_string($conn,$_POST['rent']);
      
      //modify in database8
      $sql = "INSERT INTO  ads (title,description,price,isBuying,address,phone,email,isBusiness,image,datePosted,city,promotion,ownerID,category)
      VALUES ('$Title','$description', $price ,'$isBuying','$address',$phone,'$email', '$isBusiness','$image','$datePosted','$city','$promotion','$ownerID','$category')";

          if(mysqli_query($conn,$sql)){
              echo "<h4>Ad succesfully posted</h4>";
          }
          else{
            echo "<h4>Did not post</h4>";
          }
          //check if a promotion is selected
      if ($promotion > 0){

        $sql4 = "SELECT price FROM Promotion WHERE numOfDays = $promotion";
        $result4 = $conn->query($sql4);
        $row4 = $result4->fetch_assoc();
       
        $price= $row4['price'];
        $date = date('Y-m-d');
        $buyerID = $_SESSION['userID'];
        $card = $_SESSION['card'];

        //register the transaction
        $sql5 = "INSERT INTO Transactions (`purchaseType`, `date`, `bill`, `is_item`, `buyerID`, `sellerID`, `card`)
        VALUES('promotion', '$date', '$price', '0', '$buyerID', '68', '$card')";
        if ($result5 = $conn->query($sql5)){
          echo "<br>Great success, your card has been charged for the promotion";
        }
      }//end of if statement for promotion transactions

        //redirect user to RentAStore page if he chooses yes

        if($rentAStore=='y'){
          //get the posted adID
          $splAdID= "SELECT * FROM ads WHERE ownerID = $ownerID AND datePosted = '$datePosted'";
          $result = $conn->query($splAdID);
          $row = $result->fetch_assoc();

          $_SESSION['AdID']= $row['AdID'];

          redirect("RentAStore.php");

        }//end of rent a store (if statement)
      
      
        }//end of if form is submited

   // cancel and go to manage ads (for user) or manage user ads (for Admin)
if($_SERVER["REQUEST_METHOD"] == "POST"  && isset ($_POST['cancel'])){
  if($_SESSION["usetype"]=="Admin"){
    redirect ("location: manage_users_ads.php");
  }else {
    redirect ("location: account.php");
  }
}
?>

<!DOCTYPE html>
<html>
   
   <head>
   <link rel="stylesheet" href="styles.css">
   <?php include("bootstrap.php"); ?>
    <title>New Ad</title>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
    	<?php include("menu.php"); ?>
      <div class = "container">
        <div class="row">
            <div class="col-sm-2" style="background-color:lavender;"></div>
            <div class="col-sm-8">
            <div class="well well-sm">
            
            <table>
               <form action = "" method = "post" class="form-horizontal">
             <tr>  
                    <td><label>Title:</label></td>
                    <td><input class="form-control" type = "text" name = "title" class = "box" value = '<?php echo $Title?>'/></td>
             </tr>   
             <tr>  
                  <td><label>Description:</label></td>
                    <td><input class="form-control" type = "text" name = "description" class = "box" value ='<?php echo $description?>' /></td>
             </tr> 
             <tr>    
                  <td><label>Price:</label></td>
                    <td><input class="form-control" type = "number" step=".05" name = "price" class = "box" value ='<?php echo $price?>'/></td>
              </tr>     
              <tr>   
                  <td><label>Address:</label></td>
                    <td><input class="form-control" type = "text" name = "address" class = "box" value ='<?php echo $address?>'/></td>
              </tr>  
              <tr>  
                  <td><label>Phone:</label></td>
                   <td> <input class="form-control" type = "number" name = "phone" class = "box" value = '<?php echo $phone?>'/></td>
              </tr>     
              <tr>     
                 <td> <label>Email:</label></td>
                    <td><input class="form-control" type = "email" name = "email" class = "box" value ='<?php echo $email?>'/></td>
              </tr>   
              <tr>    
                  <td><label>Image:</label></td>
                   <td> <input class="form-control" type = "text" name = "image" class = "box" value ='<?php echo $image?>'/></td>
              </tr>   
              <tr>
                 <td> <label>City:</label></td>
                   <td> 
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
                      </select> 
                   </tr>
                   <tr>   

                  <td><label>Category:</label></td>
                  <td>
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
                    </select>
                    </td>
                 </tr> 

                 <tr>
                 <td> <label>Promotion:</label></td>
                    <td>
                    <select name = "promotion" class="form-control">      
                    <option value="0" > No Promotion</option>
                    <option value="7" > 7 Days Promotion</option>
                    <option value="30" > 30 Days Promotion</option>
                    <option value="60" > 60 Days Promotion</option>
                    </select>
                    </td>
                  </tr>

                    <tr>
                   <td> <h5>Buy or Sell</h5></td>
                    <td><label class="radio-inline">
                      <input type="radio" name="isBuying" value ="y" >Buy
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="isBuying" value="n" checked="checked">Sell
                    </label> 
                    </td>
                    </tr>

                    <tr>
                    
                    <td><h5>Type of seller:</h5></td>
                    <td>
                    <label class="radio-inline">
                      <input type="radio"  name="isBusiness" value ="n" checked="checked" >Personal
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="isBusiness" value="y">Businesss
                    </label> 
                    </td>
                    </tr>


                    <tr>
                    
                    <td><h5>Do you want to rent a store?</h5></td>
                    <td>
                    <label class="radio-inline">
                      <input type="radio"  name="rent" value ="n" checked="checked" >no
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="rent" value="y">yes
                    </label> 
                    </td>
                    </tr>

                    <tr>

                    <tr>
                    <td>
                    <input class="btn btn-default" type = "submit" name= "change" value = "Submit Ad"/>
                  <input class="btn btn-default" type = "Reset">
                  <a href= 'account.php' type="button" class="btn btn-default">Cancel</a> 
                    </td>
                    </tr>
               </form>
               </table>
               </div>
            </div>   
            <div class="col-sm-2" style="background-color:lavender;"></div>   
		</div>		
			
      </div>

   </body>
</html>
