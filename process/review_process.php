<?php

include '../function/db_function.php';
include '../function/function.php';
include '../include/sweetalert_process.php';
include '../function/sweetalert.php';

extract($_POST);

$data = array(
    "review_star" => $star,
    "review_name" => $name,
    "user_id" => check_session("user_id"),
    "review_date" => date("Y-m-d H:i:s"),
    "review_detail" => $detail,
    "homestay_id" => $homestay_id,
    "review_show" => 0,
    "review_status" => 0
);

insert("tb_review", $data);

sweetalert_success("ส่งรีวิวสำเร็จ!!", "ขอบคุณสำหรับรีวิว","../index.php?module=user&action=list_review");
die();

?>