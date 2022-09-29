<?php

require "./Models/usuarioModel.php";
require "./login/LoginService.php";
require "./conexao/Conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    
    $usuario = new Usuario();
    $usuario->__set('usuario', $_POST['']);
}

?>