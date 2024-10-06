
    <?php 
    
    session_start(); // Inicie a sessão
    $_SESSION['login'];
    echo '<link rel="stylesheet" type="text/css" href="components/navbar.css">';
    if (isset($_SESSION['login'])) {
        echo <<<EOD
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="criar-transacao.php">Criar Transação</a></li>  
                <li><a href="entradas-usuario.php">Entradas</a></li>
                 <li><a href="saidas-usuario.php">Saídas</a></li>
                <li><a href="balanco.php">Balanço</a></li>
                <li><a href="home.html">Sair</a></li>
            </ul>
        </nav> 
    EOD;
    } else {
        echo "Você não está logado!";
    }
    
    
    ?>
