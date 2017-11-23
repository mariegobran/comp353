<?php session_start(); ?>

<?php function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
   ?> 

   <?php include("config.php");
   
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     
    // username and password sent from form 

      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);  
      
      $sql = "SELECT userID, usertype, card FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1
      
    if($count == 1) {
       // session_register("username");
       $_SESSION['login_user'] = $myusername;
       $_SESSION['usetype'] = $row['usertype'];
       $_SESSION['userID'] = $row['userID'];
       $_SESSION['card'] = $row['card'];
       
       if ($_SESSION['usetype']=="Admin" || $_SESSION['usetype']=="Regular"){
        redirect("viewAds.php");
       }
       else redirect("assumptions.txt");
       
    }else {
       $error = "Your Login Name or Password is invalid";
    }
 }
?>
<html>
   
   <head>
   <link rel="stylesheet" href="styles.css">
      
    <title>Login Page</title>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
    	<?php include("menu.php"); ?>
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
