<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

if (empty($id)) {

    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "visitplace_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "visitplace_name" => $name,
            "visitplace_detail" => $detail,
            "visitplace_picture" => $img_name,
            "visitplace_latitude" => $lat,
            "visitplace_longitude" => $lng,
            "visitplace_date" => date("Y-m-d H:i:s"),
            "user_id" => check_session("id")
        );

        insert("tb_visitplace", $data);


        sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../visitplace.php");
        die();
    } else {

        sweetalert_error_b("รูปภาพไม่ถูกต้อง!!", "");
        die();
    }
} else {
    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "visitplace_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "visitplace_name" => $name,
            "visitplace_detail" => $detail,
            "visitplace_picture" => $img_name,
            "visitplace_latitude" => $lat,
            "visitplace_longitude" => $lng,
            "user_id" => check_session("id")
        );


        update("tb_visitplace", $data, "visitplace_id = '{$id}'");


        sweetalert_success("แก้ไขสำเร็จ!!", "","../visitplace.php");
        die();
    } else {
        $data = array(
            "visitplace_name" => $name,
            "visitplace_detail" => $detail,
            "visitplace_latitude" => $lat,
            "visitplace_longitude" => $lng,
            "user_id" => check_session("id")
        );


        update("tb_visitplace", $data, "visitplace_id = '{$id}'");

        sweetalert_success("แก้ไขสำเร็จ!!", "","../visitplace.php");
        die();
    }
}

?>