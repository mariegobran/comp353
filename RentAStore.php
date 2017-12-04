<?php
    include("session.php");
    include("config.php");
    error_reporting(E_ALL);
    ini_set('display_errors','On');
    include("redirect.php");
    //get userID
    if(isset($_SESSION['userID'])){
        $userID= $_SESSION['userID'];
    }else redirect("index.php");

    //get AdID
    if(isset($_POST['rentStore'])){
        $AdID = $_POST['rentStore'];
        $_SESSION['AdID'] = $AdID;
    }elseif (isset($_SESSION['AdID'])){
        $AdID = $_SESSION['AdID'];
    }
    /**
     *
     * Get times as option-list.
     *
     * @return string List of times
     */
    function get_times( $default = '19:00', $interval = '+60 minutes' ) {
        
            $output = '';
        
            $current = strtotime( '08:00' );
            $end = strtotime( '20:00' );
        
            while( $current <= $end ) {
                $time = date( 'H:i', $current );
                $sel = ( $time == $default ) ? ' selected' : '';
        
                $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
                $current = strtotime( $interval, $current );
            }
        
            return $output;
        }


    
?>
<!DOCTYPE html>
<html>
   
   <head>
   <link rel="stylesheet" href="styles.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<script>
$(function() {
  $('#datetimepicker').datetimepicker({
                 format: 'YYYY-MM-DD'
           });
});

