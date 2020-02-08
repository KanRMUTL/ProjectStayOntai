<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

foreach ($_SESSION['homestay']['service'] as $key=>$value){
    if($value == $service_id){
        unset($_SESSION['homestay']['service'][$key]);
        break;
    }
}


echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";


?>

