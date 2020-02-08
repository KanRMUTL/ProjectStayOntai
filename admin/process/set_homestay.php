<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';


extract($_POST);

if ($room > ($adult + $child)) {
    sweetalert_error("เกิดข้อผิดพลาด!!", "จำนวนห้องห้ามมากว่าจำนวนผู้เข้าพัก","../round_booking.php");
    die();
}

$_SESSION['homestay']['start'] = $date;
$_SESSION['homestay']['room'] = $room;
$_SESSION['homestay']['total'] = $total;
$_SESSION['homestay']['adult'] = $adult;
$_SESSION['homestay']['child'] = $child;
$_SESSION['homestay']['type'] = $type;
$_SESSION['homestay']['beds'] = ceil(($adult + $child) / $room);
$_SESSION['homestay']['booking'] = array();

echo "<meta charset='utf-8'/><script>location.href='../round_booking.php';</script>";


?>

