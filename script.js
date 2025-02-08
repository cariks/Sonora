function loadContent(url, containerId) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(html => {
            document.getElementById(containerId).innerHTML = html;
            initThemeToggle(); // Tēmas pārslēgšanas atkārtota inicializēšana
            initModals(); // Modālā loga loģikas inicializācija
        })
        .catch(error => {
            console.error(`Kļūda ${url}:`, error);
            document.getElementById(containerId).innerHTML = `<p class="text-red-500">Kļūda ielādējot saturu.</p>`;
        });
}

// Tēmas ielādēšanas funkcija no datubāzes
function loadThemeFromDatabase() {
    fetch('admin/database/get_theme.php')
        .then(response => response.json())
        .then(data => {
            if (data.theme) {
                const isDark = data.theme === 'dark';
                document.documentElement.classList.toggle('dark', isDark);
                
                // Atjaunināt pārslēdzēja stāvokli
                const themeToggle = document.getElementById('theme-toggle');
                if (themeToggle) {
                    themeToggle.checked = isDark;
                }
                
                // Atjaunināt localStorage
                localStorage.setItem('color-theme', data.theme);
            }
        })
        .catch(error => {
            console.error('Error loading theme:', error);
        });
}

// Tēmas pārslēgšanas inicializēšana
function initThemeToggle() {
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (!themeToggleBtn) return;

    // Ielādēt tēmu no datubāzes
    loadThemeFromDatabase();

    themeToggleBtn.addEventListener('change', function() {
        const isChecked = themeToggleBtn.checked;
        const newTheme = isChecked ? 'dark' : 'light';
        
        // Pielietot tēmu
        document.documentElement.classList.toggle('dark', isChecked);

        // Saglabāt localStorage
        localStorage.setItem('color-theme', newTheme);
        
        // Saglabāt datubāzē
        fetch('admin/database/save_theme.php', {
            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ theme: newTheme })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error saving theme:', data.error);
            }
        })
        .catch(error => {
            console.error('Error saving theme:', error);
        });
    });
}

// Modālā loga inicializēšana
function initModals() {
    const modalButtons = document.querySelectorAll('[data-modal-toggle]');
    const closeModalButtons = document.querySelectorAll('[data-modal-hide]');
    const body = document.body;

    // Modālā loga atvēršana
modalButtons.forEach(button => {
    button.addEventListener('click', function () {
        const modalId = this.getAttribute('data-modal-toggle');
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            body.classList.add('overflow-hidden');

            // Modālā loga aizvēršana uz backdrop klikšķi
            const backdrop = modal.querySelector('.absolute.inset-0');
            if (backdrop) {
                backdrop.addEventListener('click', function () {
                    closeModal(modal);
                });
            }
        }
    });
});

// Modālā loga aizvēršana
closeModalButtons.forEach(button => {
    button.addEventListener('click', function () {
        const modalId = this.getAttribute('data-modal-hide');
        const modal = document.getElementById(modalId);
        if (modal) {
            closeModal(modal);
        }
    });
});

// Universāla funkcija, lai aizvērtu modālo logu
function closeModal(modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    body.classList.remove('overflow-hidden');
}
}

// Sidebar loga loģika -----------

// "Homepage" click
document.getElementById('homepage-btn').addEventListener('click', function (event) {
    event.preventDefault();
    loadContent('homepage.php', 'content');
});

// "Settings" click
document.getElementById('settings-btn').addEventListener('click', function (event) {
    event.preventDefault();
    loadContent('settings.php', 'content');
});

// "Settings" click from modal
document.getElementById('settings-btn-1').addEventListener('click', function (event) {
    event.preventDefault();
    loadContent('settings.php', 'content');
});

// -------------

// Inicializācija, kad lapa tiek ielādēta
document.addEventListener('DOMContentLoaded', function() {
    initThemeToggle();
    loadContent('homepage.php', 'content');
});