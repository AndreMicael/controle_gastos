<!-- Objetivo: Armazenar as entradas do usuário logado na sessão e redirecionar para a página de entradas do usuário.
-->

<?php
session_start();
require_once("../config/con_bd.php");

// Verifique se o usuário está logado
if (isset($_SESSION["login"])) {
    $username = $_SESSION["login"];

    // Inicializa a sessão
    $_SESSION['entradas'] = []; 

    // Obtendo o ID do usuário
    $result = mysqli_query($conn, "SELECT id FROM usuario WHERE username = '$username'");

    // Verifica se o usuário foi encontrado
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id']; // Obtém o ID do usuário
       
        // Buscando as entradas relacionadas ao usuario logado
        $result2 = mysqli_query($conn, "SELECT descricao, valor, data_transacao, categoria FROM entradas WHERE usuario_id = '$user_id'");

        // Armazenar todas as entradas na sessão
        while ($entrada = mysqli_fetch_assoc($result2)) {
            $_SESSION['entradas'][] = $entrada; // Adiciona cada entrada ao array da sessão
        }

        
        if (empty($_SESSION['entradas'])) {
            echo "Nenhuma entrada encontrada.";
        } else {
            echo "entradas armazenadas com sucesso!";
            // Redirecionar apenas se houver entradas
            header("Location: ../entradas-usuario.php");
            exit(); // Adiciona exit para garantir que o script pare após o redirecionamento
        }
        
    } else {
        echo "Usuário não encontrado.";
    }

    // Fechar a conexão
    mysqli_close($conn);
} else {
    echo "Você precisa estar logado para ver suas entradas.";
}
?>
