<?php
require_once "Receitas.php";

$idConsulta = $_POST['idConsulta'];
$descricao = $_POST['descricao'];
$dataEmissao = $_POST['dataEmissao'];
$validade = $_POST['validade'];
$instrucoes = $_POST['instrucoes'];

$receita = new Receita($idConsulta, $descricao, $dataEmissao, $validade, $instrucoes);
try {
    echo $receita->emitir();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>