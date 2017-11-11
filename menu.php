<?php
//the menu if the user is not logged in
    if (!isset($_SESSION['login_user'])){
        echo " <ul class='menu'><li><a href='register.php'>Register NOW!</a></li>
          <li><a href='index.php'> Login </a></li></ul>";
    }else {
        //the menu if the user is logged in
        $username = $_SESSION['login_user']; // username 
        $userType = $_SESSION['user_type']; // user type regular or admin, this should be extracted from the database
        echo "<ul class='menu'>
        <li>Welcome ". $username ." </li>
        <li><a href='browse.php' >Browse Ads</a></li>
        <li><a href='myaccount.php'>My Account</a></li>";

        if($userType=='admin'){ // the menu part only for admin users
            echo "<li>Admin Area<ul>
            <li><a href='allPayments.php'>All payments</a></li>
            <li><a href='allUsersAds.php'>Manage users ads</a></li>
            <li><a href='backupPayments.php'>backup payments</a></li></ul><li>";
            }
        echo "</ul>";
        }
?>