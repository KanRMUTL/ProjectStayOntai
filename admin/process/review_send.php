<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

//sms($tel,$msg);

$data = array(
    "review_status" => 1
);

update("tb_review", $data, "review_id = {$id}");

$data = array(
    "review_answer_detail" => $msg,
    "review_answer_date" => date("Y-m-d H:i:s"),
    "review_answer_status" => 1,
    "review_id" => $id,
    "user_id" => check_session("id")
);

insert("tb_review_answer", $data);

sweetalert_success("ทำรายการสำเร็จ!!", "ตอบกลับรีวิวแล้ว", "../review_detail.php?id={$id}");
die();

?>