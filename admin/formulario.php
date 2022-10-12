<?php


require ("../conexao/conexao.php");

session_start();
ob_start();

if ((!isset($_SESSION['id_usuario'])) AND (!isset($_SESSION['email_usuario']))) {
    header("Location: ../index.php");
}

$id_colaborador = (isset($_GET['id'])) ? $_GET['id'] : '';


if (!empty($id_colaborador) && is_numeric($id_colaborador)) {
    $conn = (new Conexao())->conectar();
    $query = "SELECT * FROM tb_colaborador WHERE id_colaborador = :id_colaborador";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id_colaborador', $id_colaborador);
    $stmt->execute();
    $colaboradorId = $stmt->fetch(PDO::FETCH_OBJ);
    if(!$colaboradorId){
        header("Location: ./colaborador.php?erro=1");
    }
}

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
                <input type="hidden" name="id" value="<?= $colaboradorId->id_colaborador ?>">
                <div class="inputs col-md-6">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="<?= $colaboradorId->no_colaborador ?>">
                </div>
                <div class="inputs col-md-6">
                    <label for="cpf">CPF:</label>
                    <input  type="text" name="cpf" id="cpf" value="<?= $colaboradorId->nu_cpf_colaborador ?>">
                </div>
                <div class="inputs col-md-6">
                    <label>Função:</label>
                    <input type="text" name="funcao" value="<?= $colaboradorId->no_funcao ?>">
                    
                </div>
                <div class="inputs col-md-6">
                    <label>Salário:</label>
                    <input type="number" name="salario"  value="<?= $colaboradorId->vl_salario ?>">
                    
                </div>
                <div class="inputs col-md-4">
                    <label>Nascimento:</label>
                    <input type="date" name="nascimento"  value="<?= $colaboradorId->dt_nascimento?>">
                    
                </div> 
                <div class="inputs col-md-4">
                    <label>Admissão:</label>
                    <input type="date" name="admissao"  value="<?= $colaboradorId->dt_admissao?>">
                </div> 
                <div class="inputs col-md-4">
                    <label for="ativo">Status:</label>
                    <select name="status" id="ativo" required>
                        <option value="1" <?= $colaboradorId->id_status == 1 ? 'selected' : ''; ?>>Ativo</option>
                        <option value="2" <?= $colaboradorId->id_status == 2 ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>
                <div>
                    <input type="submit" value="Atualizar">
                    <a class="mx-2" href="../admin/colaborador.php">Voltar</a>
                </div>
            </form>
        </main> 

        <script src="../assets/js/bootstrapv5.2.min.js"></script>
    </body>
</html>