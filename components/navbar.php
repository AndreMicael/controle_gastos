    <?php 
    session_start(); // Inicie a sessão
    require_once("config/error.php");
    $cash = file_get_contents('components/cash.svg');

    // echo '<link rel="stylesheet" type="text/css" href="style.css">';
    echo '<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />';
    echo '<link rel="icon" type="image/x-icon" href="components/favicon.ico">';
    echo '<style>';   
    echo "@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');";
    echo '</style>';
    echo '<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>';

   
        echo <<<EOD
      

        
            <nav class="bg-blue-800 dark:bg-gray-900 text-white z-20 ">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                        $cash
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Finans</span>
                    </a>
                    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <a href='login-usuario.php'>
                            <button type="button" class="text-white mt-4 hover:text-red-500 bg-red-500 hover:bg-blue-800 border-2 border-red-500 hover:border-2 hover:border-white focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Login</button>
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
                           
                            
                            
                        </ul>
                    </div>
                </div>
            </nav>

    EOD;

    
    
    ?>



 