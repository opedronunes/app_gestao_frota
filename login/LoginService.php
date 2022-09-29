<?php

function inserirUsuario($conexao, $dados) {
    
    try {
        
        $query = "INSERT INTO tb_usuario (no_usuario, nu_cpf_usuario, email_usuario, senha_usuario, id_perfil, id_status) VALUES (:no_usuario, :nu_cpf_usuario, :email_usuario, :senha_usuario, :id_perfil, :id_status)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':no_usuario', $dados['no_usuario']);
        $stmt->bindParam(':nu_cpf_usuario', $dados['nu_cpf_usuario']);
        $stmt->bindParam(':email_usuario', $dados['email_usuario']);
        $stmt->bindParam(':senha_usuario', $dados['senha_usuario']);
        $stmt->bindParam(':id_perfil', $dados['id_perfil']);
        $stmt->bindParam(':id_status', $dados['id_status']);

        return $stmt->execute();

        
    } catch (\Throwable $e) {
        var_dump($e->getMessage());
    }
}





/*
class LoginService {

    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao->conectar();
    }

    public function inserir() {
        $query = "INSERT INTO tb_usuario (no_usuario, nu_cpf_usuario, email_usuario, senha_usuario, id_perfil, id_status) VALUES (:no_usuario, :nu_cpf_usuario, :email_usuario :senha_usuario, :id_perfil, :id_status)";
        $stmt = $this->conexao->prepare($query);
        
        $stmt->bindParm(':no_usuario');
        $stmt->execute();
    }

}
*/

?>