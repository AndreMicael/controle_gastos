<?php 

require_once("../config/con_bd.php");
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION["login"])) {
    // Verifica se o user_id está definido na sessão
    $user_id = $_SESSION['id_usuario'];

    // Verifica se a conexão com o banco de dados foi bem-sucedida
    if ($conn) {
        // Obtendo os dados do POST
        $descricao = $_POST['descricao'] ?? '';
        $preco = $_POST['preco'] ?? '';
        $data_entrada = $_POST['data_entrada'] ?? '';
        $categoria = $_POST['categoria'] ?? '';

        // Verificar se todos os campos estão preenchidos
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

        // Verifique se o user_id existe
        $result_user = mysqli_query($conn, "SELECT id FROM usuario WHERE id = '$user_id'");
        if (mysqli_num_rows($result_user) === 0) {
            echo "Erro: o ID do usuário não existe na tabela.";
            exit();
        }

        // Preparar a instrução SQL para inserção
        $stmt = $conn->prepare("INSERT INTO entradas (descricao, valor, data_entrada, categoria, usuario_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $descricao, $preco, $data_entrada, $categoria, $user_id);

        // Executar a inserção
        if ($stmt->execute()) {
            header("Location: ../entradas-usuario.php"); // Redireciona após a inserção
            exit();
        } else {
            echo "<br />Erro cadastrando entrada!";
            echo "<br />ERRO: " . $stmt->error; // Exibir o erro retornado pela execução da instrução
            die(); // Interrompe a execução
        }

        // Fechar a instrução
        $stmt->close();
    } else {
        echo "<br />Não foi possível realizar a conexão com o banco de dados!";
    }
} else {
    echo "Usuário não está logado.";
}
?>
