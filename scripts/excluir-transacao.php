<!-- Objetivo: Excluir uma transação (entrada ou saída) do banco de dados
Quando o usuário clica no botão "Excluir" na página de entradas ou saídas, ele é redirecionado para a página excluir-transacao.php
Nesta página, a transação é excluída do banco de dados.
Final do fluxo botão excluir -> excluir-transacao.php -> página de origem -->

<?php 
session_start(); // Inicia a sessão
require_once("../config/con_bd.php"); // Inclui o script de conexão ao BD

// Verificar se o usuário está logado
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit();     
}

// Recebe os dados da requisição POST
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
        // Verificar que página apertou o botão excluir
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
        // Verificar que página apertou o botão excluir
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
