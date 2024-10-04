<?php
require_once("../config/con_bd.php");

// Verifique se os campos estão definidos
if (isset($_POST["login"], $_POST["entrar"])) {

    $login = $_POST["login"];
    $entrar = $_POST["entrar"];

    // Verifique a conexão
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Preparar a consulta para evitar SQL Injection
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE nome = ?");
    $stmt->bind_param("s", $login);  // "s" significa string

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows <= 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location.href='../login-usuario.html';</script>";
        die();
    } else {
        setcookie("login", $login);
        header("Location:../index.php");
        exit();
    }

    // Fechar a conexão
    $stmt->close();
    mysqli_close($conn);
}
?>


<!-- 
Referencia: https://www.devmedia.com.br/criando-um-sistema-de-cadastro-e-login-com-php-e-mysql/37213 -->