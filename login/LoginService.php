<?php

class LoginService {

    private $conexao;
    private $usuario;

    public function __construct(Conexao $conexao, $usuario)
    {
        $this->conexao = $conexao->conectar();
        $this->usuario = $usuario;
    }

}


?>