<?php


require ("../classes/colaborador.model.php");
require ("../classes/colaborador.service.php");
require ("../conexao/conexao.php");

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $colaborador = new Colaborador();
    $colaborador->__set('nu_cpf_colaborador', $_POST['cpf']);
    $colaborador->__set('no_colaborador', $_POST['nome']);
    $colaborador->__set('dt_nascimento', $_POST['nascimento']);
    $colaborador->__set('dt_admissao', $_POST['admissao']);
    $colaborador->__set('no_funcao', $_POST['funcao']);
    $colaborador->__set('vl_salario', $_POST['salario']);
    $colaborador->__set('id_status', $_POST['status']);

    $conexao = new Conexao();

    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradorService->inserir();

    header('Location: ../admin/colaborador.php?inclusao=1');

}elseif ($acao == 'recuperar') {
    
    $colaborador = new Colaborador();
    $conexao = new Conexao();

    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradores = $colaboradorService->recuperar();

}elseif ($acao = 'atualizar') {
    $colaborador = new Colaborador();
    $colaborador->__set('id_colaborador', $_POST['id']);
    $colaborador->__set('nu_cpf_colaborador', $_POST['cpf']);
    $colaborador->__set('no_colaborador', $_POST['nome']);
    $colaborador->__set('dt_nascimento', $_POST['nascimento']);
    $colaborador->__set('dt_admissao', $_POST['admissao']);
    $colaborador->__set('no_funcao', $_POST['funcao']);
    $colaborador->__set('vl_salario', $_POST['salario']);
    $colaborador->__set('id_status', $_POST['status']);
    
    $conexao = new Conexao();

    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradorService->atualizar();
    /*
    if () {

        header("Location: ../admin/formulario.php");
        if (isset($_GET['pag']) && $_GET['pag'] == 'formulario') {
        }

        header("Location: ../admin/colaborador.php");
        
    }
    */
}elseif ($acao == 'recuperarTodosColaboradores') {
    $colaborador = new Colaborador();
    $colaborador->__set('id_colaborador', 1);

    $conexao = new Conexao();

    $colaboradorService = new ColaboradorService($conexao, $colaborador);
    $colaboradores = $colaboradorService->recuperarTodosColaboradores();
}