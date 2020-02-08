<?php

include '../function/db_function.php';
include '../function/function.php';

extract($_POST);



$sql = "SELECT * FROM tb_subdistricts WHERE district_id = '{$id}'";
$list = result_array($sql);

foreach($list as $row){
    echo "<option value='{$row['subdistrict_id']}'>{$row['name_in_thai']} [ {$row['zip_code']} ]</option>";
}


?>

