<?php
require_once "Conexao.php";
class Receita
{
    private $id;
    private $idConsulta;
    private $descricao;
    private $dataEmissao;
    private $validade;
    private $instrucoes;

    public function __construct($idConsulta, $descricao, $dataEmissao, $validade, $instrucoes)
    {
        $this->idConsulta = $idConsulta;
        $this->descricao = $descricao;
        $this->dataEmissao = $dataEmissao;
        $this->validade = $validade;
        $this->instrucoes = $instrucoes;
    }

    public function emitir()
    {
        $conectar = Conexao::getConexao();
        if (!$conectar) {
            throw new Exception("Não foi possível conectar ao banco de dados.");
        }

        $sql = "INSERT INTO receitas (id_consulta, descricao, data_emissao, validade, instrucoes) 
    VALUES (?, ?, ?, ?, ?)";
        $comando = $conectar->prepare($sql);
        $comando->execute([$this->idConsulta, $this->descricao, $this->dataEmissao, $this->validade, $this->instrucoes]);
        if ($comando->rowCount() > 0) {
            return "Receita emitida com sucesso.";
        } else {
            return "Erro ao emitir receita.";
        }
    }

    public function excluir($id)
    {
        $conectar = Conexao::getConexao();
        if (!$conectar) {
            throw new Exception("Não foi possível conectar ao banco de dados.");
        }
        $sql = "DELETE FROM receitas WHERE id=?";
        $comando = $conectar->prepare($sql);
        $comando->execute([$id]);
        if ($comando->rowCount() > 0) {
            return "Receita excluída com sucesso.";
        } else {
            return "Erro ao excluir receita.";
        }
    }

    public function listar()
    {
        $conectar = Conexao::getConexao();
        if (!$conectar) {
            throw new Exception("Não foi possível conectar ao banco de dados.");
        }

        $sql = "SELECT * FROM receitas";
        $comando = $conectar->prepare($sql);
        $comando->execute();
        return $comando->fetchAll(PDO::FETCH_ASSOC);

    }

    public function buscarPorId($id)
    {
        $conectar = Conexao::getConexao();
        if (!$conectar) {
            throw new Exception("Não foi possível conectar ao banco de dados.");
        }
        $sql = "SELECT * FROM receitas WHERE id=?";
        $comando = $conectar->prepare($sql);
        $comando->execute([$id]);
        return $comando->fetch(PDO::FETCH_ASSOC);

    }

    public function atualizar($id)
    {
        $conectar = Conexao::getConexao();
        if (!$conectar) {
            throw new Exception("Não foi possível conectar ao banco de dados.");
        }

        $sql = "UPDATE receitas SET id_consulta=?, descricao=?, data_emissao=?, validade=?, instrucoes=? WHERE id=?";
        $comando = $conectar->prepare($sql);
        $comando->execute([$this->idConsulta, $this->descricao, $this->dataEmissao, $this->validade, $this->instrucoes, $id]);
        if ($comando->rowCount() > 0) {
            return "Receita atualizada com sucesso.";
        } else {
            return "Erro ao atualizar receita.";
        }
    }
}
?>