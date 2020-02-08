<?php

include '../../function/db_function.php';
include '../../function/function.php';

extract($_GET);


$data = array(
    "review_answer_status" => $status
);

update("tb_review_answer", $data, "review_answer_id = {$id}");



echo"<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";




?>