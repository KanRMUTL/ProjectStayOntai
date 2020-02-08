<?php

include '../function/db_function.php';
include '../function/function.php';
include '../include/sweetalert_process.php';
include '../function/sweetalert.php';

extract($_POST);


$sql = "select * from tb_user where user_email = '{$email}' AND user_password = '{$password}' AND user_type = 9";
$result = row_array($sql);

if($result > 0){
    $_SESSION['user_id'] = $result['user_id'];

    sweetalert_success("ยินดีต้อนรับเข้าสู่ระบบ!!", "","../index.php?module=home&action=index");
    die();

}else{
    sweetalert_error("เกิดข้อผิดพลาด!!", "อีเมล์หรือรหัสผ่านไม่ถูกต้อง","../index.php?module=user&action=login");
    die();
}

?>