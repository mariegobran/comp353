<?php 
function redirect($url)
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
<?php
   include("config.php");
   include("session.php");
  
   // get all the ad data
   if($_SERVER["REQUEST_METHOD"] == "POST"  && isset ($_POST['Delete'])){
   
   $adID = $_POST["Delete"];
   //modify in database
   $sql = "UPDATE ads
   SET deleted='deleted'
   WHERE AdID =  $adID ";
   
   if($result = $conn->query($sql)){
   redirect("manage_users_ads.php");
   }
   }
  ?>