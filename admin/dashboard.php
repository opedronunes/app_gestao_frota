<?php
session_start();
ob_start();

if ((!isset($_SESSION['id_usuario'])) AND (!isset($_SESSION['email_usuario']))) {
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem vindo <?= $_SESSION['no_status'] ?>!</h1>
    <a href="../login/logoff.php">sair</a>
</body>
</html>