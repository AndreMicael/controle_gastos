<?php
require_once("../config/con_bd.php");
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

$id = $_POST['id'];
$tipo = $_POST['tipo'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data_transacao = $_POST['data_transacao'];


 

$categoria = $_POST['categoria'];

// Sanitizar os dados
$descricao = mysqli_real_escape_string($conn, $descricao);
$valor = mysqli_real_escape_string($conn, $valor);
$data_transacao = mysqli_real_escape_string($conn, $data_transacao);
$categoria = mysqli_real_escape_string($conn, $categoria);

// Validação do ID
if (!is_numeric($id)) {
    echo "ID inválido.";
    exit();
}

// Atualizar o produto no banco de dados
if ($tipo === 'entrada') {
    $query = "UPDATE entradas 
              SET descricao = '$descricao', valor = '$valor', data_transacao = '$data_transacao', categoria = '$categoria'
              WHERE id = '$id'";
} elseif ($tipo === 'saida') {
    $query = "UPDATE saidas 
              SET descricao = '$descricao', valor = '$valor', data_transacao = '$data_transacao', categoria = '$categoria'
              WHERE id = '$id'";
} else {
    echo "Tipo de transação inválido.";
    exit();
}

if (mysqli_query($conn, $query)) {
    header("Location: ../index.php");
    exit();
} else {
    echo "Erro ao atualizar produto: " . mysqli_error($conn);
    echo "Query: $query"; // Adicione esta linha para depuração
}
?>
