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
                        <li><a href=""><i class="ph-house"></i> Home</a></li>
                        <li><a href=""><i class="ph-currency-dollar"></i> Faturameto</a></li>
                        <li><a href=""><i class="ph-truck"></i> Frotas</a></li>
                        <li><a href=""><i class="ph-users-three"></i> Funcionários</a></li>
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
                        <h6>Funcionários</h6>
                        <div class="card-content">
                            <h4>28</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="../assets/js/bootstrapv5.2.min.js"></script>
    </body>
</html>