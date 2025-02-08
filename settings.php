<?php
session_start();
require 'admin/database/con_db.php';
require 'admin/database/get_user_data.php';

// Autorizācijas pārbaude
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


// Iegūt lietotāja datus (izmantojot cache)
$userData = getUserData($savienojums, $_SESSION['user_id']);

// Generēt data URI attēlam tikai tad, ja tas eksistē
$profileImageSrc = '';

if ($userData && $userData['profile_picture']) {
    $profileImageSrc = 'data:image/jpeg;base64,' . base64_encode($userData['profile_picture']);
}
?>

<!-- Profile -->

<h1 class="text-2xl font-bold">Profils</h1>

<div class="pt-6 pb-6">
<button data-modal-toggle="profile-picture-modal">
  <div class="relative w-60 h-60 overflow-hidden bg-neutral-100 rounded-full dark:bg-neutral-600 cursor-pointer filter hover:brightness-75 transition-all group">
    <?php if ($profileImageSrc): ?>
        <!-- User profile picture -->
        <img src="<?php echo $profileImageSrc; ?>" 
             alt="Profile picture" 
             class="w-full h-full object-cover">
    <?php else: ?>
        <!-- Default profile icon -->
        <svg class="absolute w-72 h-72 text-neutral-400 -left-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
        </svg>
    <?php endif; ?>
    
    <!-- Change image -->
    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity">
      <!-- Icon -->
      <svg class="w-20 h-20 text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 -pt-3 pb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
      </svg>
      <!-- Text -->
      <span class="absolute text-white font-semibold text-sm top-1/2 left-1/2 transform -translate-x-1/2 mt-8 select-none">Augšupielādēt</span>
    </div>
  </div>
  </button>

</div>

<!-- User Info -->
<div class="mb-8">
    <div class="grid grid-cols-1 gap-4 max-w-xl">
        <!-- Username -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-neutral-900 dark:text-neutral-200 mb-2">
                Lietotājvārds
            </label>
            <div class="flex">
                <span class="text-neutral-900 dark:text-neutral-200">
                    <?php echo htmlspecialchars($userData['username'] ?? 'Nav norādīts'); ?>
                </span>
            </div>
        </div>
        
        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-neutral-900 dark:text-neutral-200 mb-2">
                E-pasts
            </label>
            <div class="flex">
                <span class="text-neutral-900 dark:text-neutral-200">
                    <?php echo htmlspecialchars($userData['email'] ?? 'Nav norādīts'); ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Small Modal -->
<div id="profile-picture-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden justify-center items-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative w-full max-w-md max-h-full z-10">
    
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-neutral-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-neutral-600">
                <h3 class="text-xl font-medium text-neutral-900 dark:text-neutral-50">
                    Nomainīt profila attēlu
                </h3>
                <button type="button" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-neutral-700 dark:hover:text-white" data-modal-hide="profile-picture-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Aizvērt</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-neutral-50 dark:hover:bg-neutral-800 dark:bg-neutral-700 hover:bg-neutral-100 dark:border-neutral-600 dark:hover:border-neutral-500 dark:hover:bg-neutral-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-neutral-500 dark:text-neutral-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-neutral-500 dark:text-neutral-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400">PNG, JPG, JPEG vai WEBP (Maks. izmērs 10MB)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" />
                    </label>
                </div> 

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-neutral-200 rounded-b dark:border-neutral-600">
                <button data-modal-hide="profile-picture-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Apstiprināt</button>
                <button data-modal-hide="profile-picture-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-neutral-900 focus:outline-none bg-white rounded-lg border border-neutral-200 hover:bg-neutral-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-neutral-100 dark:focus:ring-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:border-neutral-600 dark:hover:text-white dark:hover:bg-neutral-700">Atcelt</button>
            </div>
        </div>
    </div>
</div>


<!-- Main settings -->

<h1 class="text-2xl font-bold">Iestatījumi</h1>

<p class="text-neutral-600 dark:text-neutral-400">Šeit būs iestatījumi:</p>

<div class="mt-4">
    <label class="inline-flex items-center cursor-pointer">
        <input type="checkbox" id="theme-toggle" class="sr-only peer" <?php echo ($_SESSION['theme'] === 'dark') ? 'checked' : ''; ?>>
        <div class="relative w-11 h-6 bg-neutral-200 rounded-full peer dark:bg-neutral-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-neutral-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-neutral-900 dark:text-neutral-300 select-none">Tumša tēma</span>
    </label>
</div>