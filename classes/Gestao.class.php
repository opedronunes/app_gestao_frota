
<?php





class Gestao {
    
    function getColaborador(){
        
        require_once "../conexao/connection.php";

        $dados = $conexao->query("SELECT 
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
                                    ");

    }
    
}