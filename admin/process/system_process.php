<?php

include '../../function/db_function.php';
include '../../function/function.php';


extract($_GET);

$data = array(
    "system_value" => $value
);

update("tb_system", $data, "system_id = {$id}");




echo"<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";








?>

