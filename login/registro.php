<?php

require_once('../conexao/Conexao.php');

 
// Defina variáveis e inicialize com valores vazios
$email = $senha = $confirm_senha = "";
$email_err = $senha_err = $confirm_senha_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nome de usuário
    if(empty(trim($_POST["nome"]))){
        $username_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["nome"]))){
        $username_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM tb_usuario WHERE emial_usuario = :email";
        
        if($stmt = $conexao->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_email = trim($_POST["email"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Este email de usuário já está em uso.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Validar senha
    if(empty(trim($_POST["senha"]))){
        $senha_err = "Por favor insira uma senha.";     
    } elseif(strlen(trim($_POST["senha"])) < 6){
        $senha_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $senha = trim($_POST["senha"]);
    }
    
    // Validar e confirmar a senha
    if(empty(trim($_POST["confirm_senha"]))){
        $confirm_senha_err = "Por favor, confirme a senha.";     
    } else{
        $confirm_senha = trim($_POST["confirm_senha"]);
        if(empty($senha_err) && ($senha != $confirm_senha)){
            $confirm_senha_err = "A senha não confere.";
        }
    }
    
    // Verifique os erros de entrada antes de inserir no banco de dados
    if(empty($email_err) && empty($senha_err) && empty($confirm_senha_err)){
        
        // Prepare uma declaração de inserção
        $sql = "INSERT INTO tb_usuario (no_usuario, nu_cpf_usuario, email_usuario, senha_usuario, id_perfil, id_status) VALUES (:nome, :cpf, :email :senha, :perfil, :status)";
         
        if($stmt = $conexao->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":nome", $param_nome, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_cpf, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $param_senha, PDO::PARAM_STR);
            $stmt->bindParam(":perfil", $param_perfil, PDO::PARAM_STR);
            $stmt->bindParam(":status", $param_status, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_nome = $nome;
            $param_cpf = $cpf;
            $param_email = $email;
            $param_senha = password_hash($senha, PASSWORD_DEFAULT); // Creates a password hash
            $param_perfil = $perfil;
            $param_status = $status;

            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Redirecionar para a página de login
                header("location: ../index.php");
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Fechar conexão
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
                        <input class="form-control" type="text" name="nome" id="nome" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="">CPF:</label>
                        <input class="form-control" type="text" name="cpf" id="cpf" required>
                    </div>

                    <div class="form-group">
                        <label>Email do usuário</label>
                        <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div> 
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                        <span class="invalid-feedback"><?php echo $senha_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Confirme a senha</label>
                        <input type="password" name="confirm_senha" class="form-control <?php echo (!empty($confirm_senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_senha; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_senha_err; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="perfil">Perfil:</label>
                        <select class="form-select" name="perfil" id="perfil" required>
                            <option value="1">Adminstrador</option>
                            <option value="2">Cliente</option>
                            <option value="3">Fucionario</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="ativo">Status:</label>
                        <select class="form-select" name="status" id="ativo" required>
                            <option value="1">Ativo</option>
                            <option value="2">Inativo</option>
                        </select>
                    </div>


                    
                    <!---
                    
                    <div class="my-2">
                        <label class="form-label" for="nome">Nome:</label>
                        <input class="form-control" type="text" name="nome" id="nome" required>
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="">CPF:</label>
                        <input class="form-control" type="text" name="cpf" id="cpf" required>
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="email">Email:</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="senha">Senha:</label>
                        <input class="form-control" type="password" name="senha" id="senha" required>
                    </div>

                    <div class="my-2">
                        <label class="form-label" for="perfil">Perfil:</label>
                        <select class="form-select" name="perfil" id="perfil" required>
                            <option value="5">Adminstrador</option>
                            <option value="10">Professor</option>
                            <option value="15">Aluno</option>
                        </select>
                    </div>

                    <div class="my-2">
                        <label class="form-label" for="ativo">Status:</label>
                        <select class="form-select" name="ativo" id="ativo" required>
                            <option value="1">Ativo</option>
                            <option value="2">Inativo</option>
                        </select>
                    </div>
                    -->


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