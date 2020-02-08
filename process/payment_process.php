<?php

include '../function/db_function.php';
include '../function/function.php';
include '../include/sweetalert_process.php';
include '../function/sweetalert.php';


extract($_POST);

$time = $hh.":".$mm.":00";

$file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
$img_name = date('YmdHis') . "_payment" . $file_ext;

if (move_uploaded_file($_FILES["img"]["tmp_name"], "../uploads/" . $img_name)) {

    delete("tb_payment", "booking_id = '{$booking_id}'");

    $data = array(
        "payment_date" => $date . " " . $time,
        "payment_money" => $money,
        "payment_bank" => $bank,
        "payment_picture" => $img_name,
        "booking_id" => $booking_id
    );
    insert("tb_payment", $data);

    $arr = array(
        "booking_status" => 2
    );

    update("tb_booking", $arr, "booking_id = '{$booking_id}'");

    $arr = array(
        "booking_detail_status" => 2
    );

    update("tb_booking_detail", $arr, "booking_id = '{$booking_id}'");

    sweetalert_success("แจ้งชำระเงินแล้ว!!", "รอผู้ดูแลระบบตรวจสอบ", "../index.php?module=homestay&action=payment&booking_id={$booking_id}");
} else {
    echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปไม่ถูกต้อง!!');window.history.back();</script>";
    sweetalert_error_b("ไฟล์รูปไม่ถูกต้อง!!", "");
}

?>

