<?php 
    require_once("config/con_bd.php");
    include('components/navbar-login.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php




$nome_session = $_SESSION["nome"];


    if(isset($nome_session)){
      echo"Bem-Vindo, $nome_session <br>";
      echo"Essas informações PODEM ser acessadas por você";

      ?>
      <a href='scripts/entradas.php'>Entradas</a>     
      <a href='scripts/saidas.php'>Saídas</a>
      <a href='criar-saida.php'>Criar Nova Transação</a>
      <a href='balanco.php'>Balanço Geral</a>
      
      <?php

    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"Essas informações NÃO PODEM ser acessadas por você";

    

    }
?>
</body>
</html>