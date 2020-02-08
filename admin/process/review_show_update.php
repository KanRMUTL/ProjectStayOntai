<?php

include '../../function/db_function.php';
include '../../function/function.php';

extract($_GET);


$data = array(
    "review_show" => $status
);

update("tb_review", $data, "review_id = {$id}");



echo"<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";




?>