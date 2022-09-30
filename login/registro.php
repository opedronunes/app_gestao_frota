<?php

require_once '../conexao/connection.php';

//Define variáveis e inicializa com valores vazios
$nome = $cpf = $email = $senha = $perfil = $status = "";
$nome_err = $cpf_err = $email_err = $senha_err = $perfil_err = $status_err = "";

//Processando dados do formulário quando ele é enviado.
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    //Valida o email do usuario. ->(empty: determina se uma variável esta vazia, trim: remove espaços em branco no inicio e no final)
    if (empty(trim($_POST['email']))) {
        $email_err = "Favor, coloque um email de usuário!";
    }else{
        //Prepara a query para verificar se existe um usuario com o mesmo email
        $sql = "SELECT id_usuario FROM tb_usuario WHERE email_usuario = :email";

        if ($stmt = $conexao->prepare($sql)) {
            //Vincula as variáveis à instrução preparada como parâmetro
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            //Define o parâmetro
            $param_email = trim($_POST['email']);

            //Tenta executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "Este e-amil já esta em uso!";
                }else {
                    $nome = trim($_POST['nome']);
                    $cpf = trim($_POST['cpf']);
                    $email = trim($_POST['email']);
                }
            }else{
                echo "Oops! Algo deu errado. Tente novamente mais tarde.";
            }

            // Fecha a declaração
            unset($stmt);
        }
    }

    // valida a senha do usuario
    if (empty(trim($_POST['senha']))) {
        $senha_err = "Favor, insira uma senha!";
    }elseif (strlen(trim($_POST['senha'])) < 6) {
        $senha_err = "A senha deve ter pelo menos 6 caracteres!";
    }else {
        $senha = trim($_POST['senha']);
        $perfil = trim($_POST['perfil']);
        $status = trim($_POST['status']);
    }

    //Verifica os erros de entrada antes d inserir no banco de dados
    if (empty($email_err) && empty($senha_err)) {
        
        //Prepara uma declaração de inserção
        $sql = "INSERT INTO tb_usuario(no_usuario, nu_cpf_usuario, email_usuario, senha_usuario, id_perfil, id_status) VALUES(:no_usuario, :nu_cpf_usuario, :email_usuario, :senha_usuario, :id_perfil, :id_status)";

        if ($stmt = $conexao->prepare($sql)) {
            
            //Vincula as variáveis á instrução preparada como parâmetros
            $stmt->bindParam(":no_usuario", $param_nome, PDO::PARAM_STR);
            $stmt->bindParam(":nu_cpf_usuario", $param_cpf, PDO::PARAM_STR);
            $stmt->bindParam(":email_usuario", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":senha_usuario", $param_senha, PDO::PARAM_STR);
            $stmt->bindParam("id_perfil", $param_perfil, PDO::PARAM_STR);
            $stmt->bindParam(":id_status", $param_status, PDO::PARAM_STR);

            //Define os Parâmetros
            $param_nome = $nome;
            $param_cpf = $cpf;
            $param_email = $email;
            $param_senha = password_hash($senha, PASSWORD_DEFAULT);
            $param_perfil = $perfil;
            $param_status = $status;

            //Tenta executar a declaração preparada
            if ($stmt->execute()) {
                
                //redireciona o usuário para login
                header("Location: ../index.php");
            }else{
                echo "Oops! Algo deu errado. Tente novamente mais tarde.";
            }

            //Fecha a declaração
            unset($stmt);
        }
    }

    //Fecha a conexão
    unset($conexao);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/bootstrapv5.2.min.css">
    <title>Cadastro</title>
</head>
    <body>
        <div class="wrapper container">
            <div class="container-login">
                <h2>Cadastro</h2>
                <p>Por favor, preencha este formulário para criar uma conta.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label class="form-label" for="nome">Nome:</label>
                        <input class="form-control <?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>" type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="cpf">CPF:</label>
                        <input class="form-control <?php echo (!empty($cpf_err)) ? 'is-invalid' : ''; ?>" type="text" name="cpf" id="cpf" value="<?php echo $cpf; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email do usuário</label>
                        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div> 
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                        <span class="invalid-feedback"><?php echo $senha_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="perfil">Perfil:</label>
                        <select class="form-select" name="perfil" id="perfil" required>
                            <option value="1">Administrador</option>
                            <option value="2">Cliente</option>
                            <option value="3">Funcionário</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="ativo">Status:</label>
                        <select class="form-select" name="status" id="ativo" required>
                            <option value="1">Ativo</option>
                            <option value="2">Inativo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary my-2" value="Criar Conta">
                        <input type="reset" class="btn btn-secondary my-2 ml-2" value="Apagar Dados">
                    </div>
                    <p>Já tem uma conta? <a href="../index.php">Entre aqui</a>.</p>
                </form>
            </div>
        </div> 

        <script src="../assets/js/bootstrapv5.2.min.js"></script>
    </body>
</html>