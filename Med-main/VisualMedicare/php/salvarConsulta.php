<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "Conexao.php";

$idMedico = $_POST['idMedico'];
$idPaciente = $_POST['idPaciente'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];
$status = $_POST['status'];
$sala = $_POST['sala'];
$motivo = $_POST['motivo'];

$consulta = new Consulta($idMedico, $idPaciente, $inicio, $fim, $status, $sala, $motivo);

try {
    $consulta->marcar();
    echo "Consulta marcada com sucesso.";
} catch (Exception $e) {
    echo "Erro ao marcar consulta: " . $e->getMessage();
}
?>