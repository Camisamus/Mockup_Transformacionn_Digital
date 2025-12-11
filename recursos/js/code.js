// --- Menu Configuration ---
// (Menu logic moved to js/sidebar.js)

// --- App State ---
const state = {
    isLoggedIn: localStorage.getItem('isLoggedIn') === 'true'
};

// --- DOM Elements ---
const loginScreen = document.getElementById('login-screen');
const appScreen = document.getElementById('app-screen');
const loginForm = document.getElementById('login-form');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const loginError = document.getElementById('login-error');
// const menuContainer = document.getElementById('menu-container'); // Moved to sidebar.js
// const logoutBtn = document.getElementById('logout-btn'); // Moved to sidebar.js
const pageTitle = document.getElementById('page-title');
const contentArea = document.getElementById('content-area');

// --- Initialization ---
document.addEventListener('DOMContentLoaded', () => {
    if (state.isLoggedIn) {
        showApp();
    } else {
        showLogin();
    }
    // loadMenu(); // Handled by sidebar.js
});

// --- Login Logic ---
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const user = usernameInput.value.trim();
    const pass = passwordInput.value.trim();

    if (user === 'admin' && pass === 'admin') {
        login();
    } else {
        loginError.classList.remove('d-none');
    }
});

// Logout button listener moved to sidebar.js

function login() {
    state.isLoggedIn = true;
    localStorage.setItem('isLoggedIn', 'true');
    showApp();
}

// Global logout function called by sidebar.js
window.logout = function () {
    state.isLoggedIn = false;
    localStorage.removeItem('isLoggedIn');
    showLogin();
    // Reset contents
    loginForm.reset();
    loginError.classList.add('d-none');
}

function showLogin() {
    loginScreen.classList.remove('d-none');
    appScreen.classList.add('d-none');
}

function showApp() {
    loginScreen.classList.add('d-none');
    appScreen.classList.remove('d-none');
    feather.replace();
}

// --- Navigation Handler ---
window.handleNavClick = function (label, url) {
    pageTitle.textContent = label;
    const iframe = document.getElementById('content-frame');

    if (url) {
        // Clear srcdoc first to ensure src takes effect
        iframe.removeAttribute('srcdoc');
        iframe.src = url;
    } else {
        // Clear src and use srcdoc for fallback message
        iframe.removeAttribute('src');
        iframe.srcdoc = `
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <link href="recursos/css/bootstrap.min.css" rel="stylesheet">
                <style>body { display: flex; align-items: center; justify-content: center; height: 100vh; background: #f8f9fa; }</style>
            </head>
            <body>
                <div class="text-center text-muted">
                    <h3>${label}</h3>
                    <p>Módulo en construcción</p>
                </div>
            </body>
            </html>
        `;
    }

    // Highlight active
    document.querySelectorAll('.leaf-link').forEach(l => l.classList.remove('active'));
    // Note: To properly highlight, we might need to pass the event or element. 
    // For now, simpler implementation.
};
