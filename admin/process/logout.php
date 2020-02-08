<?PHP
session_start();
session_destroy();

echo"<meta charset='utf-8'/><script>location.href='../login.php';</script>";
die();

?>