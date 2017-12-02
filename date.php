<?php
    $days=10;
    $date = "2015-11-17";
    $date1 = date('Y-m-d', strtotime($date. ' + '.$days.' days'));
    echo $date1;
?>