<?php

include '../function/db_function.php';
include '../function/function.php';
include '../include/sweetalert_process.php';
include '../function/sweetalert.php';

extract($_POST);

$sql = "SELECT * FROM tb_user WHERE user_email = '{$email}' AND user_id != '{$id}'";
$check = row_array($sql);

if($check){
    sweetalert_error_b("เกิดข้อผิดพลาด!!", "อีเมลนี้ถูกใช้งานแล้ว");
    die();
}


$file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
$img_name = "user_" . date('YmdHis') . $file_ext;

if (move_uploaded_file($_FILES["img"]["tmp_name"], "../uploads/" . $img_name)) {

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
        "user_picture" => $img_name,
        "user_titlename" => $user_titlename,
        "subdistrict_id" => $subdistricts,
        "user_type" => 9
    );

    insert("tb_user", $data);


    sweetalert_success("สมัครสมาชิกสำเร็จ!!", "","../index.php?module=user&action=login");
    die();
} else {
    echo "<meta charset='utf-8'/><script>alert('รูปภาพไม่ถูกต้อง!!');location.href='../index.php?module=user&action=register';</script>";
    die();
}


?>