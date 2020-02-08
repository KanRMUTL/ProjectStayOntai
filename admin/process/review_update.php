<?php

include '../../function/db_function.php';
include '../../function/function.php';

extract($_GET);


$data = array(
    "review_status" => $status
);

update("tb_review", $data, "review_id = {$id}");

if($status == 2){
    $data = array(
        "review_show" => 0
    );

    update("tb_review", $data, "review_id = {$id}");
}



echo"<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";




?>