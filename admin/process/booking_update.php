<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_GET);

if (!isset($msg)) {
    $msg = "";
}

if($status == 3 || $status == 1 || $status == 6){
    $data = array(
        "booking_detail_status" => $status
    );

    update("tb_booking_detail", $data, "booking_id = {$id}");
}


$data = array(
    "booking_status" => $status
);

update("tb_booking", $data, "booking_id = {$id}");



sweetalert_success("ทำรายการสำเร็จ!!", "","../{$url}");


?>