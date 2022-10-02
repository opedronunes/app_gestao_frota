<?php

//Inicaindo a sessão
session_start();

//Verifica se o usuaário está logado, caso estaja redireciona-o para o deshboard.
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: ./admin/dashboard.php");
}

//Conexão com banco - arquivo de config
require_once "./conexao/connection.php";

//Varáveis de erro vazias
$email = $senha = "";
$email_err = $senha_err = $login_err = "";

//Recebendo dados do form e validando-os
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //Verificar se o nome de usuário está vazio
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira o email de usuário!";
    }else{
        $email = trim($_POST["email"]);
    }

    //Verificar se a senha está vazia
    if (empty(trim($_POST["senha"]))) {
        $senha_err = "Por favor, insira sua senha!";
    }else{
        $senha = trim($_POST["senha"]);
    }

    //Validar as credenciais de acesso
    if (empty($email_err) && empty($senha_err)) { //verifica se as vairáveis de erro estão vazias
        
        //Buscar no BD usuário
        $sql = "SELECT
                    u.no_usuario,
                    u.nu_cpf_usuario,
                    u.email_usuario,
                    u.senha_usuario,
                    p.no_perfil,
                    s.no_status
                FROM 
                    tb_usuario as u
                INNER JOIN
                    tb_perfil as p
                        ON  
                    p.id_perfil = u.id_perfil
                INNER JOIN
                    tb_status as s
                        ON
                    s.id_status = u.id_status
                WHERE
                    email_usuario = :email";

        //$sql = "SELECT id, username, password FROM tb_users WHERE username = :username";

        if ($stmt = $conexao->prepare($sql)) {
            
            //Vincular as variáveis á instrução preparada como parâmetros
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            //Definir parâmetros
            $param_email = trim($_POST["email"]);

            //Tente executar a declaração preparada
            if ($stmt->execute()) {
                
                //Verifica se o usuário existe, caso exista vefifica a senha
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id_usuario"];
                        $nome = $row["no_usuario"];
                        $cpf = $row["nu_cpf_usuario"];
                        $email = $row["email_usuario"];
                        $hashed_password = $row["senha_usuario"];
                        $perfil = $row["no_perfil"];
                        $status = $row["no_status"];
                        if (password_verify($senha, $hashed_password)) {
                            
                            //Se a senha está correta, inicie uma nova sessão

                            //Armazena os dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SERVER["id_usuario"] = $id;
                            $_SESSION['no_usuario'] = $nome;
                            $_SESSION['nu_cpf_usuario'] = $cpf;
                            $_SESSION['email_usuario'] = $email;
                            $_SESSION['no_perfil'] = $perfil;
                            $_SESSION['no_status'] = $status;

                            //Redireciona o usuário para o dashboard
                            header("Location: ./admin/dashboard.php");

                        }else {
                            
                            //Caso a senha não seja válida, exibe uma mensagem de erro genérica
                            $login_err = "Nome de usuário ou senha inválidos!";
                        }
                    }
                }else {
                    
                    //Caso nome de usuário não exista
                    $login_err = "Nome de usuário ou senha inválidos.";

                }
            }else {
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            

            //Fechar declaração
            unset($stmt);

        }
    }

    //Fechar conexão
    unset($conexao);

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
    <link rel="stylesheet" href="./assets/styles/bootstrapv5.2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/index.css">

    <title>Login - App Gestão de Frotas</title>
</head>
<body>
    <main>
        <h2>Acessar Dashboard</h2>
        <?php
            if (!empty($login_err)) {
                echo "<div class='alert alert-danger'>" .$login_err. "</div>";
            }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="inputs">
                <label for="name">Email do usuário:</label>
                <input type="text" name="email" id="name" class="<?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="inputs">
                <label for="password">Senha:</label>
                <input type="password" name="senha" id="senha" class="<?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha ?>">
                <span class="invalid-feedback"><?php echo $senha_err ?></span>
            </div>
            <input type="submit" value="Entrar">
            <p>Não tem uma conta? <a href="./login/registro.php">fazer cadastro</a>.</p>
        </form>
    </main>

    <script src="./assets/js/bootstrapv5.2.min.js"></script>
</body>
</html>