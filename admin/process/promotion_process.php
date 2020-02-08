<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

if (empty($id)) {

    $data = array(
        "promotion_title" => $title,
        "promotion_detail" => $detail,
        "promotion_discount" => $discount,
        "promotion_date_start" => $start,
        "promotion_date_end" => $end,
        "user_id" => check_session("id")
    );

    insert("tb_promotion", $data);

    sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../promotion.php");
    die();
    
} else {
    $data = array(
        "promotion_title" => $title,
        "promotion_detail" => $detail,
        "promotion_discount" => $discount,
        "promotion_date_start" => $start,
        "promotion_date_end" => $end,
        "user_id" => check_session("id")
    );


    update("tb_promotion", $data, "promotion_id = '{$id}'");

    sweetalert_success("แก้ไขสำเร็จ!!", "","../promotion.php");
    die();
}

?>