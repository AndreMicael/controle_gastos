
<!-- Objetivo: Cadastrar uma transação (entrada ou saída) no banco de dados
Quando o usuário preenche o formulário
na página criar-transacao.php e clica no botão "Adicionar nova transação", ele é redirecionado para
a página cadastro-transacao.php. Nesta página, os dados do formulário são processados e inseridos no banco de dados.

Fluxo de cadastro de transação: criar-transacao.php -> cadastro-transacao.php -> index.php -->

<?php
session_start(); // Certifique-se de iniciar a sessão

require_once "../config/con_bd.php"; // Inclui o script de conexão ao BD

// Verifica se a conexão com o banco de dados foi estabelecida
if ($conn) {
    // Verifica se o usuário está logado
    if (isset($_SESSION["login"])) {
        // Obtendo o nome de usuário da sessão
        $username = $_SESSION["login"];

        // Obtendo o ID do usuário
        $result = mysqli_query(
            $conn,
            "SELECT id FROM usuario WHERE username = '$username'"
        );

        // Verifica se o usuário foi encontrado
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result); // Obtém a row do resultado
            $user_id = $row["id"]; // Obtém o ID do usuário

            // Processa os dados do formulário
            $descricao = $_POST["descricao"] ?? "";
            $tipo = $_POST["tipo"] ?? "";
            $preco = $_POST["preco"] ?? "";
            $categoria = $_POST["categoria"] ?? "";
            $data_transacao = $_POST["data_transacao"] ?? "";

            // Verifica o tipo da transação e busca os dados
            if ($tipo === "entrada") {
                // 
                $result2 = mysqli_query(
                    $conn,
                    "SELECT descricao, valor, data_transacao, categoria FROM entradas WHERE usuario_id = '$user_id'"
                );
            } elseif ($tipo === "saida") {
                $result2 = mysqli_query(
                    $conn,
                    "SELECT descricao, valor, data_transacao, categoria FROM saidas WHERE usuario_id = '$user_id'"
                );
            } else {
                echo "Tipo de transação inválido.";
                exit();
            }

            // Sanitizar os dados
            $descricao = mysqli_real_escape_string($conn, $descricao);

            // **Aqui fazemos a conversão do valor do preço**
            $preco = str_replace(",", ".", $preco); // Substitui a vírgula por ponto para valores decimais
            $preco = mysqli_real_escape_string($conn, $preco);

            $data_transacao = mysqli_real_escape_string($conn, $data_transacao);
            $categoria = mysqli_real_escape_string($conn, $categoria);

            // Inserir no banco de dados
            if ($tipo === "entrada") {
                $str_insert = "INSERT INTO entradas (descricao, valor, data_transacao, categoria, usuario_id) 
                               VALUES ('$descricao', '$preco', '$data_transacao', '$categoria', '$user_id')";
            } elseif ($tipo === "saida") {
                $str_insert = "INSERT INTO saidas (descricao, valor, data_transacao, categoria, usuario_id) 
                               VALUES ('$descricao', '$preco', '$data_transacao', '$categoria', '$user_id')";
            }

            // Execute a inserção e verifique o resultado
            if (mysqli_query($conn, $str_insert)) {

                if($tipo === "entrada") {
                    header("Location: ../entradas-usuario.php"); // Redireciona para a página de entradas
                } else if($tipo === "saida") {
                    header("Location: ../saidas-usuario.php"); // Redireciona para a página de saídas
                } else {
                    header("Location: ../index.php"); // Redireciona para a página inicial
                }              
                exit(); // Adicionei exit() após o redirecionamento
            } else {
                echo "<br />Erro cadastrando: " . mysqli_error($conn); // Exibir o erro retornado pelo SGBD
            }
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "<br />Você precisa estar logado para cadastrar uma transação.";
    }
} else {
    echo "<br />Não foi possível realizar a conexão com o banco de dados!";
}
?>
