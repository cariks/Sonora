<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'admin/database/con_db.php';
require 'admin/database/get_user_data.php';

// Lietotāja datu iegūšana
$userData = getUserData($savienojums, $_SESSION['user_id']);
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

        // Ievieto tēmu no sesijas
        const userTheme = '<?php echo $_SESSION["theme"] ?? "light"; ?>';

        if (userTheme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem('color-theme', userTheme);
    </script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <!--
        Main colors:
            background: neutral-950
                        neutral-900
                        neutral-800
            main:       green-800
                        red-400
            white:
                        neutral-50
    -->
</head>
<body>
    <div class=" grid grid-cols-[17%_83%] h-screen bg-white dark:bg-neutral-900">
    <!-- Sidebar -->
    <aside class="w-full h-full bg-neutral-100 border-r dark:bg-neutral-950 dark:border-none">
        <div class="h-full px-6 py-6">
            <!-- Logo -->
            <div class="flex items-center mb-8">
                <img src="assets/SonoraMainLogo.svg" class="h-8 mr-3" alt="Logo" />
                <span class="text-2xl font-semibold dark:text-white">Sonora</span>
            </div>
            
            <!-- Menu -->
            <nav class="h-[93%] flex flex-col justify-between">
                <ul class="space-y-2">
                    <li>
                        <a href="#" id="homepage-btn" class="flex items-center p-2 text-neutral-900 rounded-lg dark:text-neutral-50 hover:underline hover:bg-neutral-100 dark:hover:bg-neutral-950">
                            <svg class="w-6 h-6 text-neutral-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                            </svg>

                            <span class="ml-3">Mājaslapa</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-neutral-900 rounded-lg dark:text-neutral-50 hover:underline hover:bg-neutral-100 dark:hover:bg-neutral-950">
                            <svg class="w-6 h-6 text-neutral-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                            </svg>

                            <span class="ml-3">Iemīļotās dziesmas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-neutral-900 rounded-lg dark:text-neutral-50 hover:underline hover:bg-neutral-100 dark:hover:bg-neutral-950">
                            <svg class="w-6 h-6 text-neutral-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11H4m15.5 5a.5.5 0 0 0 .5-.5V8a1 1 0 0 0-1-1h-3.75a1 1 0 0 1-.829-.44l-1.436-2.12a1 1 0 0 0-.828-.44H8a1 1 0 0 0-1 1M4 9v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-3.75a1 1 0 0 1-.829-.44L9.985 8.44A1 1 0 0 0 9.157 8H5a1 1 0 0 0-1 1Z"/>
                            </svg>

                            <span class="ml-3">Dziesmu saraksti</span>
                        </a>
                    </li>
                </ul>

                <a href="#" id="settings-btn" class="flex items-center p-2 text-neutral-900 rounded-lg dark:text-neutral-50 hover:underline hover:bg-neutral-100 dark:hover:bg-neutral-950">
                    <svg class="w-6 h-6 text-neutral-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>

                    <span class="ml-3">Iestatījumi</span>
                </a>
            </nav>
        </div>
    </aside>

   

    <!-- Main Content -->
    <div class="grid grid-rows-[8%_92%] h-full">
        <header class="w-full bg-white px-6 py-4 flex flex-row justify-between border-b dark:bg-neutral-900 dark:border-none">
            
            <!-- Search -->
            <div class="flex items-center">
                <form class="w-[500px]">   
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-neutral-500 dark:text-neutral-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-3 ps-10 text-sm text-neutral-900 border border-neutral-300 rounded-lg bg-neutral-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Meklēt" required />
                    </div>
                </form>
            </div>

            <!-- User icon -->
            <div class="flex items-center">
                <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="relative w-10 h-10 overflow-hidden bg-neutral-100 rounded-full dark:bg-neutral-600 cursor-pointer">
                    <?php if ($userData && $userData['profile_picture']): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($userData['profile_picture']); ?>" 
                             alt="User profile" 
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <svg class="absolute w-12 h-12 text-neutral-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    <?php endif; ?>
                </div>

                <!-- Dropdown menu -->
                <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-neutral-800 dark:divide-neutral-700">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-neutral-50">
                        <div><?php echo htmlspecialchars($userData['username'] ?? 'User'); ?></div>
                        <div class="font-medium truncate"><?php echo htmlspecialchars($userData['email'] ?? 'No email'); ?></div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-neutral-200" aria-labelledby="avatarButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-700 dark:hover:text-neutral-50">Dashboard</a>
                        </li>
                        <li>
                            <a href="#" id="settings-btn-1" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-700 dark:hover:text-neutral-50">Iestatījumi</a>
                        </li>
                    </ul>
                    <div class="pt-1">
                        <a href="admin/database/logout_function.php" class="block px-4 pb-3 rounded-b-lg py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-neutral-700 dark:text-gray-200 dark:hover:text-red-500">Izlogoties</a>
                    </div>
                </div>
            </div>

        </header>

        <div class="grid grid-cols-[70%_30%]">

            <div class="p-6">
                <div id="content" class="dark:text-neutral-50">
                    <!-- Content loads here -->
                </div>
            </div>

            <aside class="w-full h-full bg-white border-l dark:bg-neutral-900 dark:border-none">
                <div class="h-full px-6 py-6">
                <!-- Logo -->
                <div class="flex items-center mb-8">
                    <img src="assets/SonoraMainLogo" class="h-8 mr-3" alt="Logo" />
                    <span class="text-2xl font-semibold dark:text-white">iTrack</span>
                </div>

            </aside>
        </div>
        
        
    </div>


    



    </div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>