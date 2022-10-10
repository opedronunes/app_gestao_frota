<?php
include_once "../conexao/connection.php";
include_once "../classes/Gestao.class.php";

$acao = 'recuperar';
require ("../classes/colaborador_controller.php");

$message = "";
if (isset($_GET['inclusao'])) {
    if ($_GET['inclusao'] == 1) {
        $message = "<div class='bg-success pt-2 text-white d-flex justify-content-center'>
                        <h5>Colaborador inserido com sucesso!</h5>
                    </div>";
    }
}


session_start();
ob_start();

if ((!isset($_SESSION['id_usuario'])) AND (!isset($_SESSION['email_usuario']))) {
    header("Location: ../index.php");
}
/*
$query = "SELECT 
            c.*,
            s.no_status
            FROM tb_colaborador as c
            INNER JOIN tb_status as s
            ON
            c.id_status = s.id_status
            ORDER BY no_colaborador ASC
";

$result = $conexao->query($query);
$result->execute();
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles/bootstrapv5.2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/dashboard.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
    <script src="https://unpkg.com/phosphor-icons"></script>
    <title>Colaborador</title>
</head>
    <body>
        <header>
            <div class="container">
                <div id="top">
                    <div>
                        <h3>Gestão de frotas</h3>
                    </div>
                    <div id="perfil">
                        <div id="user">
                            <button title="Editar Perfil"><i class="ph-user"></i></button>
                            <p><?= $_SESSION['no_usuario'] ?></p>
                        </div>
                        <a href="../login/logoff.php"><i class="ph-sign-out" title="Sair"></i></a>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li><a href="./dashboard.php"><i class="ph-house"></i> Home</a></li>
                        <li><a href=""><i class="ph-currency-dollar"></i> Faturameto</a></li>
                        <li><a href=""><i class="ph-truck"></i> Frotas</a></li>
                        <li><a href=""><i class="ph-users-three"></i> Colaboradores</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <section>
            <div class="container">
            <?= $message ?>
                <div class="table-responsive-md">
                    <div class="table-top">
                        <div class="title-table">
                            <i class="ph-users-three"></i>Todos os Colaboradores
                        </div>
                        <!-- Modal Colaborador -->
                        <div id="modal-colaborador">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#addColaborador" title="Novo Colaborador">
                                <i class="ph-plus"></i>
                            </button>
                            <div class="modal fade" id="addColaborador" tabindex="-1" aria-labelledby="addColaboradorModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 id="addColaboradorModal">Adionar novo colaborador</h3>
                                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="ph-x"></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <!--Form adicionar Colaborador -->
                                            <form class="row" action="../classes/colaborador_controller.php?acao=inserir" method="post">
                                                <div class="inputs col-md-6">
                                                    <label for="nome">Nome:</label>
                                                    <input class="<?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>" type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>
                                                </div>

                                                <div class="inputs col-md-6">
                                                    <label for="cpf">CPF:</label>
                                                    <input class="<?php echo (!empty($cpf_err)) ? 'is-invalid' : ''; ?>" type="text" name="cpf" id="cpf" value="<?php echo $cpf; ?>">
                                                    <span class="invalid-feedback"><?php echo $cpf_err; ?></span>
                                                </div>

                                                <div class="inputs col-md-6">
                                                    <label>Função:</label>
                                                    <input type="text" name="funcao" class="<?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                                                    <span class="invalid-feedback"><?php echo $senha_err; ?></span>
                                                </div>
                                                <div class="inputs col-md-6">
                                                    <label>Salário:</label>
                                                    <input type="number" name="salario" class="<?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                                                    <span class="invalid-feedback"><?php echo $senha_err; ?></span>
                                                </div>
                                                <div class="inputs col-md-4">
                                                    <label>Nascimento:</label>
                                                    <input type="date" name="nascimento" class="<?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                                </div> 
                                                <div class="inputs col-md-4">
                                                    <label>Admissão:</label>
                                                    <input type="date" name="admissao" class="<?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                                </div> 
                                                <div class="inputs col-md-4">
                                                    <label for="ativo">Status:</label>
                                                    <select name="status" id="ativo" required>
                                                        <option value="1">Ativo</option>
                                                        <option value="2">Inativo</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <input type="submit" value="Cadastrar">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table"> 
                        <tr> 
                            <th>#</th>  
                            <th>Nome</th> 
                            <th>CPF</th>
                            <th>Nascimento</th>
                            <th>Admissão</th>         
                            <th>Função</th> 
                            <th>Salário</th> 
                            <th>Registrado em</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr> 
                        <?php foreach($colaboradores as $indice => $colaborador){ ?> 
                        <tr> 
                            <th><?= $colaborador->id_colaborador ?></th>
                            <td><?= $colaborador->no_colaborador ?></td>
                            <td><?= $colaborador->nu_cpf_colaborador ?></td>
                            <td><?= date('d/m/Y', strtotime($colaborador->dt_nascimento)) ; ?></td> 
                            <td><?= date('d/m/Y', strtotime($colaborador->dt_admissao)) ; ?></td>
                            <td><?= $colaborador->no_funcao ?></td>
                            <td><?= $colaborador->vl_salario ?></td>
                            <td><?= date('d/m/Y á\s H:i:s', strtotime($colaborador->dt_cadastro)); ?></td>
                            <td><?= $colaborador->no_status ?></td>
                            <td> 
                            
                            
                                <a href="../admin/formulario.php?id=<?= $colaborador->id_colaborador?>"><i class="ph-pencil-simple"></i></a>
                                <a href=""><i class="ph-trash"></i></a> 
                            </td> 
                        </tr> 
                        <?php } ?> 
                    </table>
                </div>
            </div>
        </section>
        <script src="../assets/js/bootstrapv5.2.min.js"></script> 
    </body>
</html>