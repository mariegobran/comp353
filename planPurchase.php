<?php
   include("config.php");
   include("session.php");
   include("redirect.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // getting the plan choice
      $plan = mysqli_real_escape_string($conn,$_POST['plan']);

      //getting the card details
      $cardType = mysqli_real_escape_string($conn,$_POST['cardType']);
      $cardHolder = mysqli_real_escape_string($conn,$_POST['cardHolder']);
      $cardNum = mysqli_real_escape_string($conn,$_POST['cardNum']);
      $cvs = mysqli_real_escape_string($conn,$_POST['cvs']);
      $cardAddress = mysqli_real_escape_string($conn,$_POST['cardAddress']);  
      $expiration = mysqli_real_escape_string($conn,$_POST['expiration']);

      //add -00 for expiration day
      $expiration .= "-00";
     //check if the card already exists in the database
      $sql = "SELECT * FROM Cards WHERE cardNumber = $cardNum;";

      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
    // check if the result matches(exactly) an entry in the cards table, if not add a new card
    //Check if data is entered correctly , Form Validation 

    $numlength = strlen((string)$cardNum);
    if(strlen((string)$cardType)==0 ){echo "Card type cannot be empty";}
   else if(strlen((string)$cardHolder)==0 ){echo "Card holder cannot be empty";}
   else if($cardNum==0 || $numlength!=8 ){echo "Card number must contain 8 digits";}
   else if($cvs==0 ){echo "cvs must contain 3 digits";}
   else if(strlen((string)$cardAddress)==0 ){echo "Card address s be empty";}
   else if($expiration==0 ){echo "Card type cannot be empty";}

else 
    if($count == 1) {
       if(($cardType==$row['type'])&&($cardHolder==$row['cardHolder'])&&($cardNum==$row['cardNumber'])
       &&($cvs==$row['cvs'])&&($cardAddress==$row['address'])&&($expiration==$row['expiration'])){
           echo ('card already exists in our database');
       }else{
        $error = "the card is not valid"; // the card number is in the database but the other attributes does not match
       }
      }else if($count == 0){
          
        // the card is not in the database and should be added
        $sql ="INSERT INTO Cards (type,cardHolder,cardNumber,cvs,address,expiration)
                VALUES ('$cardType','$cardHolder', $cardNum, $cvs, '$cardAddress', DATE '$expiration');";

        if(mysqli_query($conn, $sql)){
            echo "card added successfully";
        } else{
            echo "ERROR: Could not execute $sql. " . mysqli_error($link);
        }
    }else{
        $error = "the card is not valid";
    }
    // get the plan price from the database 
    $sql = "SELECT * FROM Plans WHERE numberOfDays = '$plan'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $planPrice = $row['price'];

    // add a row in the transaction table for the plan purchase
    $sql ="INSERT INTO Transactions (purchaseType, date, bill, is_item, buyerID, card)
    VALUES ('plan purchase', CURDATE(), $planPrice, 0, ".$_SESSION['userID'].", $cardNum);  ";

    //editing user's card and plan
    $userID = $_SESSION['userID'];
    $sql = "UPDATE users
            SET plan = $plan, card = $cardNum
            WHERE userID = $userID;";
    if(mysqli_query($conn,$sql)){
        echo "user's plan and card are updated successfully";
        
        redirect ("location: viewAds.php");
    } else{
        echo "ERROR: Could not execute $sql. " ;
    }
    
}
?>

<html>
   
   <head>
   <link rel="stylesheet" href="styles.css">  
   <?php include("bootstrap.php"); ?>
    <title>Registration Page</title>  
   </head>
   <body bgcolor = "#FFFFFF">
    	<?php include("menu.php"); ?>
      <div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Purchase a plan</b></div>
				
            <div style = "margin:30px">
              <h3> Our current plans are:<br>
               no plan - you won't be able to post your own ads but you can still browse the posted ads<br>
               Normal plan - your ad will be up for 7 days<br>
               Silver plan - your ad will be up for 14 days<br>
               Premium plan - your ad will be up for 30 days<br><br></h3>
               <form action = "" method = "post">
                  <label>Select a plan:</label><select name ='plan'>
                    <option value="0">no plan</option>
                    <option value="7">Normal plan</option>
                    <option value="14">Silver plan</option>
                    <option value="30">Premium plan</option>
                </select><br /><br />
                <br>
                Enter your card information:<br>
                  <label>Card type :</label><input type = "text" name = "cardType" class = "box" /><br/><br />
                  <label>Card holder :</label><input type = "text" name = "cardHolder" class = "box"/><br /><br />
                  <label>Card number  :</label><input type = "text" name = "cardNum" class = "box" /><br/><br />
                  <label>cvv  :</label><input type = "text" name = "cvs" class = "box"/><br /><br />
                  <label>address  :</label><input type = "text" name = "cardAddress" class = "box"/><br /><br />
                  <label>expiration(YYYY-MM)  :</label><input type = "text" name = "expiration" class = "box"/><br /><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>	
            </div>
         </div>	
      </div>
   </body>
</html>