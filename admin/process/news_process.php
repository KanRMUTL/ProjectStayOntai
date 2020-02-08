<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

if (empty($id)) {

    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "news_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "news_title" => $title,
            "news_short" => $short,
            "news_detail" => $detail,
            "news_picture" => $img_name,
            "news_date" => date("Y-m-d H:i:s"),
            "user_id" => check_session("id")
        );

        insert("tb_news", $data);


        sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../news.php");
        die();
    } else {

        sweetalert_error_b("รูปภาพไม่ถูกต้อง!!", "");
        die();
    }
} else {
    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "news_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "news_title" => $title,
            "news_short" => $short,
            "news_detail" => $detail,
            "news_picture" => $img_name,
            "user_id" => check_session("id")
        );


        update("tb_news", $data, "news_id = '{$id}'");


        sweetalert_success("แก้ไขสำเร็จ!!", "","../news.php");
        die();
    } else {
        $data = array(
            "news_title" => $title,
            "news_short" => $short,
            "news_detail" => $detail,
            "user_id" => check_session("id")
        );


        update("tb_news", $data, "news_id = '{$id}'");

        sweetalert_success("แก้ไขสำเร็จ!!", "","../news.php");
        die();
    }
}

?>