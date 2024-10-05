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

            // Buscando as saídas relacionadas ao usuário logado
            $result2 = mysqli_query($conn, "SELECT descricao, valor, data_entrada, categoria FROM entradas WHERE usuario_id = '$user_id'");
            if (!$result2) {
                echo "Erro ao buscar as entradas: " . mysqli_error($conn);
                exit();
            }

            // Processa os dados do formulário
            $descricao = $_POST['descricao'] ?? '';
            $preco = $_POST['preco'] ?? '';
            $data_entrada = $_POST['data_entrada'] ?? '';
            $categoria = $_POST['categoria'] ?? '';

            if (empty($descricao) || empty($preco) || empty($data_entrada) || empty($categoria)) {
                echo "Todos os campos devem ser preenchidos.";
                exit();
            }

            // Sanitizar os dados
            $descricao = mysqli_real_escape_string($conn, $descricao);
            $preco = mysqli_real_escape_string($conn, $preco);
            $preco = str_replace(',', '.', $preco); // Garantir formato correto do preço
            $data_entrada = mysqli_real_escape_string($conn, $data_entrada);
            $categoria = mysqli_real_escape_string($conn, $categoria);

            // Inserir no banco de dados
            $str_insert = "INSERT INTO entradas (descricao, valor, data_entrada, categoria, usuario_id) 
                           VALUES ('$descricao', '$preco', '$data_entrada', '$categoria', '$user_id')";

            $result_insert = mysqli_query($conn, $str_insert);

            if ($result_insert) {
                echo "<br />Nova entrada cadastrada com sucesso!";
            } else {
                echo "<br />Erro cadastrando entrada!";
                echo "<br />ERRO: " . mysqli_error($conn); // Exibir o erro retornado pelo SGBD
                echo "<br />ERRO n.: " . mysqli_errno($conn); // Exibir o número do erro retornado pelo SGBD
            }
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "<br />Você precisa estar logado para cadastrar uma entrada.";
    }
} else {
    echo "<br />Não foi possível realizar a conexão com o banco de dados!";
}
?>
