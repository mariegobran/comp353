<html>
<head>
   
  <?php include("bootstrap.php"); ?>
          </head>
<?php
//the menu if the user is not logged in
    if (!isset($_SESSION['login_user']) || ($_SESSION['login_user'])==null  ){
 echo " <nav class='navbar navbar-inverse'>
          <div class='container-fluid'>
            <div class='navbar-header'>
              <a class='navbar-brand' href='#'>OCN</a>
            </div>
            <ul class='nav navbar-nav'>
              <li class='active'><a href='register.php'>Register</a></li>
              <li class='active'><a href='index.php'>Log In</a></li>
            </ul>
          </div>
        </nav>";



    }else {
        //the menu if the user is logged in
        $username = $_SESSION['login_user']; // username 
        $userType = $_SESSION['usetype']; // user type regular or admin, this should be extracted from the database
       
        echo " <nav class='navbar navbar-inverse'>
        <div class='container-fluid'>
          <div class='navbar-header'>
            <a class='navbar-brand' href='#'>Welcome ". $username ."</a>
          </div>
          <ul class='nav navbar-nav'>
            <li class='active'><a href='viewAds.php' >Browse Ads</a></li>
            <li class='active'><a href='account.php'>My Account</a></li>
            <li class='active'><a href='logout.php'>Logout</a></li>
          </ul>
        </div>
      </nav>";


        if($userType=='Admin'){ 
          // the menu part only for admin users
            echo " <nav class='navbar navbar-inverse'>
            <div class='container-fluid'>
              
              <ul class='nav navbar-nav'>
                <li class='active'><a href='viewPayments.php'>View payments</a></li>
                <li class='active'><a href='manage_users_ads.php'>Manage users ads</a></li>
                <li class='active'><a href='reports.php'>View Reports</a></li>
              </ul>
            </div>
          </nav>";

            }

        }
?>

</html>
