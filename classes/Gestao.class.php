
<?php





class Gestao {


    
    public function getColaborador(){
        
        require_once "../conexao/connection.php";

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
            $dados = $conexao->prepare($query);
            $dados->execute();

             return $dados->fetchAll(PDO::FETCH_OBJ);

    }

    public function addColaborador(){
        require_once "../conexao/connection.php";
        $this->dt_nascimento = date('Y-m-d');
        $this->dt_admissao = date('Y-m-d');
        $this->dt_cadastro = date('Y-m-d H:i:s');

        $query = 'INSERT INTO tb_colaborador()VALUES()';
        

    }
    
}