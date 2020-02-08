<?php

include '../function/db_function.php';
include '../function/function.php';
include '../include/sweetalert_process.php';
include '../function/sweetalert.php';

extract($_POST);


if (check_session("user_id")) {

    $data = array(
        "booking_sum" => $sum_true,
        "booking_check_in" => $start,
        "booking_check_out" => $end,
        "booking_date" => date("Y-m-d H:i:s"),
        "booking_type" => 0,
        "booking_status" => 1,
        "user_id" => check_session("user_id"),
    );

    insert("tb_booking", $data);

    $max = row_array('SELECT MAX(booking_id) as max FROM tb_booking;');
    $booking_id = $max['max'];

    foreach ($price as $room_id=>$value){
        $data = array(
            "booking_id" => $booking_id,
            "booking_detail_price" => $price[$room_id],
            "booking_detail_adult" => $adult[$room_id],
            "booking_detail_child" => $child[$room_id],
            "booking_detail_total" => $total,
            "booking_detail_status" => 1,
            "room_id" => $room_id
        );

        insert("tb_booking_detail", $data);
    }

//----------โค้ดเวลา
    unset($_SESSION['homestay']);

    $time = timecancel();

    sweetalert_success("จองสำเร็จ!!", "กรุณาชำระเงินภายใน {$time} ชั่วโมง","../index.php?module=homestay&action=payment");
    die();

} else {
    sweetalert_error("เกิดข้อผิดพลาด!!", "กรุณาเข้าสู่ระบบก่อนจองห้องพัก","../index.php?module=user&action=login");
    die();
}

?>