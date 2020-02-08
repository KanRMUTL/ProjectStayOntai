<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

delete("tb_service_option","homestay_id = '{$id}'");

if(isset($service)){
    foreach ($service as $service_id){
        $data = array(
            "homestay_id" => $id,
            "service_id" => $service_id
        );

        insert("tb_service_option", $data);
    }
}

if (empty($id)) {

    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "homestay_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "homestay_name" => $name,
            "homestay_price" => $price,
            "homestay_address" => $address,
            "homestay_detail" => $detail,
            "homestay_latitude" => $lat,
            "homestay_longitude" => $lng,
            "homestay_pic" => $img_name,
            "homestay_status" => 1,
            "user_id" => check_session("id")
        );

        insert("tb_homestay", $data);


        sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../homestay.php");
        die();
    } else {

        sweetalert_error_b("รูปภาพไม่ถูกต้อง!!", "");
        die();
    }
} else {
    $file_ext = substr($_FILES["img"]["name"], strripos($_FILES["img"]["name"], '.'));
    $img_name = "homestay_" . date('YmdHis') . $file_ext;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], "../../uploads/" . $img_name)) {

        $data = array(
            "homestay_name" => $name,
            "homestay_price" => $price,
            "homestay_address" => $address,
            "homestay_detail" => $detail,
            "homestay_latitude" => $lat,
            "homestay_pic" => $img_name,
            "homestay_longitude" => $lng,
            "user_id" => check_session("id")
        );


        update("tb_homestay", $data, "homestay_id = '{$id}'");


        sweetalert_success("แก้ไขสำเร็จ!!", "","../homestay.php");
        die();
    } else {
        $data = array(
            "homestay_name" => $name,
            "homestay_price" => $price,
            "homestay_address" => $address,
            "homestay_detail" => $detail,
            "homestay_latitude" => $lat,
            "homestay_longitude" => $lng,
            "user_id" => check_session("id")
        );


        update("tb_homestay", $data, "homestay_id = '{$id}'");

        sweetalert_success("แก้ไขสำเร็จ!!", "","../homestay.php");
        die();
    }
}

?>