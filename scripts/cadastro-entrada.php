<?php
session_start(); // Certifique-se de iniciar a sessão

require_once("../config/con_bd.php");

if ($conn) {
    // Verifica se o usuário está logado
    if (isset($_SESSION["login"])) {
        $username = $_SESSION["login"];
        
        // Obtendo o ID do usuário
        $result = mysqli_query($conn, "SELECT id FROM usuario WHERE username = '$username'");

        // Verifica se o usuário foi encontrado
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id']; // Obtém o ID do usuário

            // Processa os dados do formulário
            $descricao = $_POST['descricao'] ?? '';
            $preco = $_POST['preco'] ?? '';
            $data = $_POST['data_entrada'] ?? '';
            $categoria = $_POST['categoria'] ?? '';
            $tipo = $_POST['tipo'] ?? '';

            if ($tipo === 'entrada') {
                // A data de entrada já é atribuída antes
                $result2 = mysqli_query($conn, "SELECT descricao, valor, data_entrada, categoria FROM entradas WHERE usuario_id = '$user_id'");
                if (!$result2) {
                    echo "Erro ao buscar as entradas: " . mysqli_error($conn);
                    exit();
                }
            } elseif ($tipo === 'saida') {
                $data = $_POST['data_saida'] ?? ''; // Corrigido para pegar a data de saída
                $result2 = mysqli_query($conn, "SELECT descricao, valor, data_saida, categoria FROM saidas WHERE usuario_id = '$user_id'");
                if (!$result2) {
                    echo "Erro ao buscar as saídas: " . mysqli_error($conn);
                    exit();
                }
            } else { 
                echo "Tipo de transação inválido.";
                exit();
            }

            // Validação dos campos
            if (empty($descricao) || empty($preco) || empty($data) || empty($categoria)) {
                echo "Todos os campos devem ser preenchidos.";
                exit();
            }

            // Sanitizar os dados
            $descricao = mysqli_real_escape_string($conn, $descricao);
            $preco = mysqli_real_escape_string($conn, str_replace(',', '.', $preco)); // Garantir formato correto do preço
            $data = mysqli_real_escape_string($conn, $data);
            $categoria = mysqli_real_escape_string($conn, $categoria);

            // Inserir no banco de dados
            if ($tipo === 'entrada') {
                $str_insert = "INSERT INTO entradas (descricao, valor, data_entrada, categoria, usuario_id) 
                               VALUES ('$descricao', '$preco', '$data', '$categoria', '$user_id')";
            } elseif ($tipo === 'saida') {
                $str_insert = "INSERT INTO saidas (descricao, valor, data_saida, categoria, usuario_id) 
                               VALUES ('$descricao', '$preco', '$data', '$categoria', '$user_id')";
            }

            // Execute a inserção e verifique o resultado
            if (mysqli_query($conn, $str_insert)) {
                header("Location: ../balanco.php");
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
