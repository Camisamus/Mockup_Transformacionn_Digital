// --- App State ---
const state = {
    isLoggedIn: localStorage.getItem('isLoggedIn') === 'true'
};

// --- DOM Elements ---
const loginForm = document.getElementById('login-form');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const loginError = document.getElementById('login-error');

// --- Login Logic ---
if (loginForm) {
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
}

function login() {
    state.isLoggedIn = true;
    localStorage.setItem('isLoggedIn', 'true');
    // Direct Redirect
    window.location.href = 'paginas/dashboard.html';
}

// Helper: Logout (Used by layout_manager or others)
window.logout = function () {
    state.isLoggedIn = false;
    localStorage.removeItem('isLoggedIn');
    // Redirect to root login
    // Assume we are in paginas/ subdir usually
    window.location.href = '../page.html';
}
