<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

foreach ($_SESSION['homestay']['booking'] as $key=>$value){
    if($value == $room_id){
        unset($_SESSION['homestay']['booking'][$key]);
        break;
    }
}


echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";


?>

