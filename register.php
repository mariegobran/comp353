<?php session_start(); ?>
<?php  include("config.php");
       include("redirect.php");
   
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      if($_POST['firstName']!=null && $_POST['lastName']!=null && $_POST['email']!=null
            && $_POST['username']!=null && $_POST['password']!= null){
        $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);  

        //check if username already exists
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);

        if($count==0){
      
          //adding Values to database
          $sql = "INSERT INTO users (firstName, lastName, username, password, email,usertype, plan, card, planStart) 
          VALUES ('$firstName','$lastName','$username','$password', '$email', 'Regular', 0, 0, CURDATE());";
    
          if(mysqli_query($conn, $sql)){
            echo "Records inserted successfully.";

            //get the user entry to extract the user entry and the userID from it
            $sql ="SElECT * FROM users WHERE username = '$username';";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            // If result matched $myusername, table row must be 1 row
      
            if($count=1) {
    
              $_SESSION['login_user'] = $username;
              $_SESSION['usetype'] = $row['usertype'];
              $_SESSION['userID'] = $row['userID'];

              redirect("planPurchase.php");
       
            }else {
            $error = "user is not registerd";
            }

          }else{
            echo "ERROR: Could not execute $sql. " ;
          }  
        }else{
           echo "username already exists";
        }
    
    
      }else echo "Please fill all the fields to successfuly register.";

 }
?>
<!DOCTYPE html>
<html>
   
   <head>
   <link rel="stylesheet" href="styles.css">
      
    <title>Registration Page</title>
      
   </head>
   <body bgcolor = "#FFFFFF">
    	<?php include("menu.php"); ?>
      <div align = "center">
         <div style = "width:400px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Registration</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>First Name  :</label><input type = "text" name = "firstName" class = "box"/><br /><br />
                  <label>Last Name  :</label><input type = "text" name = "lastName" class = "box" /><br/><br />
                  <label>email :</label><input type = "text" name = "email" class = "box"/><br /><br />
                  <label>Username  :</label><input type = "text" name = "username" class = "box" /><br/><br />
                  <label>password  :</label><input type = "password" name = "password" class = "box"/><br /><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>	
            </div>
         </div>	
      </div>
   </body>
</html>
