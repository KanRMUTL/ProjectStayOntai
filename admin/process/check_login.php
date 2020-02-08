<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

$position = 0;

$sql = "select * from tb_user where user_email = '{$email}' AND user_password = '{$password}' AND user_type != 9 AND user_status = 1";
$row = row_array($sql);

if($row > 0){
    $id = $row['user_id'];
    $name = $row['user_name'];
    $lastname = $row['user_lastname'];
    $picture = $row['user_picture'];
    $role = $row['user_type'];
    

}else{
    sweetalert_error("เกิดข้อผิดพลาด!!", "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง","../login.php");
    die();
}

$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
$_SESSION['lastname'] = $lastname;
$_SESSION['picture'] = $picture;
$_SESSION['role'] = $role;


sweetalert_success("ยินดีต้อนรับเข้าสู่ระบบ!!", "","../index.php");
