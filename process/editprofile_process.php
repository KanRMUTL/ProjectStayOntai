<?php

include '../function/db_function.php';
include '../function/function.php';
include '../include/sweetalert_process.php';
include '../function/sweetalert.php';


extract($_POST);


$file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
$img_name = "user_" . date('YmdHis') . $file_ext;

if (move_uploaded_file($_FILES["img"]["tmp_name"], "../uploads/" . $img_name)) {

    $data = array(
        "user_password" => $password,
        "user_status" => 1,
        "update_at" => date("Y-m-d H:i:s"),
        "user_name" => $name,
        "user_lastname" => $lastname,
        "user_address" => $address,
        "user_tel" => $tel,
        "user_birth" => $birth,
        "user_picture" => $img_name,
        "user_titlename" => $user_titlename,
        "subdistrict_id" => $subdistricts
    );

    update("tb_user", $data, "user_id = '{$id}'");


    sweetalert_success("แก้ไขสำเร็จ!!", "","../index.php?module=user&action=editprofile");
    die();
} else {
    $data = array(
        "user_password" => $password,
        "user_status" => 1,
        "update_at" => date("Y-m-d H:i:s"),
        "user_name" => $name,
        "user_lastname" => $lastname,
        "user_address" => $address,
        "user_tel" => $tel,
        "user_birth" => $birth,
        "user_titlename" => $user_titlename,
        "subdistrict_id" => $subdistricts
    );

    update("tb_user", $data, "user_id = '{$id}'");

    sweetalert_success("แก้ไขสำเร็จ!!", "","../index.php?module=user&action=editprofile");
    die();
}

?>