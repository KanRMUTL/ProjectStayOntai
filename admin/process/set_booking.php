<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';


extract($_GET);

if (count($_SESSION['homestay']['booking']) >= $_SESSION['homestay']['room']) {
    sweetalert_error("ไม่สามารถจองได้!!", "คุณได้จองห้องครบตามจำนวนที่ต้องการแล้ว","../confirm_booking.php");
    die();
}

$_SESSION['homestay']['booking'][] = $room_id;

echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";


?>

