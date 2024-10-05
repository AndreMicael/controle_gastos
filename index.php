<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

session_start(); // Inicie a sessão

$nome_session = $_SESSION["nome"];


    if(isset($nome_session)){
      echo"Bem-Vindo, $nome_session <br>";
      echo"Essas informações PODEM ser acessadas por você";

      ?>
      <a href='scripts/entradas.php'>Entradas</a>
      <a href='criar-entrada.php'>Criar entrada</a>
      <a href='scripts/saidas.php'>Saídas</a>
      
      <?php

    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"Essas informações NÃO PODEM ser acessadas por você";

    

    }
?>
</body>
</html>