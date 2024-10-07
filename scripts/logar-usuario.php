<?php
session_start(); // Inicia a sessão para armazenar o nome do usuário e o ID do usuário após o login
require_once "../config/con_bd.php"; // Inclui o script de conexão ao BD

// Verifique se os campos login, senha e entrar estão definidos
if (isset($_POST["login"], $_POST["entrar"], $_POST["senha"])) {
    $login = $_POST["login"];
    $entrar = $_POST["entrar"];
    $senha = $_POST["senha"];

    // Verifica se existe uma conexão com o banco de dados
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Preparar a consulta para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuario WHERE username = ?");
    $stmt->bind_param("s", $login); 

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows <= 0) {
        echo "<script>alert('Login incorreto'); window.location.href='../login-usuario.php';</script>"; 
        exit(); // Use exit após redirecionar
    } else {
        // Se o usuário foi encontrado, pega o nome, a senha e o ID do usuário
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $senhaBD = $row["senha"];
        $userId = $row["id"]; 

        // Verifique se a senha está correta
        if ($senha === $senhaBD) {           
            // Armazena o nome, login e user_id na sessão
            $_SESSION["login"] = $login;
            $_SESSION["nome"] = $nome;
            $_SESSION["user_id"] = $userId; 

            // Redireciona o usuário para a página inicial do site
            header("Location:../home.php");
            exit();
        } else {
            // Se a senha estiver incorreta
            echo "<script>alert('Senha incorreta'); window.location.href='../login-usuario.php';</script>"; 
            exit();
        }
    }

    // Fechar a conexão
    $stmt->close();
    mysqli_close($conn);
} else {
    // Redireciona se não foram enviados dados pelo formulário
    header("Location:../login-usuario.php");
    exit();
}
?>
