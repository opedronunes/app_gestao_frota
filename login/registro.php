<?php

require_once '../conexao/connection.php';
require_once './LoginService.php';

if (isset($_POST['nome']) && $_POST['cpf']) {
    
    $dados = [
        'no_usuario' => $_POST['nome'],
        'nu_cpf_usuario' => $_POST['cpf'],
        'email_usuario' => $_POST['email'],
        'senha_usuario' => $_POST['senha'],
        'id_perfil' => $_POST['perfil'],
        'id_status' => $_POST['status'],
    ];
    try {
        inserirUsuario($conexao, $dados);
        echo "<script>alert('Usuário inserido com sucesso!')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Ocorreu um erro ao inserir o usuário, tente novamente mais tarde!')</script>";
        echo '<script>alert("'.$e->getMessage().' Codigo erro: '.$e->getCode().'")</script>';
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
    <title>Cadastro</title>
</head>
    <body>
        <div class="wrapper container">
            <div class="container-login">
                <h2>Cadastro</h2>
                <p>Por favor, preencha este formulário para criar uma conta.</p>
                <form action="./registro.php" method="post">
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
                        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div> 
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                        <span class="invalid-feedback"><?php echo $senha_err; ?></span>
                    </div>
                    <!--
                    <div class="form-group">
                        <label>Confirme a senha</label>
                        <input type="password" name="confirm_senha" class="form-control <?php echo (!empty($confirm_senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_senha; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_senha_err; ?></span>
                    </div>
                    -->
                    
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