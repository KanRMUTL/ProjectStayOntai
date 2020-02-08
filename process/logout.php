<?PHP
session_start();
session_destroy();

echo"<meta charset='utf-8'/><script>location.href='../index.php';</script>";
die();

?>