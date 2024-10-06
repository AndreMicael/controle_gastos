
    <?php 
    
    session_start(); // Inicie a sessão
    $_SESSION['login'];
    $cash = file_get_contents('components/cash.svg');

    echo '<link rel="stylesheet" type="text/css" href="components/navbar.css">';
    echo '<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />';
  
    echo '<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>';
    if (isset($_SESSION['login'])) {
        echo <<<EOD
      

        
            <nav class="bg-blue-800 dark:bg-gray-900 text-white z-20 border-b border-gray-200 dark:border-gray-600">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                        $cash
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Finans</span>
                    </a>
                    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <a href='scripts/sair.php'>
                            <button type="button" class="text-white bg-transparent hover:bg-blue-900 border border-2 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sair</button>
                        </a>
                        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                            <span class="sr-only">Abrir menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                            </svg>
                        </button>
                    </div>
                    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                        <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:border-gray-700">
                            <li class='hover:bg-blue-900 px-2 rounded-lg'>
                                <a href="index.php" class="block py-2 px-3 text-white hover:text-red-500 bg-transparent rounded md:bg-transparent md:p-0">Início</a>
                            </li>
                            <li class='hover:bg-blue-900 px-2 rounded-lg'>
                                <a href="criar-transacao.php" class="block py-2 px-3 text-white hover:text-red-500 rounded hover:bg-transparent md:p-0 dark:hover:text-red-500 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Criar Transação</a>
                            </li>
                            <li class='hover:bg-blue-900 px-2 rounded-lg'>
                                <a href="entradas-usuario.php" class="block py-2 px-3 text-white hover:text-red-500 rounded hover:bg-transparent md:p-0 dark:hover:text-red-500 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Entradas</a>
                            </li>
                            <li class='hover:bg-blue-900 px-2 rounded-lg'>
                                <a href="saidas-usuario.php" class="block py-2 px-3 text-white hover:text-red-500 rounded hover:bg-transparent md:p-0 dark:hover:text-red-500 dark:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Saídas</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </nav>

    EOD;
    } else {
        echo "Você não está logado!";
    }
    
    
    ?>



 