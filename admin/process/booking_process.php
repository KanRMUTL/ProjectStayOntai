<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);


$data = array(
    "booking_sum" => $sum_true,
    "booking_check_in" => $start,
    "booking_check_out" => $end,
    "booking_date" => date("Y-m-d H:i:s"),
    "booking_type" => 1,
    "booking_status" => 3,
    "user_id" => check_session("id"),
);

insert("tb_booking", $data);

$max = row_array('SELECT MAX(booking_id) as max FROM tb_booking;');
$booking_id = $max['max'];

foreach ($price as $room_id => $value) {
    $data = array(
        "booking_id" => $booking_id,
        "booking_detail_price" => $price[$room_id],
        "booking_detail_adult" => $adult[$room_id],
        "booking_detail_child" => $child[$room_id],
        "booking_detail_total" => $total,
        "booking_detail_status" => 3,
        "room_id" => $room_id
    );

    insert("tb_booking_detail", $data);
}

$data = array(
    "booking_id" => $booking_id,
    "commission_date" => date("Y-m-d H:i:s"),
    "commission_commis" => commission(),
    "user_id" => check_session("id")
);

insert("tb_commission", $data);


unset($_SESSION['homestay']);

sweetalert_success("จองสำเร็จ!!", "","../round_booking.php");
die();


?>