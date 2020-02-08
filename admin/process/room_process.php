<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);

if (empty($id)) {

    $data = array(
        "room_name" => $room_name,
        "room_beds" => $room_beds,
        "room_size" => $room_size,
        "room_description" => $detail,
        "room_type" => $room_type,
        "homestay_id" => $homestay_id
    );

    insert("tb_room", $data);


    sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../room.php?id={$homestay_id}");
    die();
} else {
    $data = array(
        "room_name" => $room_name,
        "room_beds" => $room_beds,
        "room_size" => $room_size,
        "room_description" => $detail,
        "room_type" => $room_type,
        "homestay_id" => $homestay_id
    );


    update("tb_room", $data, "room_id = '{$id}'");

    sweetalert_success("แก้ไขสำเร็จ!!", "","../room.php?id={$homestay_id}");
    die();
}

?>