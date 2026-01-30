// --- App State ---
const API_BASE_URL = window.location.origin + '/transformacion/api';

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
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Check if we are on the Contribuyente page
        if (window.location.pathname.includes('page_Contribuyente.html')) {
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('is_contribuyente', 'true'); // Standardized key
            window.location.href = 'paginas/patentes_mis_solicitudes_C.html';
            return;
        }

        const user = usernameInput.value.trim();
        const pass = passwordInput.value.trim();

        try {

            //const formData = new FormData();
            //formData.append('usuario', user);
            //formData.append('password', pass);

            const response = await fetch(`${API_BASE_URL}/login.php`, {
                method: 'POST',
                //body: formData
                body: JSON.stringify({
                    usuario: user,
                    password: pass,
                    ACCION: "login"
                }),
                credentials: 'include'
            })


            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();

            if (data.status === 'success' || data.success === true) {
                // Login successful
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.removeItem('is_contribuyente'); // Ensure admin is not contribuyente

                // Store user data if needed?
                if (data.data) {
                    localStorage.setItem('user_data', JSON.stringify(data.data));
                }

                window.location.href = 'paginas/dashboard.html';
            } else {
                // Login failed
                loginError.classList.remove('d-none');
                loginError.textContent = data.message || 'Credenciales incorrectas';
            }

        } catch (error) {
            console.error('Login Error:', error);
            loginError.classList.remove('d-none');
            loginError.textContent = 'Error de conexión con el servidor.';
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
// Helper: Logout (Used by layout_manager or others)
window.logout = async function () {
    // Attempt backend logout
    try {
        await fetch(`${API_BASE_URL}/logout.php`);
    } catch (e) {
        console.error('Logout failed on server', e);
    }

    // Clear Google State if available
    if (typeof google !== 'undefined' && google.accounts && google.accounts.id) {
        google.accounts.id.disableAutoSelect();
    }

    // Clear Local State
    state.isLoggedIn = false;
    state.is_Contribuyente = false;
    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('user_data');

    // Redirect to root login
    // Detect if we are in a subdirectory (paginas/) or root
    // If current path has 'paginas', go up one level.
    if (window.location.pathname.includes('/paginas/')) {
        //window.location.href = '../index.html';
    } else {
        // window.location.href = 'index.html';
    }
}
