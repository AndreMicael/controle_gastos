<?php 
session_start();
require_once("../config/con_bd.php");

if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit(); // Adicionado exit() para garantir que o script pare após redirecionar
}

$id_transacao = $_POST['id'];
$tipo_transacao = $_POST['tipo']; // Recebe o tipo da transação (entrada ou saída)
$pagina_origem = $_POST['pagina_origem'];  // Recebe a página de origem (entradas ou saídas)

// Sanitizar os dados
$id_transacao = mysqli_real_escape_string($conn, $id_transacao);
$tipo_transacao = mysqli_real_escape_string($conn, $tipo_transacao);

// Verificar o tipo de transação e deletar da tabela correspondente
if ($tipo_transacao === 'entrada') {
    // Deletar da tabela 'entradas'
    $delete_entrada = mysqli_query($conn, "DELETE FROM entradas WHERE id = '$id_transacao'");
    if ($delete_entrada) {
        if($pagina_origem === 'entradas') {
            header("Location: ../entradas-usuario.php"); // Redireciona para a página de entradas
        } else {
            header("Location: ../index.php"); // Redireciona para a página inicial
        }      
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
       if($pagina_origem === 'saidas') {
        header("Location: ../saidas-usuario.php"); // Redireciona para a página de saídas
       }else {
        header("Location: ../index.php"); // Redireciona para a página inicial
       } // Redireciona em caso de sucesso
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
