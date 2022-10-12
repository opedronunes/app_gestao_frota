<?php

class ColaboradorService{
    private $conexao;
    private $colaborador;

    public function __construct(Conexao $conexao, Colaborador $colaborador)
    {
        $this->conexao = $conexao->conectar();
        $this->colaborador = $colaborador;
    }

    public function inserir(){
        $query = "INSERT INTO tb_colaborador(nu_cpf_colaborador, no_colaborador, dt_nascimento, dt_admissao, no_funcao, vl_salario, id_status)
                    VALUES(:cpf, :nome, :nascimento, :admissao, :funcao, :salario, :status)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':cpf', $this->colaborador->__get('nu_cpf_colaborador'));
        $stmt->bindValue(':nome', $this->colaborador->__get('no_colaborador'));
        $stmt->bindValue(':nascimento', $this->colaborador->__get('dt_nascimento'));
        $stmt->bindValue(':admissao', $this->colaborador->__get('dt_admissao'));
        $stmt->bindValue(':funcao', $this->colaborador->__get('no_funcao'));
        $stmt->bindValue(':salario', $this->colaborador->__get('vl_salario'));
        $stmt->bindValue(':status', $this->colaborador->__get('id_status'));
        $stmt->execute();
    }

    public function recuperar(){
        $query = "SELECT 
                    c.id_colaborador,
                    c.nu_cpf_colaborador,
                    c.no_colaborador,
                    c.dt_nascimento,
                    c.dt_admissao,
                    c.no_funcao,
                    c.vl_salario,
                    c.dt_cadastro,
                    s.no_status
                    FROM tb_colaborador as c
                    INNER JOIN tb_status as s
                    ON
                    c.id_status = s.id_status
                    ORDER BY no_colaborador;
                ";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function atualizar(){
        $query = "UPDATE tb_colaborador SET nu_cpf_colaborador = ?, no_colaborador = ?, dt_nascimento = ?, dt_admissao = ?, no_funcao = ?, vl_salario = ?, id_status = ? WHERE id_colaborador = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt-> bindValue(1, $this->colaborador->__get('nu_cpf_colaborador'));
        $stmt-> bindValue(2, $this->colaborador->__get('no_colaborador'));
        $stmt-> bindValue(3, $this->colaborador->__get('dt_nascimento'));
        $stmt-> bindValue(4, $this->colaborador->__get('dt_admissao'));
        $stmt-> bindValue(5, $this->colaborador->__get('no_funcao'));
        $stmt-> bindValue(6, $this->colaborador->__get('vl_salario'));
        $stmt-> bindValue(7, $this->colaborador->__get('id_status'));
        $stmt-> bindValue(8, $this->colaborador->__get('id_colaborador'));
        
        return $stmt->execute();
    }

    public function editar(){
        
    }

    public function remover(){
        $query = "DELETE FROM tb_colaborador WHERE id_colaborador = :id_colaborador";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id_colaborador', $this->colaborador->__get('id_colaborador'));
        $stmt->execute();
    }

    public function recuperarPorId(){
        $query = "SELECT * FROM tb_colaborador WHERE id_colaborador = :id_colaborador LIMIT 1";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id_colaborador', $this->colaborador->__get('id_colaborador'));
        $stmt->execute();
        $colaboradorId = $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function recuperarTodosColaboradores(){
        $query = "SELECT * FROM tb_colaborador WHERE id_colaborador = :id_colaborador";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue('id_colaborador', $this->colaborador->__get('id_colaborador'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}