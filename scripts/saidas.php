<?php
session_start();
require_once("../config/con_bd.php");

// Verifique se o usuário está logado
if (isset($_SESSION["login"])) {
    $username = $_SESSION["login"];

    // Inicializa a sessão
    $_SESSION['saidas'] = []; 

    // Obtendo o ID do usuário
    $result = mysqli_query($conn, "SELECT id FROM usuario WHERE username = '$username'");

    // Verifica se o usuário foi encontrado
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id']; // Obtém o ID do usuário

        // Buscando as saídas relacionadas ao usuario logado
        $result2 = mysqli_query($conn, "SELECT descricao, valor, data_saida, categoria FROM saidas WHERE usuario_id = '$user_id'");

        // Armazenar todas as saídas na sessão
        while ($saida = mysqli_fetch_assoc($result2)) {
            $_SESSION['saidas'][] = $saida; // Adiciona cada saída ao array da sessão
        }

        if (empty($_SESSION['saidas'])) {
            echo "Nenhuma saída encontrada.";
        } else {
            echo "Saídas armazenadas com sucesso!";
            // Redirecionar apenas se houver saídas
            header("Location: ../saidas-usuario.php");
            exit(); // Adiciona exit para garantir que o script pare após o redirecionamento
        }
        
    } else {
        echo "Usuário não encontrado.";
    }

    // Fechar a conexão
    mysqli_close($conn);
} else {
    echo "Você precisa estar logado para ver suas saídas.";
}
?>
