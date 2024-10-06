<?php 
session_start();
require_once("../config/con_bd.php");

if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit(); // Adicionado exit() para garantir que o script pare após redirecionar
}

$id_transacao = $_POST['id'];
$tipo_transacao = $_POST['tipo']; // Recebe o tipo da transação (entrada ou saída)

// Sanitizar os dados
$id_transacao = mysqli_real_escape_string($conn, $id_transacao);
$tipo_transacao = mysqli_real_escape_string($conn, $tipo_transacao);

// Verificar o tipo de transação e deletar da tabela correspondente
if ($tipo_transacao === 'entrada') {
    // Deletar da tabela 'entradas'
    $delete_entrada = mysqli_query($conn, "DELETE FROM entradas WHERE id = '$id_transacao'");
    if ($delete_entrada) {
        header("Location: ../balanco.php"); // Redireciona em caso de sucesso
        exit();
    } else {
        echo "<br />Erro ao excluir entrada";
        echo "<br />ERRO: " . mysqli_error($conn);
        echo "<br />ERRO n.: " . mysqli_errno($conn);
        exit();
    }
} elseif ($tipo_transacao === 'saida') {
    // Deletar da tabela 'saidas'
    $delete_saida = mysqli_query($conn, "DELETE FROM saidas WHERE id = '$id_transacao'");
    if ($delete_saida) {
        header("Location: ../balanco.php"); // Redireciona em caso de sucesso
        exit();
    } else {
        echo "<br />Erro ao excluir saída";
        echo "<br />ERRO: " . mysqli_error($conn);
        echo "<br />ERRO n.: " . mysqli_errno($conn);
        exit();
    }
} else {
    // Se o tipo da transação for inválido
    echo "Tipo de transação inválido.";
    exit();
}
?>
