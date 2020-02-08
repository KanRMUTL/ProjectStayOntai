<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);


if (empty($id)) {

    $data = array(
        "ledger_name" => $name,
        "ledger_money" => $money,
        "ledger_date" => date("Y-m-d"),
        "ledger_type" => $type,
        "homestay_id" => $homestay_id
    );

    insert("tb_ledger", $data);


    sweetalert_success("เพิ่มข้อมูลสำเร็จ!!", "","../ledger.php");
    die();

} else {
    $data = array(
        "ledger_name" => $name,
        "ledger_money" => $money,
        "ledger_type" => $type,
        "homestay_id" => $homestay_id
    );


    update("tb_ledger", $data, "ledger_id = '{$id}'");

    sweetalert_success("แก้ไขสำเร็จ!!", "","../ledger.php");
    die();
}

?>