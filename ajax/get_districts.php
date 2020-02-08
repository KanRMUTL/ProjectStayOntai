<?php

include '../function/db_function.php';
include '../function/function.php';

extract($_POST);



$sql = "SELECT * FROM tb_districts WHERE province_id = '{$id}'";
$list = result_array($sql);
echo "<option selected disabled value=''>กรุณาเลือกอำเภอ</option>";
foreach($list as $row){
    echo "<option value='{$row['district_id']}'>{$row['name_in_thai']}</option>";
}


?>

