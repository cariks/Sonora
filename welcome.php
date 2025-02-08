<?php
session_start();

// Если пользователь уже авторизован, перенаправляем на homepage.php
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {},
            },
        };

        // Default theme (dark)
        document.documentElement.classList.add('dark');
        localStorage.setItem('color-theme', 'dark');
    </script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav class="bg-white border-neutral-200 px-4 py-2.5 dark:bg-neutral-800">
        <div class="flex flex-wrap justify-between items-center  ">
            <a href="" class="flex items-center">
                <img src="assets/SonoraMainLogo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Sonora</span>
            </a>
            <div class="flex items-center lg:order-2">
                <a href="#" class="text-neutral-800 dark:text-white hover:bg-neutral-50 focus:ring-4 focus:ring-neutral-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-neutral-700 focus:outline-none dark:focus:ring-neutral-800">Log in</a>
                <a href="#" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get started</a>
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-neutral-500 rounded-lg lg:hidden hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-200 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:ring-neutral-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-neutral-700 border-b border-neutral-100 hover:bg-neutral-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-neutral-400 lg:dark:hover:text-white dark:hover:bg-neutral-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-neutral-700">Company</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-neutral-700 border-b border-neutral-100 hover:bg-neutral-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-neutral-400 lg:dark:hover:text-white dark:hover:bg-neutral-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-neutral-700">Marketplace</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-neutral-700 border-b border-neutral-100 hover:bg-neutral-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-neutral-400 lg:dark:hover:text-white dark:hover:bg-neutral-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-neutral-700">Features</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-neutral-700 border-b border-neutral-100 hover:bg-neutral-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-neutral-400 lg:dark:hover:text-white dark:hover:bg-neutral-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-neutral-700">Team</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-neutral-700 border-b border-neutral-100 hover:bg-neutral-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-neutral-400 lg:dark:hover:text-white dark:hover:bg-neutral-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-neutral-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<section class="bg-neutral-50 dark:bg-neutral-900 h-full flex flex-row">



<div id="default-carousel" class="relative w-[60%] m-6" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-full overflow-hidden rounded-lg">
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/admin.png" class="absolute block object-cover h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/admin.png" class="absolute block object-cover h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/admin.png" class="absolute block object-cover h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/admin.png" class="absolute block object-cover h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 5 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/admin.png" class="absolute block object-cover h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-neutral-800/30 group-hover:bg-white/50 dark:group-hover:bg-neutral-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-neutral-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-neutral-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-neutral-800/30 group-hover:bg-white/50 dark:group-hover:bg-neutral-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-neutral-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-neutral-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>


<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 w-[40%]">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-neutral-900 dark:text-white">
          <img class="w-8 h-8 mr-2" src="assets/SonoraMainLogo.svg" alt="logo">
          Sonora    
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-neutral-900 md:text-2xl dark:text-white">
                  Sign in to your account
              </h1>
              <?php
                    if(isset($_SESSION['error'])) {
                        echo '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-neutral-900 dark:text-red-400" role="alert">';
                        echo $_SESSION['error'];
                        echo '</div>';
                        unset($_SESSION['error']);
                    }
                ?>
              <form class="space-y-4 md:space-y-6" action="admin/database/login_function.php" method="POST">
                  <div>
                      <label for="lietotajs" class="block mb-2 text-sm font-medium text-neutral-900 dark:text-white">Lietotājvārds</label>
                      <input type="text" name="lietotajs" id="lietotajs" class="bg-neutral-50 border border-neutral-300 text-neutral-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="lietotājvārds" required>
                  </div>
                  <div>
                      <label for="parole" class="block mb-2 text-sm font-medium text-neutral-900 dark:text-white">Parole</label>
                      <input type="password" name="parole" id="parole" placeholder="••••••••" class="bg-neutral-50 border border-neutral-300 text-neutral-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <div class="flex items-center justify-between">
                      <div class="flex items-start">
                          <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-neutral-300 rounded bg-neutral-50 focus:ring-3 focus:ring-primary-300 dark:bg-neutral-700 dark:border-neutral-600 dark:focus:ring-primary-600 dark:ring-offset-neutral-800">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="remember" class="text-neutral-500 dark:text-neutral-300">Atcerēties mani</label>
                          </div>
                      </div>
                      <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Aizmirsāt paroli?</a>
                  </div>
                  <button type="submit" name="ielogoties" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">Ielogoties</button>
                  <p class="text-sm font-light text-neutral-500 dark:text-neutral-400">
                      Nav konta? <a href="register.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Reģistrēties</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>




</body>
