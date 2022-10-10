<?php

class Colaborador{
    private $id_colaborador;
    private $no_colaborador;
    private $nu_cpf_colaborador;
    private $dt_nascimento;
    private $dt_admissao;
    private $no_funcao;
    private $vl_salario;
    private $dt_cadastro;
    private $id_status;
    private $colaborador;

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