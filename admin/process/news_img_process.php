<?php

include '../../function/db_function.php';
include '../../function/function.php';
include '../include/sweetalert_process.php';
include '../../function/sweetalert.php';

extract($_POST);
$extension = array("jpeg", "jpg", "png", "gif" , "JPG" , "PNG");

foreach ($_FILES["img"]["tmp_name"] as $key => $tmp_name) {
    $file_name = $_FILES["img"]["name"][$key];
    $file_tmp = $_FILES["img"]["tmp_name"][$key];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    if (in_array($ext, $extension)) {

        $filename = basename($file_name, $ext);
        $newFileName = $key."maintenance_".date('YmdHis') .".". $ext;
        if(move_uploaded_file($file_tmp = $_FILES["img"]["tmp_name"][$key], "../../uploads/" . $newFileName)){
            $arr = array(
                "news_id" => $id,
                "newspic_img" => $newFileName
            );

            insert("tb_newspic",$arr);
        }

    }
}

sweetalert_success_ref("อัพโหลดสำเร็จ!!", "");
die();

?>