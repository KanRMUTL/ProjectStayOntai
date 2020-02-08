<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

$sql = "SELECT * FROM tb_user WHERE user_email = '{$email}' AND user_id != '{$id}'";
$check = row_array($sql);

if($check){
    sweetalert_error_b("เกิดข้อผิดพลาด!!", "อีเมลนี้ถูกใช้งานแล้ว");
    die();
}

if (empty($id)) {

    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "user_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "user_email" => $email,
            "user_password" => $password,
            "user_status" => 1,
            "user_type" => 1,
            "create_at" => date("Y-m-d H:i:s"),
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

        insert("tb_user", $data);


        sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../owner.php");
        die();
    } else {
        $data = array(
            "user_email" => $email,
            "user_password" => $password,
            "user_status" => 1,
            "create_at" => date("Y-m-d H:i:s"),
            "update_at" => date("Y-m-d H:i:s"),
            "user_name" => $name,
            "user_lastname" => $lastname,
            "user_address" => $address,
            "user_tel" => $tel,
            "user_birth" => $birth,
            "user_titlename" => $user_titlename,
            "subdistrict_id" => $subdistricts
        );

        insert("tb_user", $data);


        sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../owner.php");
        die();
    }
} else {
    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "user_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {


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


        sweetalert_success("แก้ไขสำเร็จ!!", "","../owner.php");
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

        sweetalert_success("แก้ไขสำเร็จ!!", "","../owner.php");
        die();
    }
}

?>