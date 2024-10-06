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


if($tipo === 'entrada'){

    $data_entrada = $_POST['data_entrada'];

} elseif ($tipo === 'saida') {

    $data_entrada = $_POST['data_saida'];

} else {
    echo "Tipo de transação inválido.";
    exit();
}


$categoria = $_POST['categoria'];

// Sanitizar os dados
$descricao = mysqli_real_escape_string($conn, $descricao);
$valor = mysqli_real_escape_string($conn, $valor);
$data_entrada = mysqli_real_escape_string($conn, $data_entrada);
$categoria = mysqli_real_escape_string($conn, $categoria);

// Validação do ID
if (!is_numeric($id)) {
    echo "ID inválido.";
    exit();
}

// Atualizar o produto no banco de dados
if ($tipo === 'entrada') {
    $query = "UPDATE entradas 
              SET descricao = '$descricao', valor = '$valor', data_entrada = '$data_entrada', categoria = '$categoria'
              WHERE id = '$id'";
} elseif ($tipo === 'saida') {
    $query = "UPDATE saidas 
              SET descricao = '$descricao', valor = '$valor', data_saida = '$data_entrada', categoria = '$categoria'
              WHERE id = '$id'";
} else {
    echo "Tipo de transação inválido.";
    exit();
}

if (mysqli_query($conn, $query)) {
    header("Location: ../balanco.php");
    exit();
} else {
    echo "Erro ao atualizar produto: " . mysqli_error($conn);
    echo "Query: $query"; // Adicione esta linha para depuração
}
?>
