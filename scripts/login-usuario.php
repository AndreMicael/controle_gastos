<?php
session_start();
require_once("../config/con_bd.php");

// Verifique se os campos estão definidos
if (isset($_POST["login"], $_POST["entrar"], $_POST["senha"])) {

    $login = $_POST["login"];
    $entrar = $_POST["entrar"];
    $senha = $_POST["senha"];

    // Verifique a conexão
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Preparar a consulta para evitar SQL Injection
    $stmt = $conn->prepare("SELECT nome, senha FROM usuario WHERE username = ?");
    $stmt->bind_param("s", $login);  // "s" significa string

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows <= 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Login incorreto');window.location.href='../login-usuario.html';</script>";
        die();
    } else {
        $row = $result->fetch_assoc();
        $nome = $row['nome']; // Pega o nome do banco de dados
        $senhaBD = $row['senha']; // Pega a senha do banco de dados

        // Verifique se a senha está correta
        if ($senha === $senhaBD) { // Troque essa linha se estiver usando hash
            // Armazena o nome e o login na sessão
            $_SESSION["login"] = $login;
            $_SESSION["nome"] = $nome; // Armazena o nome do usuário na sessão
            
            header("Location:../index.php");
            exit();
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Senha incorreta');window.location.href='../login-usuario.html';</script>";
            die();
        }
    }

    // Fechar a conexão
    $stmt->close();
    mysqli_close($conn);
}
?>
