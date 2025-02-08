<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonora - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="bg-neutral-900">
    <div class="flex min-h-screen items-center justify-center">
        <div class="w-full max-w-sm p-4 bg-neutral-800 border border-neutral-700 rounded-lg shadow sm:p-6 md:p-8">
            <form class="space-y-6" action="admin/database/login_function.php" method="POST">
                <h5 class="text-xl font-medium text-neutral-50">Ielogoties iTrack</h5>
                
                <?php
                    session_start();
                    if(isset($_SESSION['error'])) {
                        echo '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-neutral-900 dark:text-red-400" role="alert">';
                        echo $_SESSION['error'];
                        echo '</div>';
                        unset($_SESSION['error']);
                    }
                ?>

                <div>
                    <label for="lietotajs" class="block mb-2 text-sm font-medium text-neutral-50">Lietotājvārds</label>
                    <input type="text" name="lietotajs" id="lietotajs" class="bg-neutral-700 border border-neutral-600 text-neutral-50 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="parole" class="block mb-2 text-sm font-medium text-neutral-50">Parole</label>
                    <input type="password" name="parole" id="parole" class="bg-neutral-700 border border-neutral-600 text-neutral-50 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                
                <button type="submit" name="ielogoties" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ielogoties</button>
                
                <div class="text-sm font-medium text-neutral-400">
                    Nav konta? <a href="register.php" class="text-blue-700 hover:underline dark:text-blue-500">Izveidot kontu</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 