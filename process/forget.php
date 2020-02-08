<?php

include '../function/db_function.php';
include '../function/function.php';
include '../include/sweetalert_process.php';
include '../function/sweetalert.php';

extract($_POST);


$sql = "select * from tb_user where user_email = '{$email}' AND user_tel = '{$tel}' AND user_type = 9";
$result = row_array($sql);

if($result > 0){
    $msg = "รหัสผ่านของคุณคือ {$result['user_password']} ";

    sms($result['user_tel'],$msg);

    sweetalert_success("ทำรายการสำเร็จ!!", "ระบบส่งรหัสผ่านไปยังเบอร์โทรของคุณแล้ว","../index.php?module=user&action=login");
    die();

}else{
    sweetalert_error("เกิดข้อผิดพลาด!!", "อีเมล์หรือเบอร์โทรไม่ถูกต้อง","../index.php?module=user&action=forget_password");
    die();
}

?>