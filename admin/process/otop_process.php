<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

if (empty($id)) {

    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "otop_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "otop_name" => $name,
            "otop_detail" => $detail,
            "otop_picture" => $img_name,
            "otop_date" => date("Y-m-d H:i:s"),
            "user_id" => check_session("id")
        );

        insert("tb_otop", $data);

        sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../otop.php");
        die();
    } else {

        sweetalert_error_b("รูปภาพไม่ถูกต้อง!!", "");
        die();
    }
} else {
    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "otop_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "otop_name" => $name,
            "otop_detail" => $detail,
            "otop_picture" => $img_name,
            "user_id" => check_session("id")
        );


        update("tb_otop", $data, "otop_id = '{$id}'");

        sweetalert_success("แก้ไขสำเร็จ!!", "","../otop.php");
        die();
    } else {
        $data = array(
            "otop_name" => $name,
            "otop_detail" => $detail,
            "user_id" => check_session("id")
        );


        update("tb_otop", $data, "otop_id = '{$id}'");

        sweetalert_success("แก้ไขสำเร็จ!!", "","../otop.php");
        die();
    }
}

?>