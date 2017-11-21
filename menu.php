<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function dropDown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<?php
//the menu if the user is not logged in
    if (!isset($_SESSION['login_user'])){
        echo " <ul class='menu'><li><a href='register.php'>Register NOW!</a></li>
          <li><a href='index.php'> Login </a></li></ul>";
    }else {
        //the menu if the user is logged in
        $username = $_SESSION['login_user']; // username 
        $userType = $_SESSION['usetype']; // user type regular or admin, this should be extracted from the database
        echo "<ul class='menu'>
        <li>Welcome ". $username ." </li>
        <li><a href='viewAds.php' >Browse Ads</a></li>
        <li><a href='account.php'>My Account</a></li>
        <li><a href='logout.php'>Logout</a></li>";

        if($userType=='Admin'){ // the menu part only for admin users
            echo "<div class='dropdown'>
            <li><button onclick='dropDown()' class='dropbtn'>Admin Area</button>
            <div id='myDropdown' class='dropdown-content'>
            <a href='viewPayments.php'>All payments</a>
            <a href='manage_users_ads.php'>Manage users ads</a>
            <a href='backup_payments.php'>backup payments</a></div></div><li>";
            }
        echo "</ul>";
        }
?>
