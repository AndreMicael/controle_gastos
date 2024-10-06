<?php 
  $cash = file_get_contents('components/cash.svg');

  echo <<<HTML
  
  <footer class="bg-white   dark:bg-gray-900  ">
      <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
          <div class="sm:flex sm:items-center sm:justify-between">
              <div   class="flex items-center space-x-3 rtl:space-x-reverse">
                  $cash
                  <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Finans</span>
                </div>
              
          </div>
          <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
          <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 Finans. Todos os direitos reservados.</span>
      </div>
  </footer>
  HTML;
?>
