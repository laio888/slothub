import { state, logout, isLogged } from './session.js';

// Ejecutar INMEDIATAMENTE antes de que el navegador pinte
// para evitar el parpadeo de links incorrectos
applyAuthState();

document.addEventListener('DOMContentLoaded', () => {

    // Hamburger
    document.getElementById('hamburger')?.addEventListener('click', () => {
        document.getElementById('navLinks')?.classList.toggle('open');
    });

    // Cerrar sesión
    document.getElementById('btnLogout')?.addEventListener('click', (e) => {
        e.preventDefault();
        logout();
    });

    // Avatar con inicial del usuario
    if (isLogged() && state.user) {
        const avatar = document.getElementById('navAvatar');
        if (avatar) avatar.textContent = state.user.nombre.charAt(0).toUpperCase();
    }
});

function applyAuthState() {
    // Leer directo de sessionStorage para no depender del DOM
    let user = null;
    try { user = JSON.parse(sessionStorage.getItem('cosm_user')); } catch {}

    if (user) {
        document.body.classList.add('is-logged');
    } else {
        document.body.classList.remove('is-logged');
    }
}
