<?php

class Usuario {

    private $id_usuario;
    private $no_usuario;
    private $nu_cpf_usuario;
    private $email_usuario;
    private $senha_usuario;
    private $id_perfil;
    private $id_status;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
        return $this;
    }

}

?>