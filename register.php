<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
      $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);  
      
      //adding Values to database
      $sql = "INSERT INTO users (firstName, lastName, username, password, email,usertype, userID, plan, card) 
      VALUES ('$firstName','$lastName','$username','$password', '$email', 'Regular',567 , 0, 0);";
    
    if(mysqli_query($conn, $sql)){
      echo "Records inserted successfully.";
   } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }
      header ("location: index.php");
 }
?>
<html>
   
   <head>
   <link rel="stylesheet" href="styles.css">
      
    <title>Registration Page</title>
      
   </head>
   <body bgcolor = "#FFFFFF">
    	<?php include("menu.php"); ?>
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
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
