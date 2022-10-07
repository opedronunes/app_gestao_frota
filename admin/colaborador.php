<?php
include_once "../conexao/connection.php";

session_start();
ob_start();

if ((!isset($_SESSION['id_usuario'])) AND (!isset($_SESSION['email_usuario']))) {
    header("Location: ../index.php");
}
//include("./classes/Gestao.class.php");
include("./conexao/connection.php");

$query = "SELECT 
            c.*,
            s.no_status
            FROM tb_colaborador as c
            INNER JOIN tb_status as s
            ON
            c.id_status = s.id_status
            ORDER BY no_colaborador ASC
";

$dados = $conexao->query($query);
$dados->execute();


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
                <div class="table-responsive-md">
                    <div class="table-top">
                        <i class="ph-users-three"></i>Todos os Colaboradores
                    </div>
                    <table class="table"> 
                        <tr> 
                            <th>#</th>  
                            <th>CPF</th>
                            <th>Nome</th> 
                            <th>Nascimento</th>
                            <th>Admissão</th>         
                            <th>Função</th> 
                            <th>Salário</th> 
                            <th>Registrado em</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr> 
                        <?php while($result = $dados->fetch(PDO::FETCH_ASSOC)) { ?> 
                        <tr> 
                            <th><?= $result['id_colaborador']; ?></th>
                            <td><?= $result['nu_cpf_colaborador']; ?></td>
                            <td><?= $result['no_colaborador']; ?></td>
                            <td><?= $result['dt_nascimento']; ?></td> 
                            <td><?= $result['dt_admissao']; ?></td>
                            <td><?= $result['no_funcao']; ?></td>
                            <td><?= $result['vl_salario']; ?></td>
                            <td><?= $result['dt_cadastro']; ?></td>
                            <td><?= $result['no_status']; ?></td>
                            <td> 
                                <a href=""><i class="ph-pencil-simple"></i></a> 
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