import { state, requireAuth, isLogged } from './session.js';

document.addEventListener('DOMContentLoaded', () => {
    if (!requireAuth()) return; // redirige si no hay sesión

    const saludo = document.getElementById('dashSaludo');
    if (saludo && state.user) {
        saludo.textContent = `Hola, ${state.user.nombre} 👋`;
    }

    const counter = document.getElementById('dashCitasCount');
    if (counter) counter.textContent = state.citas.length;
});
