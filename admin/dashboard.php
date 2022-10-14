<?php
include_once "../conexao/connection.php";

session_start();
ob_start();

if ((!isset($_SESSION['id_usuario'])) AND (!isset($_SESSION['email_usuario']))) {
    header("Location: ../index.php");
}

$sql = "SELECT COUNT(id_colaborador) AS qtd_colaborador FROM tb_colaborador";
$tcolaborador = $conexao->prepare($sql);
$tcolaborador->execute();
$row_colaborador = $tcolaborador->fetch(PDO::FETCH_ASSOC);

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
    <title>Dashboard</title>
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
                        <li><a href="./colaborador.php"><i class="ph-users-three"></i> Colaboradoes</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <section id="">
            <div class="container">
                <div id="card-total">
                    <div id="card-faturamento" class="cards">
                        <h6>Faturamento</h6>
                        <div class="card-content">
                            <h4>R$15.000,00</h4>
                        </div>
                    </div>
                    <div id="card-frotas" class="cards">
                        <h6>Frotas</h6>
                        <div class="card-content">
                            <h4>23</h4>
                        </div>
                    </div>
                    <div id="card-funcionario" class="cards">
                        <h6>Colaboradores</h6>
                        <div class="card-content">
                            <h4><?= $row_colaborador['qtd_colaborador'] ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="title-table">
                    <i class="ph-clock-clockwise"></i>Últimos lançamentos
                </div>
                <div class="my-4">
                    <h4>Essa página esta em construção!</h4>
                    <small>Para visualizar o CRUD acesse a página Colaboradores.</small>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div id="itens">
                    <small>Nesta entrega, é uma pequena parte de um projeto maior, em que será criado um sistema completo de gestão de frotas e seu faturamento.</small>
                    <div class="item">
                        <h5>O que foi feito no projeto:</h5>
                        <ol>
                            <li><strong>Tela de login</strong> com autenticação de usuário, validação e niveis de acesso.</li>
                            <li><strong>Telas de cadastro</strong> de usuários e colaboradores.</li>
                            <li><strong>Função de edição</strong> dos dados dos colaboradores.</li>
                            <li><strong>Função de exclusão</strong> de dados do banco de dados.</li>
                            <li><strong>Segurança de dados</strong> com PDO.</li>
                            <li><strong>Paradigma de orientação a objetos.</strong></li>
                            <li><strong>Hospedagem</strong> feita na Infinity Free.</li>
                        </ol>
                    </div>
                    <div class="item">
                        <h5>Próximos passos:</h5>
                        <ol>
                            <li>Inclusão das entidades restantes: Frotas, faturamento e Despesas.</li>
                            <li>Composer: utilização de namespaces, pacotes que auxiliarão no desenvolvimento.</li>
                            <li>Adaptação para ser utilizado em vários dispositivos.</li>
                            <li>Buscando novas feautures...</li>
                        </ol>
                    </div>
                    <small>OBS.: Provável que o projeto completo será integrado a um site, ou entregue em sua forma principal para solucionar problemas reais.</small>
                </div>
            </div>
        </section>
        <footer>
            <div class="container">
                <div id="social">
                    <ul>
                        <li><a href="https://www.opedronunes.com.br/" target="_blank" title="Portfólio"><i class="ph-rocket-launch"></i></a></li>
                        <li><a href="https://github.com/opedronunes" target="_blank" title="GitHub"><i class="ph-github-logo"></i></a></li>
                        <li><a href="https://www.instagram.com/opedronunes.dev/" target="_blank" title="Instagram"><i class="ph-instagram-logo"></i></a></li>
                        <li><a href="https://api.whatsapp.com/qr/OZWPJVZZLJ2WG1" target="_blank" title="Whatsapp"><i class="ph-whatsapp-logo"></i></a></li>
                    </ul>
                </div>
            </div>

        </footer>
        <script src="../assets/js/bootstrapv5.2.min.js"></script> 
    </body>
</html>