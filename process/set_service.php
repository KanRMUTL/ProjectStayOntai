<?php

include '../function/db_function.php';
include '../function/function.php';
include '../include/sweetalert_process.php';
include '../function/sweetalert.php';


extract($_POST);
$_SESSION['homestay']['service'] = array();

if(isset($service)){
    foreach ($service as $service_id){
        $_SESSION['homestay']['service'][] = $service_id;
    }
}

echo "<meta charset='utf-8'/><script>location.href='../index.php?module=home&action=homestay';</script>";


?>

