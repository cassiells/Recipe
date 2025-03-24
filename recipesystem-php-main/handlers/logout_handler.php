<?php
session_start();
session_destroy();
setcookie("access_token", "", time() - 3600, "/");
header("Location: ../index.php"); 
exit;
?>