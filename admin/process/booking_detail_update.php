<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_GET);

if ($status == 6) {
    $sql = "SELECT * FROM tb_booking_detail WHERE booking_detail_id = {$id}";
    $row = row_array($sql);

    $num = ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'];

    $sql = "UPDATE tb_booking SET booking_sum = booking_sum - {$num} WHERE booking_id = '{$row['booking_id']}'";
    query($sql);
}elseif ($status == 5){
    $data = array(
        "check_out_date" => date("Y-m-d H:i:s"),
        "booking_detail_id" => $id
    );

    insert("tb_check_out",$data);
}

$data = array(
    "booking_detail_status" => $status
);

update("tb_booking_detail", $data, "booking_detail_id = {$id}");

sweetalert_success("ทำรายการสำเร็จ!!", "","../{$url}");


?>