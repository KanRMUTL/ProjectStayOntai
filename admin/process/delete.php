<?php

include '../../function/db_function.php';
include '../../function/function.php';


extract($_GET);

delete($table,"{$ff} = {$id}");


echo"<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";








?>

