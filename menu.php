<?php
    if (!isset($_SESSION['login_user'])){
        echo " <ul class='menu'><li><a href='register.php'>Register NOW!</a></li>
          <li><a href='index.php'> Login </a></li></ul>";
    }else {
        $username = $_SESSION['login_user'];
        $userType = $_SESSION['user_type'];
        echo "<ul class='menu'>
        <li>Welcome ". $username ." </li>
        <li><a href='browse.php' >Browse Ads</a></li>
        <li><a href='myaccount.php'>My Account</a></li>";

        if($userType=='admin'){
            echo "<li>Admin Area<ul>
            <li><a href='allPayments.php'>All payments</a></li>
            <li><a href='allUsersAds.php'>Manage users ads</a></li>
            <li><a href='backupPayments.php'>backup payments</a></li></ul><li>";
            }
        echo "</ul>";
        }
?>