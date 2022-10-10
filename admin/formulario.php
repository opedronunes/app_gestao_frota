<?php

$acao = 'recuperar';
require ("../classes/colaborador_controller.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/bootstrapv5.2.min.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
    <title>Atualizar</title>
</head>
    <body>
        <main class="container">
            <h2>Atualizar Colaborador</h2>
            <form class="row" action="../classes/colaborador_controller.php?acao=atualizar" method="post">
                <input type="hidden" name="id" value="<?= $colaborador->id_colaborador ?>">
                <div class="inputs col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="<?= $colaborador->no_colaborador ?>">
                </div>

                <div class="inputs col-md-6">
                    <label for="cpf">CPF:</label>
                    <input  type="text" name="cpf" id="cpf" value="<?= $colaborador->nu_cpf_colaborador ?>">
                    
                </div>

                <div class="inputs col-md-6">
                    <label>Função:</label>
                    <input type="text" name="funcao" value="<?= $colaborador->no_funcao ?>">
                    
                </div>
                <div class="inputs col-md-6">
                    <label>Salário:</label>
                    <input type="number" name="salario"  value="<?= $colaborador->vl_salario ?>">
                    
                </div>
                <div class="inputs col-md-4">
                    <label>Nascimento:</label>
                    <input type="date" name="nascimento"  value="">
                    
                </div> 
                <div class="inputs col-md-4">
                    <label>Admissão:</label>
                    <input type="date" name="admissao"  value="">
                    
                </div> 
                <div class="inputs col-md-4">
                    <label for="ativo">Status:</label>
                    <select name="status" id="ativo" required>
                        <option value="1">Ativo</option>
                        <option value="2">Inativo</option>
                    </select>
                </div>
                <div>
                    <input type="submit" value="Atualizar">
                </div>
            </form>
        </main> 

        <script src="../assets/js/bootstrapv5.2.min.js"></script>
    </body>
</html>