</script>
   
    <title>Rent a store</title>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
      <div class = "container">
        <div class="row">
            <div class="col-sm-2" style="background-color:lavender;"></div>
            <div class="col-sm-8">
            <div class="well well-sm">
            <form action = "" method = "post" class="form-horizontal">
                <label>Pick a store:</label>
                <select name = "SLnum" class="custom-select">
                    <option value="0" selected="">Pick a store</option>
                    <option value="1">Store 1</option>
                    <option value="2">Store 2</option>
                    <option value="3">Store 3</option>
                    <option value="4">Store 4</option>
                </select><br><br>

                <div class="form-group">
                
              </div>
        
    

                <!--day selection-->
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker'>
                    <label class="control-label" for="date">Pick a day:</label>
                    <input name="day" type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div> 
                </div>
                <br><br>
                <!--hour selection-->
                <label>Pick a start time</label>
                <select name = "hour" class="custom-select">
                    <?php echo get_times(); ?>
                </select> 
                <br><br>
                <!--number of hours to book (maximum 12)-->
                <label>choose the number of hours to book</label>
                <select name = "numOfHours" class="custom-select">
                    <option value="1" selected="">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select> 
                <br><br>
                <!--delivery option -->
                <label>Do you want to allow delivery?</label>
                <label class="radio-inline">
                      <input type="radio"  name="delivery" value ="n" checked="checked">no
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="delivery" value="y">yes
                    </label><br>
                <!--method of payment-->
                    <label>Do you want to use your credit card?</label>
                <label class="radio-inline">
                      <input type="radio"  name="payment" value ="n" checked="checked">no
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="payment" value="y">yes
                    </label>

                    <div class="well well-sm">
                    <input type="submit" name="submit"   class="btn btn-info btn-block" value="proceed to rent a store" />
                    </div>
            </form>
               
            </div>
            </div>   
            <div class="col-sm-2" style="background-color:lavender;"></div>   
		</div>		
            <?php
             if (($_SERVER['REQUEST_METHOD'] === 'POST')&& (isset($_POST['day']))){
                if(isset($_POST['SLnum'],$_POST['day'],$_POST['hour'])){
                            $SLnum =mysqli_real_escape_string($conn,$_POST['SLnum']);
                            $day = mysqli_real_escape_string($conn,$_POST['day']);
                            $hour = (mysqli_real_escape_string($conn,$_POST['hour'])).":00";
                            $delivery = mysqli_real_escape_string($conn,$_POST['delivery']);
                            $numOfHours = mysqli_real_escape_string($conn,$_POST['numOfHours']);
                            $payment = mysqli_real_escape_string($conn,$_POST['payment']);
                            if($SLnum==0){
                                echo "Please choose a store.";
                            }else{
                                // get all the bookings in the selected date and check if the selected hour is already booked 
                                $sql = "SELECT * FROM STOREBOOKINGS WHERE SLnum= $SLnum AND date = '$day'";
                                $result = $conn->query($sql);
                                $count = mysqli_num_rows($result);
                                $isBooked = false;

                                if($count!=0){ //there exists some bookings in the selected day
                                    echo "Here is a list of all booked hours on $day in the store #$SLnum: <br> ";
                                    $bookedHours = "";
                                    while($row = $result->fetch_assoc()){//check if this hour is already booked
                                        $bookedHours .= $row['time'];
                                        
                                        if($row['time']===$hour){
                                            $bookedHours .= " &emsp;<span style='color: red;'> this hour is already booked</span>";
                                            $isBooked = true;
                                        }
                                        $bookedHours .= "<br>";
                                    
                                    };

                                }

                                if($isBooked == false){ // no bookings on this datetime
                                    //finish the booking (add to storebookings table)
                                    $counter =$numOfHours;
                                    $hourBooking = $hour;
                                    while($counter!=0){ // make a booking for each hour
                                        $sql = "INSERT INTO storebookings (userID,AdID,date,time,SLnum) 
                                        VALUES ($userID,$AdID,'$day','$hourBooking',$SLnum);";
                                  
                                        if(mysqli_query($conn, $sql)){
                                            echo "hour booked: $hourBooking<br>";
                                            $counter--;
                                            
                                            $hourBooking=strtotime( "+60 minutes", strtotime($hourBooking) );
                                            $hourBooking=date( 'H:i', $hourBooking );
                                            $hourBooking.=":00";
                                            
                                        }
                                        

                                    }
                                    //add ad to store ads
                                    $sql = "INSERT INTO storeads (deliveryAvailable, AdID, SLnum) 
                                    VALUES ('$delivery',$AdID,$SLnum);";
                              
                                    if(mysqli_query($conn, $sql)){
                                        echo "You now have a store ad.<br>";
                                    }

                                    echo "you have successfuly booked store $SLnum in $day at $hour <br>";
                                    $isWeekend = false;
                                    $extraCharge =1;
                                    //if the day of booking is a weekend, get extra charge
                                    $weekday = date('w',strtotime($day));
                                    if($weekday == 0 || $weekday ==6){
                                        $sql = "SELECT * FROM physicalstore WHERE SLnum = $SLnum";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        $extraCharge = $row['extraCharge'];
                                        $isWeekend = true;
                                    }

                                    //
                                    // rent calculations 
                                    //
                                    $hourCharge = 10;
                                    $deliveryCharge = 5;
                                    $creditPercentage = 1.03;
                                    
                                    //get user's card if (card will be used)
                                    if($payment==="y"){
                                        $sql="SELECT * FROM USERS WHERE USERID = $userID";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        $card = $row['card'];
                                    }else{
                                        $creditPercentage = 1; // if the user is paying in the store
                                        $card = 0;
                                    }

                                    if($isWeekend){ // change fees if it's a weekday
                                        $hourCharge =15;
                                        $deliveryCharge = 10;

                                    }
                                    if($delivery==='n'){ //if the delivery is not selected 
                                        $deliveryCharge =0;
                                    }
                            

                                    // calculate rent 
                                    $rentTotal = ( (($hourCharge*$numOfHours)*$extraCharge) 
                                                + ($deliveryCharge*$numOfHours) ) * $creditPercentage;
                                   
                                    
                    
                                    // add to transactions table
                                    $sql = "INSERT INTO transactions (purchaseType,date,bill,is_item,buyerID,card) 
                                    VALUES ('StoreRent',CURDATE(),$rentTotal,1, $userID, $card);";
                              
                                    if(mysqli_query($conn, $sql)){
                                        echo "Transaction completed<br>";
                                    }

                                }else{//print the availabilty of this day
                                    echo $bookedHours;
                                }

                                }
                                

                            }
                            
                }else{
                    echo "Check all the fields to successfuly rent a store!";
                    $sql = "SELECT * FROM STOREBOOKINGS";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    echo $row['time'];
                }            
             
            
            ?>
      </div>

   </body>
</html>
