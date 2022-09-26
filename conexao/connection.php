<?php

$servername = "127.0.0.1";
$username = "root";
$password = "Pedro@2022";
$dbname = "db_app_frota";

try {
  $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "A conexão com o banco de dados falhou " . $e->getMessage();
}

?>