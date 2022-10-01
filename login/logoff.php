<?php
session_start();
ob_start();
unset($_SESSION['id_usuario'], $_SESSION['email_usuario']);
session_destroy();
header('Location: ../index.php');
exit();
?>